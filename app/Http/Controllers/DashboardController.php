<?php

namespace App\Http\Controllers;

use App\Models\Prahari;
use App\Models\Cases;
use App\Models\Challan;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboardAdmin(Request $request) {
        
        $totalPrahari = Prahari::count();
        $totalCases = Cases::count();
        $totalChallans = Challan::count();
        
        $totalRevenue = Payment::sum('amount') ?? 0;
        
        $pendingWithdrawals = Payment::where('status', 'pending')
                                    ->orWhere('status', 'Pending')
                                    ->sum('amount') ?? 0;
        
        $todaysDate = now()->toDateString();
        $todaysCases = Cases::whereDate('created_at', $todaysDate)->count();
        $todaysChallans = Challan::whereDate('created_at', $todaysDate)->count();
        
        $activePrahari = Prahari::where('status', 'Active')
                               ->orWhere('status', 'active')
                               ->count();
        
        $filter = $request->filter ?? 'week';
        $overviewData = $this->getOverviewData($filter);
        $casesTrend = $overviewData['casesTrend'];
        $challanTrendData = $overviewData['challanTrend'];
        $chartLabels = $overviewData['labels'];
        
        $activeFilterText = 'This Week';
        if ($filter == 'month') $activeFilterText = 'This Month';
        if ($filter == 'year') $activeFilterText = 'This Year';
        
        $challanStatus = $this->getChallanStatusBreakdown();
        
        return view('admin.dashboard', [
            'totalPrahari' => $totalPrahari,
            'totalCases' => $totalCases,
            'totalChallans' => $totalChallans,
            'totalRevenue' => $totalRevenue,
            'pendingWithdrawals' => $pendingWithdrawals,
            'todaysCases' => $todaysCases,
            'todaysChallans' => $todaysChallans,
            'activePrahari' => $activePrahari,
            'casesTrend' => $casesTrend,
            'challanTrendData' => $challanTrendData,
            'chartLabels' => $chartLabels,
            'challanStatus' => $challanStatus,
            'activeFilterText' => $activeFilterText,
        ]);
    }
    
    private function getOverviewData($filter) {
        $casesTrend = [];
        $challanTrend = [];
        $labels = [];

        if ($filter == 'month') {
            for ($i = 29; $i >= 0; $i -= 2) {
                // To avoid 30 labels cluttering, let's step by 2 days or just return all 30
                $date = now()->subDays($i);
                $casesTrend[] = Cases::whereDate('created_at', $date->toDateString())->count() 
                              + Cases::whereDate('created_at', $date->copy()->addDay()->toDateString())->count();
                $challanTrend[] = Challan::whereDate('created_at', $date->toDateString())->count()
                                + Challan::whereDate('created_at', $date->copy()->addDay()->toDateString())->count();
                $labels[] = $date->format('d M');
            }
        } elseif ($filter == 'year') {
            for ($i = 11; $i >= 0; $i--) {
                $date = now()->subMonths($i);
                $casesTrend[] = Cases::whereYear('created_at', $date->year)->whereMonth('created_at', $date->month)->count();
                $challanTrend[] = Challan::whereYear('created_at', $date->year)->whereMonth('created_at', $date->month)->count();
                $labels[] = $date->format('M');
            }
        } else {
            // Default: This Week
            for ($i = 6; $i >= 0; $i--) {
                $date = now()->subDays($i);
                $casesTrend[] = Cases::whereDate('created_at', $date->toDateString())->count();
                $challanTrend[] = Challan::whereDate('created_at', $date->toDateString())->count();
                $labels[] = $date->format('D');
            }
        }

        return [
            'casesTrend' => $casesTrend,
            'challanTrend' => $challanTrend,
            'labels' => $labels
        ];
    }
    
    private function getChallanStatusBreakdown() {
        $statuses = Challan::select('status', DB::raw('count(*) as total'))
                          ->groupBy('status')
                          ->get();
        
        $breakdown = ['Paid' => 0, 'Pending' => 0, 'Cancelled' => 0];
        
        foreach ($statuses as $status) {
            $key = ucfirst(strtolower($status->status));
            if (array_key_exists($key, $breakdown)) {
                $breakdown[$key] = $status->total;
            }
        }
        
        return $breakdown;
    }
}
