<?php

namespace App\Http\Controllers;

use App\Models\Prahari;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PrahariController extends Controller
{
    public function index(Request $request) {
        if ($request->has('export') && $request->export == 'csv') {
            $praharis = Prahari::all();
            $csvData = "S.No,Prahari,Mobile,Aadhaar Status,Bank Account Detail,Status\n";
            foreach ($praharis as $index => $p) {
                // simple csv escape
                $pName = '"' . str_replace('"', '""', $p->Prahari) . '"';
                $csvData .= ($index + 1) . "," . $pName . "," . $p->Mobile . "," . $p->AadhaarStatus . "," . $p->Bank_account_detail . "," . $p->status . "\n";
            }
            return response($csvData)
                ->header('Content-Type', 'text/csv')
                ->header('Content-Disposition', 'attachment; filename="praharis.csv"');
        }

        if ($request->ajax()) {
            $prahari = Prahari::get();
            return DataTables::of($prahari)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                return '<a href="'.route('prahari.view', $row->id).'" class="btn btn-sm btn-info text-white shadow-sm border-0 me-1">View</a>
                        <button class="btn btn-sm btn-primary editBtn shadow-sm border-0 me-1" data-id="'.$row->id.'">Edit</button>
                        <button class="btn btn-sm btn-danger deleteBtn shadow-sm border-0" data-id="'.$row->id.'">Delete</button>';
        })
        ->rawColumns(['action'])
        ->make(true);
        }
        return view('admin.praharis');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'Prahari' => 'required|string|max:255',
            'Mobile' => 'required|string|min:10|max:15',
            'AadhaarStatus' => 'required|in:Verified,Pending,Rejected',
            'Bank_account_detail' => 'required|string|max:255|unique:praharis,Bank_account_detail',
            'status' => 'required|in:Active,Inactive',
        ]);

        $prahari = Prahari::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Prahari created successfully',
            'data' => $prahari
        ]);
    }

    public function show($id) {
        $prahari = Prahari::findOrFail($id);

        $amount = 0;
        $latestCase = $prahari->cases()->latest()->first();
        if ($latestCase && $latestCase->category) {
            $amount = $latestCase->category->Amount;
        } else {
            $latestChallan = $prahari->challans()->latest()->first();
            if ($latestChallan && $latestChallan->category) {
                $amount = $latestChallan->category->Amount;
            }
        }

        return response()->json([
            'status' => true,
            'bank_account' => $prahari->Bank_account_detail,
            'amount' => $amount
        ]);
    }

    public function edit($id) {
        $prahari = Prahari::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $prahari
        ]);
    }

    public function update(Request $request, $id) {

        $prahari = Prahari::findOrFail($id);

        $validated = $request->validate([
            'Prahari' => 'required|string|max:255',
            'Mobile' => 'required|string|min:10|max:15',
            'AadhaarStatus' => 'required|in:Verified,Pending,Rejected',
            'Bank_account_detail' => 'required|string|max:255|unique:praharis,Bank_account_detail,' . $id,
            'status' => 'required|in:Active,Inactive',
        ]);

        $prahari->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Prahari updated successfully',
            'data' => $prahari
        ]);
    }

    public function destroy($id) {
        $prahari = Prahari::findOrFail($id);
        $prahari->delete();

        return response()->json([
            'status' => true,
            'message' => 'Prahari deleted successfully'
        ]);
    }

    public function view($id) {
        $prahari = Prahari::with(['cases', 'challans.category', 'payments'])->findOrFail($id);

        // Calculate cases stats
        $casesTotal = $prahari->cases->count();
        $casesOpen = $prahari->cases->where('status', 'Open')->count();
        $casesInProgress = $prahari->cases->where('status', 'In Progress')->count();
        $casesClosed = $prahari->cases->where('status', 'Closed')->count();

        // Calculate challans stats
        $challansTotal = $prahari->challans->count();
        $challansPaid = $prahari->challans->where('status', 'Paid')->count();
        $challansPending = $prahari->challans->where('status', 'Pending')->count();
        $challansCancelled = $prahari->challans->where('status', 'Cancelled')->count();

        // Calculate financial stats
        // Total Earnings Generated = Sum(Category Amount of all Challans)
        $totalEarnings = $prahari->challans->sum(function($challan) {
            return $challan->category ? $challan->category->Amount : 0;
        });

        // Total Withdrawal Requested = Sum(All Payment Amounts)
        $totalRequested = $prahari->payments->sum('amount');

        // Total Approved Withdrawals = Sum(Approved Payment Amounts)
        $totalApproved = $prahari->payments->where('status', 'Approved')->sum('amount');

        // Total Pending Withdrawals = Sum(Pending Payment Amounts)
        $totalPending = $prahari->payments->where('status', 'Pending')->sum('amount');

        // Remaining Withdrawable Balance
        $remainingBalance = $totalEarnings - $totalApproved;

        return view('admin.prahari.show', compact(
            'prahari',
            'casesTotal', 'casesOpen', 'casesInProgress', 'casesClosed',
            'challansTotal', 'challansPaid', 'challansPending', 'challansCancelled',
            'totalEarnings', 'totalRequested', 'totalApproved', 'totalPending', 'remainingBalance'
        ));
    }
}
