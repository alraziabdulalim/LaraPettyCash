<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Helpers\VoucherHelper;
use App\Helpers\TransactionHelper;

class TransactionController extends Controller
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
        $currentMonthStart = Carbon::now()->startOfMonth()->toDateString();
        $currentMonthEnd = Carbon::now()->endOfMonth()->toDateString();
        // $transactions = Transaction::with('accountName')->latest()->paginate(10);
        // $transactions = Transaction::with('accountName')->orderBy('id', 'desc')->paginate(10);
        // $transactions = Transaction::with('accountName')->orderBy('id', 'desc')->get();

        $transactions = Transaction::with('accountName')
        ->whereBetween('voucher_at', [$currentMonthStart, $currentMonthEnd])
        ->orderBy('id', 'desc')
        ->get();

        return view('transactions.index', compact('balance', 'transactions'));
    }

    public function show(Request $request)
    {
        $balance = $this->balance;

        $this->validate($request, [
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);

        $startDate = $request->startDate;
        $endDate = $request->endDate;

        $startDate = $this->transactionHelper->getDateTime('startDate', $startDate);
        $endDate = $this->transactionHelper->getDateTime('endDate',  $endDate);

        $preBalance = $this->transactionHelper->dateWiseBalance($startDate);
        $transactions = $this->transactionHelper->getTransactions($startDate, $endDate);

        $request->flash();

        return view('transactions.show', compact('balance', 'transactions', 'preBalance'));
        // return view('transactions.show', array_merge(['balance' => $balance], $data));
    }
}
