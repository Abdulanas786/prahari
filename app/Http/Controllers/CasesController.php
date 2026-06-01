<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use App\Models\Prahari;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CasesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('export') && $request->export == 'csv') {
            $cases = Cases::with(['prahari', 'category'])->latest()->get();
            $csvData = "S.No,Case ID,Prahari Name,Type,Location,Status,Violation Date\n";
            foreach ($cases as $index => $c) {
                $pName = '"' . str_replace('"', '""', $c->prahari->Prahari ?? '-') . '"';
                $cType = '"' . str_replace('"', '""', $c->category->Type ?? '-') . '"';
                $loc = '"' . str_replace('"', '""', $c->Location ?? '-') . '"';
                $date = $c->violation_date ? date('d M Y', strtotime($c->violation_date)) : '-';
                $csvData .= ($index + 1) . "," . $c->id . "," . $pName . "," . $cType . "," . $loc . "," . $c->status . "," . $date . "\n";
            }
            return response($csvData)
                ->header('Content-Type', 'text/csv')
                ->header('Content-Disposition', 'attachment; filename="cases.csv"');
        }

        if ($request->ajax()) {

            $cases = Cases::with(['prahari', 'category'])->latest();

            return DataTables::of($cases)
                ->addIndexColumn()

                ->addColumn('prahari_name', function ($row) {
                    return $row->prahari->Prahari ?? '-';
                })

                ->addColumn('category_name', function ($row) {
                    return $row->category->Type ?? '-';
                })

                ->addColumn('Location', function ($row) {
                    return $row->Location;
                })

                ->addColumn('status', function ($row) {
                    return '<span class="badge bg-info">'.$row->status.'</span>';
                })

                ->addColumn('violation_date', function ($row) {
                    return date('d M Y', strtotime($row->violation_date));
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

        // normal page load
        $praharis = Prahari::all();
        $categories = Category::all();

        return view('admin.cases', compact('praharis', 'categories'));
    }

    public function store(Request $request) {
        $validate = $request->validate([
            'prahari_id' => 'required|exists:praharis,id',
            'category_id' => 'required|exists:categories,id',
            'Location' => 'required|string|max:255',
            'evidence_file' => 'nullable|string|max:255',
            'status' => 'required|in:Open,In Progress,Closed',
            'violation_date' => 'required|date',
        ]);

        $case = Cases::create($validate);

        return response()->json([
            'status' => true,
            'message' => 'Case created successfully',
            'data' => $case
        ]);
    }

    public function edit($id) {
        $case = Cases::with(['prahari', 'category'])->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $case
        ]);
    }

    public function update(Request $request, $id) {
        $case = Cases::findOrFail($id);

        $validate = $request->validate([
            'prahari_id' => 'required|exists:praharis,id',
            'category_id' => 'required|exists:categories,id',
            'Location' => 'required|string|max:255',
            'evidence_file' => 'nullable|string|max:255',
            'status' => 'required|in:Open,In Progress,Closed',
            'violation_date' => 'required|date',
        ]);

        $case->update($validate);

        return response()->json([
            'status' => true,
            'message' => 'Case updated successfully',
            'data' => $case
        ]);
    }

    public function destroy($id) {
        $case = Cases::findOrFail($id);
        $case->delete();

        return response()->json([
            'status' => true,
            'message' => 'Case deleted successfully'
        ]);
    }
}
