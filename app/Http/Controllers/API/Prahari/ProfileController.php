<?php

namespace App\Http\Controllers\API\Prahari;

use App\Http\Controllers\Controller;
use App\Models\Cases;
use App\Models\Payment;
use App\Models\Challan;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile(Request $request)
{
    return response()->json($request->user());
}

public function profileSummary()
{
    $prahari = auth()->user();

    $totalCases = Cases::where(
        'prahari_id',
        $prahari->id
    )->count();

    $openCases = Cases::where(
        'prahari_id',
        $prahari->id
    )->where(
        'status',
        'Open'
    )->count();

    $inProgressCases = Cases::where(
        'prahari_id',
        $prahari->id
    )->where(
        'status',
        'In Progress'
    )->count();

    $closedCases = Cases::where(
        'prahari_id',
        $prahari->id
    )->where(
        'status',
        'Closed'
    )->count();

    $totalChallans = Challan::where(
        'prahari_id',
        $prahari->id
    )->count();

    $paidChallans = Challan::where(
        'prahari_id',
        $prahari->id
    )->where(
        'status',
        'Paid'
    )->count();

    $pendingChallans = Challan::where(
        'prahari_id',
        $prahari->id
    )->where(
        'status',
        'Pending'
    )->count();

    $cancelledChallans = Challan::where(
        'prahari_id',
        $prahari->id
    )->where(
        'status',
        'Cancelled'
    )->count();

    $totalEarnings = Challan::join(
            'categories',
            'challans.category_id',
            '=',
            'categories.id'
        )
        ->where(
            'challans.prahari_id',
            $prahari->id
        )
        ->sum('categories.Amount');

    $totalRequested = Payment::where(
        'prahari_id',
        $prahari->id
    )->sum('amount');

    $totalApproved = Payment::where(
        'prahari_id',
        $prahari->id
    )->where(
        'status',
        'Approved'
    )->sum('amount');

    $totalPending = Payment::where(
        'prahari_id',
        $prahari->id
    )->where(
        'status',
        'Pending'
    )->sum('amount');

    return response()->json([
        'status' => true,

        'prahari' => [
            'id' => $prahari->id,
            'name' => $prahari->Prahari,
            'mobile' => $prahari->Mobile,
            'aadhaar_status' => $prahari->AadhaarStatus,
            'bank_account' => $prahari->Bank_account_detail,
            'current_status' => $prahari->status,
            'created_at' => $prahari->created_at,
            'language' => $prahari->language,
            'notifications_enabled' => $prahari->notifications_enabled
        ],

        'cases' => [
            'total' => $totalCases,
            'open' => $openCases,
            'in_progress' => $inProgressCases,
            'closed' => $closedCases,
        ],

        'challans' => [
            'total' => $totalChallans,
            'paid' => $paidChallans,
            'pending' => $pendingChallans,
            'cancelled' => $cancelledChallans,
        ],

        'payments' => [
            'total_earnings' => $totalEarnings,
            'total_requested' => $totalRequested,
            'approved_withdrawals' => $totalApproved,
            'pending_withdrawals' => $totalPending,
            'remaining_balance' =>
                $totalEarnings - $totalApproved,
        ]
    ]);
}

public function getSettings(Request $request)
{
    $prahari = $request->user();

    return response()->json([
        'status' => true,
        'data' => [
            'language' => $prahari->language,
            'notifications_enabled' => $prahari->notifications_enabled
        ]
    ]);
}

public function updateSettings(Request $request)
{
    $request->validate([
        'language' => 'required|in:English,Hindi',
        'notifications_enabled' => 'required|boolean'
    ]);

    $prahari = $request->user();

    $prahari->update([
        'language' => $request->language,
        'notifications_enabled' => $request->notifications_enabled
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Settings updated successfully',
        'data' => [
            'language' => $prahari->language,
            'notifications_enabled' => $prahari->notifications_enabled
        ]
    ]);
}

public function update(Request $request)
{
    $user = $request->user();

    $user->update([
        'Prahari' => $request->Prahari,
        'Mobile' => $request->Mobile,
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Profile Updated'
    ]);
}
}
