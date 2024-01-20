<?php

namespace App\Http\Controllers;

use App\Models\OldacName;
use App\Models\OldacType;
use App\Models\OldTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OldTransactionController extends Controller
{
    public function index()
    {
        $transactions = OldTransaction::with('oldacName')->latest()->paginate(10);

        return view('oldTransactions.index', compact('transactions'));
    }

    public function create()
    {
        $transactions = OldTransaction::all();

        $oldacNames = OldacName::all();
        $oldacTypes = OldacType::all();
        // $parentAcs = OldacName::whereBetween('id', [1, 7])->get();
        $parentAcs = OldacName::where('parent_id', 0)->get();
        return view('oldTransactions.create', compact('oldacNames', 'parentAcs', 'oldacTypes', 'transactions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'voucher_at' => 'required',
            'oldactype_id' => 'required',
            'oldacname_id' => 'required',
            'amount' => 'required',
            'details' => 'required',
        ]);

        $oldacname_id = $request->oldacname_id;
        $Oldacnames = OldacName::firstWhere('id', $oldacname_id);
        $oldactype_id = $Oldacnames->oldactype_id;
        // timestamp remake
        $voucher_date = $request->voucher_at;
        $voucher_time = date('H:i:s');
        // Combine date and time strings
        $voucherDateTimeString = $voucher_date . ' ' . $voucher_time;
        // Create a DateTime object from the formatted string
        $voucher_at = Carbon::parse($voucherDateTimeString);

        $oldTransaction = OldTransaction::create([
            'voucher_at' => $voucher_at,
            'oldactype_id' => $oldactype_id,
            'oldacname_id' => $request->oldacname_id,
            'amount' => $request->amount,
            'details' => $request->details,
        ]);
        // You can also flash the input data to be available for the next request
        $request->flash();

        // Redirect back with the old input and an error message if validation fails
        if ($oldTransaction) {
            return redirect()->route('oldTransactions')->with('success', 'Transaction successfully');
        } else {
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create transaction']);
        }
    }

    public function show()
    {
        $transactions = OldTransaction::with('oldacName')->oldest()->paginate(10);

        return view('oldTransactions.show', compact('transactions'));
    }
}
