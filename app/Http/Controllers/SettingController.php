<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index(){
        $user = auth()->user();
        
        $settingsDb = Setting::pluck('value', 'key')->toArray();
        $globalModules = [
            'module_dashboard' => $settingsDb['module_dashboard'] ?? '1',
            'module_payments' => $settingsDb['module_payments'] ?? '1',
            'module_reports' => $settingsDb['module_reports'] ?? '1',
            'module_challans' => $settingsDb['module_challans'] ?? '1',
        ];

        $systemConfig = [
            'website_name' => $settingsDb['website_name'] ?? 'Prahari Management',
            'admin_contact' => $settingsDb['admin_contact'] ?? 'admin@prahari.com',
            'revenue_percentage' => $settingsDb['revenue_percentage'] ?? '10',
            'default_status' => $settingsDb['default_status'] ?? 'Active',
        ];

        // Fetch dependencies for modals and tabs
        $praharis = \App\Models\Prahari::all();
        $categories = \App\Models\Category::all();
        $cases = \App\Models\Cases::all();

        // Stats for quick actions
        $totalPrahari = \App\Models\Prahari::count();
        $totalCases = \App\Models\Cases::count();
        $totalChallans = \App\Models\Challan::count();
        $totalRevenue = \App\Models\Payment::where('status', 'Approved')->sum('amount') ?? 0;

        // PRAHARI PERFORMANCE
        $prahariPerformance = \App\Models\Prahari::withCount(['cases', 'challans'])
            ->get()
            ->map(function ($prahari) {
                $prahari->total_earnings = \App\Models\Payment::where('prahari_id', $prahari->id)
                    ->where('status', 'Approved')->sum('amount');
                return $prahari;
            });

        // CHART DATA (Last 6 Months)
        $months = [];
        $casesData = [];
        $revenueData = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = \Carbon\Carbon::now()->subMonths($i);
            $months[] = $date->format('M');
            
            $casesData[] = \App\Models\Cases::whereYear('created_at', $date->year)
                                ->whereMonth('created_at', $date->month)
                                ->count();
                                
            $revenueData[] = \App\Models\Payment::where('status', 'Approved')
                                ->whereYear('date', $date->year)
                                ->whereMonth('date', $date->month)
                                ->sum('amount');
        }

        return view('admin.settings', compact(
            'user', 'globalModules', 'systemConfig', 'praharis', 'categories', 'cases',
            'totalPrahari', 'totalCases', 'totalChallans', 'totalRevenue',
            'prahariPerformance', 'months', 'casesData', 'revenueData'
        ));
    }

    public function update(Request $request){
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'current_password' => 'nullable|string',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($request->filled('current_password')) {
            if (!\Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
            }
            if ($request->filled('password')) {
                $user->password = \Hash::make($request->password);
            }
        } elseif ($request->filled('password')) {
             return back()->withErrors(['current_password' => 'Please enter your current password to change it.']);
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();

        // Update global modules
        $modules = [
            'module_dashboard',
            'module_payments',
            'module_reports',
            'module_challans',
        ];

        foreach ($modules as $module) {
            Setting::updateOrCreate(
                ['key' => $module],
                ['value' => $request->has($module) ? '1' : '0']
            );
        }

        return back()->with('success', 'Account Settings updated successfully.')->with('active_tab', 'account');
    }

    public function updateSystemConfig(Request $request){
        $validated = $request->validate([
            'website_name' => 'required|string|max:255',
            'admin_contact' => 'required|string|email|max:255',
            'revenue_percentage' => 'required|numeric|min:0|max:100',
            'default_status' => 'required|string',
        ]);

        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return back()->with('success', 'System Configurations updated successfully.')->with('active_tab', 'config');
    }
}
