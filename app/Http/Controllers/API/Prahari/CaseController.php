<?php

namespace App\Http\Controllers\API\Prahari;

use App\Http\Controllers\Controller;
use App\Models\Cases;
use Illuminate\Http\Request;

class CaseController extends Controller
{
public function index(Request $request)
{
    $cases = Cases::with('prahari', 'category')->where(
        'prahari_id',
        $request->user()->id
    )->latest()->get();

    return response()->json([
        'status' => true,
        'total_cases' => $cases->count(),
        'data' => $cases
    ]);
}

public function store(Request $request)
{
    $case = Cases::create([
        'prahari_id' => auth()->id(),
        'category_id' => $request->category_id,
        'Location' => $request->Location,
        'evidence_file' => $request->evidence_file,
        'status' => 'Open',
        'violation_date' => now()->toDateString()
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Case Created Successfully',
        'data' => $case
    ]);
}

public function show($id)
{
    $case = Cases::where('id', $id)
        ->where('prahari_id', auth()->id())
        ->firstOrFail();

    return response()->json($case);
}

public function update(Request $request, $id)
{
    $case = Cases::where('id', $id)
        ->where('prahari_id', auth()->id())
        ->firstOrFail();

    $case->update([
        'prahari_id' => auth()->id(),
        'category_id' => $request->category_id,
        'Location' => $request->Location,
        'evidence_file' => $request->evidence_file,
        'status' => 'Open',
        'violation_date' => now()->toDateString()
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Case Updated Successfully',
        'data' => $case
    ]);
}
}
