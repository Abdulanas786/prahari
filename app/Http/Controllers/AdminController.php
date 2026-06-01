<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function index(Request $request) {
        if ($request->has('export') && $request->export == 'csv') {
            $admins = User::where('role', 'sub-admin')->latest()->get();
            $csvData = "S.No,Name,Email,Permissions\n";
            foreach ($admins as $index => $admin) {
                $name = '"' . str_replace('"', '""', $admin->name) . '"';
                $email = '"' . str_replace('"', '""', $admin->email) . '"';
                $perms = empty($admin->permissions) ? '-' : collect($admin->permissions)->map(function ($p) {
                    return ucwords(str_replace('_', ' ', $p));
                })->implode(' | ');
                $perms = '"' . str_replace('"', '""', $perms) . '"';
                
                $csvData .= ($index + 1) . "," . $name . "," . $email . "," . $perms . "\n";
            }
            return response($csvData)
                ->header('Content-Type', 'text/csv')
                ->header('Content-Disposition', 'attachment; filename="sub_admins.csv"');
        }

        if ($request->ajax()) {
            $admins = User::where('role', 'sub-admin')->latest();

            return DataTables::of($admins)
                ->addIndexColumn()
                ->addColumn('permissions', function ($row) {
                    if (empty($row->permissions)) return '-';
                    $perms = collect($row->permissions)->map(function ($p) {
                        return '<span class="badge bg-secondary me-1">'.ucwords(str_replace('_', ' ', $p)).'</span>';
                    })->implode(' ');
                    return $perms;
                })
                ->addColumn('action', function ($row) {
                    return '
                        <button class="btn btn-sm btn-primary editBtn" data-id="'.$row->id.'">Edit</button>
                        <button class="btn btn-sm btn-danger deleteBtn" data-id="'.$row->id.'">Delete</button>
                    ';
                })
                ->rawColumns(['permissions', 'action'])
                ->make(true);
        }

        return view('admin.admin');
    }

    public function store(Request $request) {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'permissions' => 'nullable|array',
        ]);

        $validate['role'] = 'sub-admin';
        $validate['password'] = Hash::make($validate['password']);

        $user = User::create($validate);

        return response()->json([
            'status' => true,
            'message' => 'Sub-admin created successfully',
            'data' => $user
        ]);
    }

    public function edit($id) {
        $user = User::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $user
        ]);
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);

        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'password' => 'nullable|string|min:8',
            'permissions' => 'nullable|array',
        ]);

        if (!empty($validate['password'])) {
            $validate['password'] = Hash::make($validate['password']);
        } else {
            unset($validate['password']);
        }
        
        // Handle empty permissions
        if (!isset($validate['permissions'])) {
            $validate['permissions'] = [];
        }

        $user->update($validate);

        return response()->json([
            'status' => true,
            'message' => 'Sub-admin updated successfully',
            'data' => $user
        ]);
    }

    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sub-admin deleted successfully'
        ]);
    }
}
