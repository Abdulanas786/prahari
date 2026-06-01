<?php

namespace Tests\Feature;

use App\Models\Cases;
use App\Models\Category;
use App\Models\Challan;
use App\Models\Payment;
use App\Models\Prahari;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        // Create an admin/user to authenticate requests
        $this->user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
    }

    /**
     * Test payment creation auto-resolves bank account and amount from latest case.
     */
    public function test_payment_creation_auto_resolves_bank_account_and_amount_from_latest_case(): void
    {
        $prahari = Prahari::create([
            'Prahari' => 'John Doe',
            'Mobile' => '1234567890',
            'AadhaarStatus' => 'Verified',
            'Bank_account_detail' => '123456789012',
            'status' => 'Active',
        ]);

        $category = Category::create([
            'Type' => 'Speeding',
            'Amount' => 500.00,
        ]);

        Cases::create([
            'prahari_id' => $prahari->id,
            'category_id' => $category->id,
            'Location' => 'Test Location',
            'evidence_file' => 'test.jpg',
            'status' => 'Open',
            'violation_date' => '2026-05-22',
        ]);

        $response = $this->actingAs($this->user)
            ->postJson('/account/payments', [
                'prahari_id' => $prahari->id,
                'status' => 'Pending',
                'date' => '2026-05-22',
            ]);

        $response->assertStatus(200);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('message', 'Payment recorded successfully');

        $this->assertDatabaseHas('payments', [
            'prahari_id' => $prahari->id,
            'bank_account' => '123456789012',
            'amount' => 500.00,
            'status' => 'Pending',
            'date' => '2026-05-22',
        ]);
    }

    /**
     * Test payment creation auto-resolves bank account and amount from latest challan if no case exists.
     */
    public function test_payment_creation_auto_resolves_bank_account_and_amount_from_latest_challan_if_no_case(): void
    {
        // Prahari A (will own the case)
        $prahariA = Prahari::create([
            'Prahari' => 'Prahari A',
            'Mobile' => '1111111111',
            'AadhaarStatus' => 'Verified',
            'Bank_account_detail' => '111111111111',
            'status' => 'Active',
        ]);

        // Prahari B (will own the challan, but no cases of their own)
        $prahariB = Prahari::create([
            'Prahari' => 'Prahari B',
            'Mobile' => '9876543210',
            'AadhaarStatus' => 'Verified',
            'Bank_account_detail' => '987654321098',
            'status' => 'Active',
        ]);

        $categoryA = Category::create([
            'Type' => 'Speeding',
            'Amount' => 500.00,
        ]);

        $categoryB = Category::create([
            'Type' => 'No Helmet',
            'Amount' => 300.00,
        ]);

        // Create Case belonging to Prahari A
        $case = Cases::create([
            'prahari_id' => $prahariA->id,
            'category_id' => $categoryA->id,
            'Location' => 'Test Location',
            'evidence_file' => 'test.jpg',
            'status' => 'Open',
            'violation_date' => '2026-05-22',
        ]);

        // Create Challan belonging to Prahari B, referencing Case A
        Challan::create([
            'prahari_id' => $prahariB->id,
            'case_id' => $case->id,
            'category_id' => $categoryB->id,
            'status' => 'Pending',
            'Date' => '2026-05-22',
        ]);

        $response = $this->actingAs($this->user)
            ->postJson('/account/payments', [
                'prahari_id' => $prahariB->id,
                'status' => 'Pending',
                'date' => '2026-05-22',
            ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('payments', [
            'prahari_id' => $prahariB->id,
            'bank_account' => '987654321098',
            'amount' => 300.00,
            'status' => 'Pending',
            'date' => '2026-05-22',
        ]);
    }

    /**
     * Test multiple payments accumulate amount for the same Prahari and bank account instead of creating a new row.
     */
    public function test_payment_creation_accumulates_amount_for_same_prahari_and_bank_account(): void
    {
        $prahari = Prahari::create([
            'Prahari' => 'Accumulate User',
            'Mobile' => '5555555555',
            'AadhaarStatus' => 'Verified',
            'Bank_account_detail' => '111122223333',
            'status' => 'Active',
        ]);

        $category = Category::create([
            'Type' => 'Red Light',
            'Amount' => 1000.00,
        ]);

        Cases::create([
            'prahari_id' => $prahari->id,
            'category_id' => $category->id,
            'Location' => 'Test Location',
            'evidence_file' => 'test.jpg',
            'status' => 'Open',
            'violation_date' => '2026-05-22',
        ]);

        // Submit first payment
        $response1 = $this->actingAs($this->user)
            ->postJson('/account/payments', [
                'prahari_id' => $prahari->id,
                'status' => 'Pending',
                'date' => '2026-05-22',
            ]);
        $response1->assertStatus(200);
        $response1->assertJsonPath('message', 'Payment recorded successfully');

        // Submit second payment
        $response2 = $this->actingAs($this->user)
            ->postJson('/account/payments', [
                'prahari_id' => $prahari->id,
                'status' => 'Approved',
                'date' => '2026-05-23',
            ]);
        $response2->assertStatus(200);
        $response2->assertJsonPath('message', 'Payment accumulated successfully');

        // Assert only 1 payment exists
        $this->assertEquals(1, Payment::count());

        $this->assertDatabaseHas('payments', [
            'prahari_id' => $prahari->id,
            'bank_account' => '111122223333',
            'amount' => 2000.00, // 1000 + 1000
            'status' => 'Approved', // updated status
            'date' => '2026-05-23', // updated date
        ]);
    }

    /**
     * Test payment fails if Prahari has no cases or challans with a valid category amount.
     */
    public function test_payment_fails_if_prahari_has_no_case_or_challan_with_valid_amount(): void
    {
        $prahari = Prahari::create([
            'Prahari' => 'No Case User',
            'Mobile' => '4444444444',
            'AadhaarStatus' => 'Verified',
            'Bank_account_detail' => '444444444444',
            'status' => 'Active',
        ]);

        $response = $this->actingAs($this->user)
            ->postJson('/account/payments', [
                'prahari_id' => $prahari->id,
                'status' => 'Pending',
                'date' => '2026-05-22',
            ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['amount']);
        $response->assertJsonFragment([
            'amount' => ['The selected Prahari does not have any cases or challans with a valid category amount.']
        ]);
    }

    /**
     * Test payment allows explicit bank account and amount for CSV imports.
     */
    public function test_payment_allows_explicit_bank_account_and_amount_for_csv_imports(): void
    {
        $prahari = Prahari::create([
            'Prahari' => 'CSV User',
            'Mobile' => '9999999999',
            'AadhaarStatus' => 'Verified',
            'Bank_account_detail' => '999999999999',
            'status' => 'Active',
        ]);

        $response = $this->actingAs($this->user)
            ->postJson('/account/payments', [
                'prahari_id' => $prahari->id,
                'bank_account' => '888888888888',
                'amount' => 2500.00,
                'status' => 'Approved',
                'date' => '2026-05-22',
            ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('payments', [
            'prahari_id' => $prahari->id,
            'bank_account' => '888888888888',
            'amount' => 2500.00,
            'status' => 'Approved',
            'date' => '2026-05-22',
        ]);
    }
}
