<?php

namespace App\Http\Controllers;

use App\Models\Challan;
use App\Models\Cases;
use App\Models\Prahari;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ChallanController extends Controller
{
    public function index(Request $request) {
        if ($request->has('export') && $request->export == 'csv') {
            $challans = Challan::with(['prahari', 'case', 'category'])->latest()->get();
            $csvData = "S.No,Case ID,Prahari Name,Amount,Status,Violation Date\n";
            foreach ($challans as $index => $c) {
                $cId = $c->case_id ?? '-';
                $pName = '"' . str_replace('"', '""', $c->prahari->Prahari ?? '-') . '"';
                $amount = $c->category->Amount ?? 0;
                $date = $c->Date ? date('d M Y', strtotime($c->Date)) : '-';
                $csvData .= ($index + 1) . "," . $cId . "," . $pName . "," . $amount . "," . $c->status . "," . $date . "\n";
            }
            return response($csvData)
                ->header('Content-Type', 'text/csv')
                ->header('Content-Disposition', 'attachment; filename="challans.csv"');
        }

        if ($request->ajax()) {
            $challans = Challan::with(['prahari', 'case', 'category'])->latest();

            return DataTables::of($challans)
                ->addIndexColumn()
                ->addColumn('case_id', function ($row) {
                    return $row->case_id ?? '-';
                })
                ->addColumn('prahari_name', function ($row) {
                    return $row->prahari->Prahari ?? '-';
                })
                ->addColumn('amount', function ($row) {
                    $amount = $row->category->Amount ?? 0;
                    return '₹ ' . number_format($amount, 0);
                })
                ->addColumn('status', function ($row) {
                    return '<span class="badge bg-info">'.$row->status.'</span>';
                })
                ->addColumn('violation_date', function ($row) {
                    return $row->Date ? date('d M Y', strtotime($row->Date)) : '-';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <button class="btn btn-sm btn-info text-white viewBtn" data-id="'.$row->id.'">View</button>
                        <button class="btn btn-sm btn-primary editBtn" data-id="'.$row->id.'">Edit</button>
                        <button class="btn btn-sm btn-danger deleteBtn" data-id="'.$row->id.'">Delete</button>
                    ';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        $praharis = Prahari::all();
        $categories = Category::all();
        $cases = Cases::all();
        return view('admin.challans', compact('praharis', 'categories', 'cases'));
    }

    public function store(Request $request) {
        $validate = $request->validate([
            'prahari_id' => 'required|exists:praharis,id',
            'case_id' => 'required|exists:cases,id',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:Paid,Pending,Cancelled',
            'Date' => 'required|date',
        ]);

        $challan = Challan::create($validate);

        return response()->json([
            'status' => true,
            'message' => 'Challan created successfully',
            'data' => $challan
        ]);
    }

    public function edit($id) {
        $challan = Challan::with(['prahari', 'case', 'category'])->findOrFail($id);
        return response()->json([
            'status' => true,
            'data' => $challan
        ]);
    }

    public function update(Request $request, $id) {
        $challan = Challan::findOrFail($id);
        $validate = $request->validate([
            'prahari_id' => 'required|exists:praharis,id',
            'case_id' => 'required|exists:cases,id',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:Paid,Pending,Cancelled',
            'Date' => 'required|date',
        ]);

        $challan->update($validate);

        return response()->json([
            'status' => true,
            'message' => 'Challan updated successfully',
            'data' => $challan
        ]);
    }

    public function destroy($id) {
        $challan = Challan::findOrFail($id);
        $challan->delete();

        return response()->json([
            'status' => true,
            'message' => 'Challan deleted successfully'
        ]);
    }
}
