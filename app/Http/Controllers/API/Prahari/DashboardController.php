<?php

namespace App\Http\Controllers\API\Prahari;

use App\Http\Controllers\Controller;
use App\Models\Cases;
use App\Models\Challan;
use App\Models\Prahari;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function stats()
    {
        return response()->json([
            'total_praharis' => Prahari::count(),
            'total_cases' => Cases::count(),
            'total_challans' => Challan::count(),
            'total_revenue' => Payment::sum('amount') ?? 0,
        ]);
    }

    public function recentCases()
    {
        return response()->json(
            Cases::latest()->take(10)->get()
        );
    }

    public function recentChallans()
    {
        return response()->json(
            Challan::latest()->take(10)->get()
        );
    }
}