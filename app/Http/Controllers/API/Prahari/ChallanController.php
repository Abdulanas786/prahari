<?php

namespace App\Http\Controllers\API\Prahari;

use App\Http\Controllers\Controller;
use App\Models\Challan;
use Illuminate\Http\Request;

class ChallanController extends Controller
{
public function index(Request $request)
{
    $challans = Challan::with('prahari', 'case', 'category')
        ->where('prahari_id', $request->user()->id)
        ->get();

    return response()->json([
        'status' => true,
        'total_challans' => $challans->count(),
        'data' => $challans
    ]);
}

public function store(Request $request)
{
    $challan = Challan::create([
        'prahari_id' => auth()->id(),
        'case_id' => $request->case_id,
        'category_id' => $request->category_id,
        'status' => $request->status,
        'Date' => now()->toDateString(),
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Challan Created Successfully',
        'data' => $challan
    ]);
}

public function updateStatus(Request $request, $id)
{
    $challan = Challan::where('id', $id)
        ->where('prahari_id', auth()->id())
        ->first();

    if (!$challan) {
        return response()->json([
            'status' => false,
            'message' => 'Challan not found'
        ], 404);
    }

    $challan->update([
        'status' => $request->status
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Status Updated'
    ]);
}
}
