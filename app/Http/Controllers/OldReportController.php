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
        $transCalcs = OldTransaction::all();
        $transactions = OldTransaction::with('oldacName')->latest()->paginate(25);

        return view('oldReports.index', compact('oldacNames', 'transactions', 'transCalcs'));
    }

    public function show(Request $request)
    {
        $transCalcs = OldTransaction::all();

        $this->validate($request, [
            'startDate' => 'required',
            'endDate' => 'required',
            'oldacname_id' => 'required',
        ]);

        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $oldacname_id = $request->oldacname_id;
        $startTime = '00:00:01';
        $endTime = '23:59:59';

        // Combine date and time strings
        $startDateTimeString = $startDate . ' ' . $startTime;
        $endDateTimeString = $endDate . ' ' . $endTime;

        // DateTime object from the formatted string
        $startDateTime = Carbon::parse($startDateTimeString);
        $endDateTime = Carbon::parse($endDateTimeString);

        $transactions = OldTransaction::where('oldacname_id', $oldacname_id)
            ->whereBetween('created_at', [$startDateTime, $endDateTime])
            ->oldest()
            ->get();


        $request->flash();

        return view('oldReports.show', compact('transCalcs', 'transactions'));
    }
}
