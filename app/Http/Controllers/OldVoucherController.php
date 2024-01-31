<?php

namespace App\Http\Controllers;

use App\Models\OldacName;
use App\Models\OldacType;
use App\Models\OldTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OldVoucherController extends Controller
{
    public function index()
    {
        $transCalcs = OldTransaction::all();
        $transactions = OldTransaction::with('oldacName')->latest()->paginate(25);

        return view('oldVouchers.index', compact('transactions', 'transCalcs'));
    }

    public function create()
    {
        $transCalcs = OldTransaction::all();

        $oldacNames = OldacName::all();
        $oldacTypes = OldacType::all();
        $parentAcs = OldacName::where('parent_id', 0)->get();
        return view('oldVouchers.create', compact('oldacNames', 'parentAcs', 'oldacTypes', 'transCalcs'));
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
        // DateTime object from the formatted string
        $voucher_at = Carbon::parse($voucherDateTimeString);

        $oldTransaction = OldTransaction::create([
            'voucher_at' => $voucher_at,
            'oldactype_id' => $oldactype_id,
            'oldacname_id' => $request->oldacname_id,
            'amount' => $request->amount,
            'details' => $request->details,
        ]);
        $request->flash();
        
        if ($oldTransaction) {
            return redirect()->route('oldVouchers')->with('success', 'Transaction successfully');
        } else {
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create transaction']);
        }
    }
    
    public function show(OldTransaction $transaction)
    {
        $transCalcs = OldTransaction::all();
        return view('oldVouchers.show', compact('transCalcs', 'transaction'));
    }
}
