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
        $transCalcs = OldTransaction::all();
        $transactions = OldTransaction::with('oldacName')->latest()->paginate(25);

        return view('oldTransactions.index', compact('transactions', 'transCalcs'));
    }

    public function show(Request $request)
    {
        $transCalcs = OldTransaction::all();

        $this->validate($request, [
            'startDate' => 'required',
            'endDate' => 'required',
        ]);

        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $startTime = '00:00:01';
        $endTime = '23:59:59';

        // Combine date and time strings
        $startDateTimeString = $startDate . ' ' . $startTime;
        $endDateTimeString = $endDate . ' ' . $endTime;

        // DateTime object from the formatted string
        $startDateTime = Carbon::parse($startDateTimeString);
        $endDateTime = Carbon::parse($endDateTimeString);

        $preTransactions = OldTransaction::where('created_at', '<', $startDateTime)
            ->oldest()
            ->get();

        $transactions = OldTransaction::whereBetween('created_at', [$startDateTime, $endDateTime])
            ->oldest()
            ->get();

        $request->flash();

        return view('oldTransactions.show', compact('transCalcs', 'preTransactions', 'transactions'));
    }
}
