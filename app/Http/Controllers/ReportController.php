<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use App\Models\Challan;
use App\Models\Payment;
use App\Models\Prahari;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        // TOTAL REPORTS
        $casesQuery = Cases::query();
        $challansQuery = Challan::query();
        $revenueQuery = Payment::where('status', 'Approved');

        if ($from && $to) {
            // Include end of day for the 'to' date to ensure records on that day are captured if created_at is timestamp
            $toDate = \Carbon\Carbon::parse($to)->endOfDay();
            $casesQuery->whereBetween('created_at', [$from, $toDate]);
            $challansQuery->whereBetween('created_at', [$from, $toDate]);
            $revenueQuery->whereBetween('date', [$from, $to]);
        }

        $totalCases = $casesQuery->count();
        $totalChallans = $challansQuery->count();
        $totalRevenue = $revenueQuery->sum('amount');


        // PRAHARI PERFORMANCE
        $prahariPerformance = Prahari::withCount([
                'cases' => function ($query) use ($from, $to) {
                    if ($from && $to) {
                        $toDate = \Carbon\Carbon::parse($to)->endOfDay();
                        $query->whereBetween('created_at', [$from, $toDate]);
                    }
                },
                'challans' => function ($query) use ($from, $to) {
                    if ($from && $to) {
                        $toDate = \Carbon\Carbon::parse($to)->endOfDay();
                        $query->whereBetween('created_at', [$from, $toDate]);
                    }
                }
            ])
            ->get()
            ->map(function ($prahari) use ($from, $to) {

                $paymentQuery = Payment::where('prahari_id', $prahari->id)
                    ->where('status', 'Approved');

                if ($from && $to) {
                    $paymentQuery->whereBetween('date', [$from, $to]);
                }

                $prahari->total_earnings = $paymentQuery->sum('amount');

                return $prahari;
            });


        // CHART DATA (Last 6 Months)
        $months = [];
        $casesData = [];
        $revenueData = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = \Carbon\Carbon::now()->subMonths($i);
            $months[] = $date->format('M');
            
            $casesData[] = Cases::whereYear('created_at', $date->year)
                                ->whereMonth('created_at', $date->month)
                                ->count();
                                
            $revenueData[] = Payment::where('status', 'Approved')
                                ->whereYear('date', $date->year)
                                ->whereMonth('date', $date->month)
                                ->sum('amount');
        }

        return view('admin.report', compact(
            'totalCases',
            'totalChallans',
            'totalRevenue',
            'prahariPerformance',
            'months',
            'casesData',
            'revenueData'
        ));
    }


    // EXPORT CSV
    public function exportCSV()
    {
        $fileName = 'reports.csv';

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
        ];

        $callback = function () {

            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'Prahari',
                'Cases',
                'Challans',
                'Status'
            ]);

            $praharis = Prahari::withCount([
                'cases',
                'challans'
            ])->get();

            foreach ($praharis as $prahari) {

                fputcsv($file, [
                    $prahari->Prahari,
                    $prahari->cases_count,
                    $prahari->challans_count,
                    $prahari->status,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }


    // EXPORT PDF
public function exportPDF()
{
    $praharis = Prahari::withCount([
        'cases',
        'challans'
    ])->get();

    $pdf = Pdf::loadView(
        'admin.pdf',
        compact('praharis')
    );

    return $pdf->download('reports.pdf');
}
}