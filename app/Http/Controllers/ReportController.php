<?php

namespace App\Http\Controllers;

use App\Helpers\ReportHelper;
use Carbon\Carbon;
use App\Models\AccountName;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Helpers\VoucherHelper;
use App\Helpers\TransactionHelper;

class ReportController extends Controller
{
    protected $balance;
    protected $transactionHelper;
    protected $reportHelper;

    public function __construct(VoucherHelper $voucherHelper, TransactionHelper $transactionHelper, ReportHelper $reportHelper)
    {
        $this->balance = $voucherHelper->getBalance();
        $this->transactionHelper = $transactionHelper;
        $this->reportHelper = $reportHelper;
    }

    public function index()
    {
        $balance = $this->balance;
        $accountNames = AccountName::all();
        $startDate = Carbon::now()->startOfMonth()->toDateString();
        $endDate = Carbon::now()->endOfMonth()->toDateString();
        // $transactions = Transaction::with('accountName')->latest()->paginate(10);
        // $transactions = Transaction::with('accountName')->orderBy('id', 'desc')->paginate(10);
        // $transactions = Transaction::with('accountName')->orderBy('id', 'desc')->get();

        $openingBalance = $this->transactionHelper->dateWiseBalance($startDate);
        $transactions = $this->reportHelper->dateRangeTransactions($startDate, $endDate);
        $dateRangeReports = $this->reportHelper->dateRangeReports($transactions);

        return view('reports.index', compact('balance', 'accountNames', 'openingBalance', 'dateRangeReports'));
    }

    public function showDateRange(Request $request)
    {
        $balance = $this->balance;
        $accountNames = AccountName::all();

        $this->validate($request, [
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);

        $startDate = $this->transactionHelper->getDateTime('startDate', $request->startDate);
        $endDate = $this->transactionHelper->getDateTime('endDate', $request->endDate);

        $openingBalance = $this->transactionHelper->dateWiseBalance($startDate);
        $transactions = $this->reportHelper->dateRangeTransactions($startDate, $endDate);
        $dateRangeReports = $this->reportHelper->dateRangeReports($transactions);

        return view('reports.show-date-range-report', compact('balance', 'accountNames', 'openingBalance', 'dateRangeReports'));
    }

    public function showAccountWise(Request $request)
    {
        $balance = $this->balance;
        $accountNames = AccountName::all();

        $this->validate($request, [
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'account_name_id' => 'required',
        ]);

        $startDate = $this->transactionHelper->getDateTime('startDate', $request->startDate);
        $endDate = $this->transactionHelper->getDateTime('endDate', $request->endDate);
        $accountNameId = $request->account_name_id;

        $transactions = Transaction::where('account_name_id', $accountNameId)
            ->whereBetween('voucher_at', [$startDate, $endDate])
            ->oldest()
            ->get();

        $request->flash();

        return view('reports.show-account-date-range-report', compact('balance', 'accountNames', 'transactions'));
        // return view('reports.show', array_merge(['balance' => $balance], ['balance' => $accountNames], $transactions));
    }
}
