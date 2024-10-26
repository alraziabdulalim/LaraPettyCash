<?php

namespace App\Http\Controllers;

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

    public function __construct(VoucherHelper $voucherHelper, TransactionHelper $transactionHelper)
    {
        $this->balance = $voucherHelper->getBalance();
        $this->transactionHelper = $transactionHelper;
    }

    public function index()
    {
        $balance = $this->balance;
        $accountNames = AccountName::all();
        $currentMonthStart = Carbon::now()->startOfMonth()->toDateString();
        $currentMonthEnd = Carbon::now()->endOfMonth()->toDateString();
        // $transactions = Transaction::with('accountName')->latest()->paginate(10);
        // $transactions = Transaction::with('accountName')->orderBy('id', 'desc')->paginate(10);
        // $transactions = Transaction::with('accountName')->orderBy('id', 'desc')->get();

        $transactions = Transaction::with('accountName')
            ->whereBetween('voucher_at', [$currentMonthStart, $currentMonthEnd])
            ->orderBy('id', 'desc')
            ->get();

        return view('reports.index', compact('balance', 'accountNames', 'transactions'));
    }

    public function show(Request $request)
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
            ->whereBetween('created_at', [$startDate, $endDate])
            ->oldest()
            ->get();

        $request->flash();

        return view('reports.show', compact('balance', 'accountNames', 'transactions'));
        // return view('reports.show', array_merge(['balance' => $balance], ['balance' => $accountNames], $transactions));
    }
}
