<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Prahari;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PaymentController extends Controller
{
    public function index(Request $request) {
        if ($request->has('export') && $request->export == 'csv') {
            if ($request->has('tab') && $request->tab === 'all') {
                $payments = \DB::table('payments')
                    ->join('praharis', 'payments.prahari_id', '=', 'praharis.id')
                    ->select('payments.id', 'payments.prahari_id', 'praharis.Prahari as prahari_name', 'payments.bank_account', 'payments.amount', 'payments.status', 'payments.date as transaction_date', \DB::raw("'Payment' as type"));

                $challans = \DB::table('challans')
                    ->join('praharis', 'challans.prahari_id', '=', 'praharis.id')
                    ->join('categories', 'challans.category_id', '=', 'categories.id')
                    ->select('challans.id', 'challans.prahari_id', 'praharis.Prahari as prahari_name', \DB::raw("'-' as bank_account"), 'categories.Amount as amount', 'challans.status', 'challans.Date as transaction_date', \DB::raw("'Challan' as type"));

                $query = $payments->union($challans);
                
                $data = \DB::table(\DB::raw("({$query->toSql()}) as transactions"))
                            ->mergeBindings($query)->get();
            } else {
                $data = \DB::table('payments')
                    ->join('praharis', 'payments.prahari_id', '=', 'praharis.id')
                    ->select('payments.id', 'payments.prahari_id', 'praharis.Prahari as prahari_name', 'payments.bank_account', 'payments.amount', 'payments.status', 'payments.date as transaction_date', \DB::raw("'Payment' as type"))->get();
            }

            $csvData = "Request ID,Prahari,Amount,Bank Account,Status,Date\n";
            foreach ($data as $row) {
                $reqId = $row->type === 'Payment' ? 'WD' . (1000 + $row->id) : 'CH' . (1000 + $row->id);
                $pName = '"' . str_replace('"', '""', $row->prahari_name ?? '-') . '"';
                $bankAcc = '"' . str_replace('"', '""', $row->bank_account ?? '-') . '"';
                $date = $row->transaction_date ? date('d M Y', strtotime($row->transaction_date)) : '-';
                $csvData .= $reqId . "," . $pName . "," . $row->amount . "," . $bankAcc . "," . ucfirst($row->status) . "," . $date . "\n";
            }
            return response($csvData)
                ->header('Content-Type', 'text/csv')
                ->header('Content-Disposition', 'attachment; filename="transactions.csv"');
        }

        if ($request->ajax()) {
            if ($request->has('tab') && $request->tab === 'all') {
                $payments = \DB::table('payments')
                    ->join('praharis', 'payments.prahari_id', '=', 'praharis.id')
                    ->select('payments.id', 'payments.prahari_id', 'praharis.Prahari as prahari_name', 'payments.bank_account', 'payments.amount', 'payments.status', 'payments.date as transaction_date', \DB::raw("'Payment' as type"));

                $challans = \DB::table('challans')
                    ->join('praharis', 'challans.prahari_id', '=', 'praharis.id')
                    ->join('categories', 'challans.category_id', '=', 'categories.id')
                    ->select('challans.id', 'challans.prahari_id', 'praharis.Prahari as prahari_name', \DB::raw("'-' as bank_account"), 'categories.Amount as amount', 'challans.status', 'challans.Date as transaction_date', \DB::raw("'Challan' as type"));

                $query = $payments->union($challans);
                
                $query = \DB::table(\DB::raw("({$query->toSql()}) as transactions"))
                            ->mergeBindings($query);
            } else {
                $query = \DB::table('payments')
                    ->join('praharis', 'payments.prahari_id', '=', 'praharis.id')
                    ->select('payments.id', 'payments.prahari_id', 'praharis.Prahari as prahari_name', 'payments.bank_account', 'payments.amount', 'payments.status', 'payments.date as transaction_date', \DB::raw("'Payment' as type"));
            }

            return DataTables::of($query)
                ->filterColumn('prahari_name', function($query, $keyword) use ($request) {
                    if ($request->has('tab') && $request->tab === 'all') {
                        $query->whereRaw("LOWER(transactions.prahari_name) like ?", ["%".strtolower($keyword)."%"]);
                    } else {
                        $query->whereRaw("LOWER(praharis.Prahari) like ?", ["%".strtolower($keyword)."%"]);
                    }
                })
                ->filterColumn('date', function($query, $keyword) use ($request) {
                    if ($request->has('tab') && $request->tab === 'all') {
                        $query->whereRaw("transactions.transaction_date like ?", ["%{$keyword}%"]);
                    } else {
                        $query->whereRaw("payments.date like ?", ["%{$keyword}%"]);
                    }
                })
                ->addColumn('request_id', function ($row) {
                    if ($row->type === 'Payment') {
                        return 'WD' . (1000 + $row->id);
                    } else {
                        return 'CH' . (1000 + $row->id);
                    }
                })
                ->addColumn('bank_account', function ($row) {
                    if ($row->bank_account === '-') return '-';
                    $len = strlen($row->bank_account);
                    if ($len <= 4) return $row->bank_account;
                    return str_repeat('*', 8) . substr($row->bank_account, -4);
                })
                ->addColumn('amount', function ($row) {
                    return '₹ ' . number_format($row->amount, 0);
                })
                ->addColumn('status', function ($row) {
                    return ucfirst($row->status);
                })
                ->addColumn('date', function ($row) {
                    return $row->transaction_date ? date('d M Y', strtotime($row->transaction_date)) : '-';
                })
                ->addColumn('action', function ($row) use ($request) {
                    $deleteBtn = '<button class="btn btn-sm btn-danger text-white shadow-sm border-0 deleteBtn" data-id="'.$row->id.'" data-type="'.strtolower($row->type).'">Delete</button>';
                    
                    if ($request->has('tab') && $request->tab === 'all') {
                        return $deleteBtn;
                    }

                    if ($row->type === 'Payment') {
                        $approveBtn = $row->status !== 'Approved' 
                            ? '<button class="btn btn-sm btn-success text-white shadow-sm border-0 me-1 approveBtn" data-id="'.$row->id.'">Approve</button>' 
                            : '<button class="btn btn-sm btn-secondary text-white shadow-sm border-0 me-1" disabled>Approved</button>';

                        return $approveBtn . $deleteBtn;
                    }
                    return '-';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $praharis = Prahari::all();
        return view('admin.payments', compact('praharis'));
    }

    public function store(Request $request) {
        $prahari = null;
        if ($request->has('prahari_id')) {
            $prahari = Prahari::find($request->prahari_id);
        }

        if ($prahari) {
            if (!$request->has('bank_account') || is_null($request->bank_account)) {
                $request->merge(['bank_account' => $prahari->Bank_account_detail]);
            }

            if (!$request->has('amount') || is_null($request->amount)) {
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
                $request->merge(['amount' => $amount]);
            }
        }

        $validate = $request->validate([
            'prahari_id' => 'required|exists:praharis,id',
            'bank_account' => 'required|string',
            'amount' => 'required|numeric|min:0.01',
            'status' => 'required|string',
            'date' => 'required|date',
        ], [
            'amount.min' => 'The selected Prahari does not have any cases or challans with a valid category amount.'
        ]);

        $payment = Payment::where('prahari_id', $validate['prahari_id'])
            ->where('bank_account', $validate['bank_account'])
            ->first();

        if ($payment) {
            $payment->amount += $validate['amount'];
            $payment->status = $validate['status'];
            $payment->date = $validate['date'];
            $payment->save();
            $message = 'Payment accumulated successfully';
        } else {
            $payment = Payment::create($validate);
            $message = 'Payment recorded successfully';
        }

        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $payment
        ]);
    }

    public function edit($id) {
        $payment = Payment::findOrFail($id);
        return response()->json([
            'status' => true,
            'data' => $payment
        ]);
    }

    public function update(Request $request, $id) {
        $payment = Payment::findOrFail($id);

        $prahari = null;
        if ($request->has('prahari_id')) {
            $prahari = Prahari::find($request->prahari_id);
        }

        if ($prahari) {
            if (!$request->has('bank_account') || is_null($request->bank_account)) {
                $request->merge(['bank_account' => $prahari->Bank_account_detail]);
            }

            if (!$request->has('amount') || is_null($request->amount)) {
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
                $request->merge(['amount' => $amount]);
            }
        }

        $validate = $request->validate([
            'prahari_id' => 'required|exists:praharis,id',
            'bank_account' => 'required|string',
            'amount' => 'required|numeric|min:0.01',
            'status' => 'required|string',
            'date' => 'required|date',
        ], [
            'amount.min' => 'The selected Prahari does not have any cases or challans with a valid category amount.'
        ]);

        $payment->update($validate);

        return response()->json([
            'status' => true,
            'message' => 'Payment updated successfully',
            'data' => $payment
        ]);
    }

    public function destroy($id) {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return response()->json([
            'status' => true,
            'message' => 'Payment deleted successfully'
        ]);
    }

    public function approve($id) {
        $payment = Payment::findOrFail($id);
        $payment->status = 'Approved';
        $payment->save();

        return response()->json([
            'status' => true,
            'message' => 'Payment approved successfully'
        ]);
    }
}
