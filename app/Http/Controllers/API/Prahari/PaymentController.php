<?php

namespace App\Http\Controllers\API\Prahari;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Challan;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
public function balance(Request $request)
{
    $prahariId = $request->user()->id;

    $totalRequested = Payment::where('prahari_id', $prahariId)
        ->sum('amount');

    $approvedAmount = Payment::where('prahari_id', $prahariId)
        ->where('status', 'Approved')
        ->sum('amount');

    $pendingAmount = Payment::where('prahari_id', $prahariId)
        ->where('status', 'Pending')
        ->sum('amount');

    $rejectedAmount = Payment::where('prahari_id', $prahariId)
        ->where('status', 'Rejected')
        ->sum('amount');

    return response()->json([
        'total_withdraw_requested' => $totalRequested,
        'approved_withdrawals' => $approvedAmount,
        'pending_withdrawals' => $pendingAmount,
        'rejected_withdrawals' => $rejectedAmount
    ]);
}

public function transactions(Request $request)
{
    return response()->json(
        Payment::where('prahari_id', $request->user()->id)->get()
    );
}

public function transactionList(Request $request)
{
    $payments = Payment::with('prahari')
        ->where('prahari_id', $request->user()->id)
        ->get();

    return response()->json([
        'status' => true,
        'total_transactions' => $payments->count(),
        'data' => $payments
    ]);
}

public function paymentDetails($id)
{
    $payment = Payment::with('prahari')
        ->where('id', $id)
        ->where('prahari_id', auth()->id())
        ->first();

    if (!$payment) {
        return response()->json([
            'status' => false,
            'message' => 'Payment not found'
        ], 404);
    }

    return response()->json([
        'status' => true,
        'data' => $payment
    ]);
}

public function requestWithdraw(Request $request)
{
    $prahari = auth()->user();

    $status = 'Pending';

    // Get unpaid challans with category amount
    $challans = Challan::join('categories', 'challans.category_id', '=', 'categories.id')
        ->where('challans.prahari_id', $prahari->id)
        ->where('challans.is_paid', false)
        ->select(
            'challans.id',
            'categories.Amount'
        )
        ->get();

    // Check if no challans found
    if ($challans->count() == 0) {

        return response()->json([
            'status' => false,
            'message' => 'No unpaid challans found'
        ]);
    }

    // Total earning amount
    $totalAmount = $challans->sum('Amount');

    // Check existing pending payment
    $payment = Payment::where('prahari_id', $prahari->id)
        ->where('status', 'Pending')
        ->first();

    // If payment already exists → add amount
    if ($payment) {

        $payment->amount += $totalAmount;
        $payment->save();

    } else {

        // Create new payment request
        $payment = Payment::create([
            'prahari_id' => $prahari->id,
            'bank_account' => $prahari->Bank_account_detail,
            'amount' => $totalAmount,
            'status' => $status,
            'date' => now(),
        ]);
    }

    // Mark challans as paid
    Challan::whereIn('id', $challans->pluck('id'))
        ->update([
            'is_paid' => true
        ]);

    return response()->json([
        'status' => true,
        'message' => 'Withdrawal request sent successfully',
        'total_amount' => $totalAmount,
        'payment' => $payment
    ]);
}
}
