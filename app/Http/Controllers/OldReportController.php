<?php

namespace App\Http\Controllers;

use App\Models\OldacName;
use App\Models\OldTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OldReportController extends Controller
{
    public function index()
    {
        $oldacNames = OldacName::all();
        $transactions = OldTransaction::with('oldacName')->latest()->paginate(10);

        return view('oldReports.index', compact('oldacNames', 'transactions'));
    }

    public function show(Request $request)
    {
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

        // Create a DateTime object from the formatted string
        $startDateTime = Carbon::parse($startDateTimeString);
        $endDateTime = Carbon::parse($endDateTimeString);

        $transactions = OldTransaction::whereBetween('created_at', [$startDateTime, $endDateTime])
            ->oldest()
            ->get();

        $preTransactions = OldTransaction::where('created_at', '<', $startDateTime)
            ->oldest()
            ->get();

        $request->flash();

        return view('oldReports.show', compact('transactions', 'preTransactions'));
    }
}
