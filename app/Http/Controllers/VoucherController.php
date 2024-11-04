<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\AccountName;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Helpers\VoucherHelper;
use App\Http\Requests\UpdateTransactionRequest;

class VoucherController extends Controller
{
    protected $balance;
    protected $voucherHelper;

    public function __construct(VoucherHelper $voucherHelper)
    {
        $this->balance = $voucherHelper->getBalance();
        $this->voucherHelper = $voucherHelper;
    }

    public function index()
    {
        $balance = $this->balance;
        $currentMonthStart = Carbon::now()->startOfMonth()->toDateString();
        $currentMonthEnd = Carbon::now()->endOfMonth()->toDateString();
        // $transactions = Transaction::with('accountName')->latest()->paginate(10);
        // $transactions = Transaction::with('accountName')->orderBy('id', 'desc')->paginate(10);

        $transactions = Transaction::with('accountName')
        ->whereBetween('voucher_at', [$currentMonthStart, $currentMonthEnd])
        ->orderBy('id', 'desc')
        ->paginate(10);

        return view('vouchers.index', compact('transactions', 'balance'));
    }

    public function create()
    {
        $balance = $this->balance;
        $accountNames = AccountName::all();
        $parentNames = $accountNames;
        // $parentNames = AccountName::where('parent_id', NULL)->get();
        return view('vouchers.create', compact('accountNames', 'parentNames', 'balance'));
    }

    public function store(Request $request)
    {
        $transactionCreated = $this->voucherHelper->handleTransaction($request);

        $request->flash();

        if ($transactionCreated) {
            return redirect()->route('vouchers.index')->with('success', 'Transaction created successfully.');
        } else {
            return redirect()->back()->withInput()->withErrors(['amount' => 'Insufficient balance to process the transaction.']);
        }
    }

    public function show(Transaction $voucher)
    {
        $balance = $this->balance;
        return view('vouchers.show', compact('balance', 'voucher'));
    }

    public function edit(Transaction $voucher)
    {
        $balance = $this->balance;
        $accountNames = AccountName::all();
        $parentNames = $accountNames;
        // $parentNames = AccountName::where('parent_id', 0)->get();
        return view('vouchers.edit', compact('voucher', 'balance', 'accountNames', 'parentNames'));
    }

    public function update(Request $request, Transaction $voucher)
    {
        $updated = $this->voucherHelper->handleUpdate($request, $voucher);

        if ($updated) {
            return redirect()->route('vouchers.show', ['voucher' => $voucher->id])
                 ->with('message', 'Transaction updated successfully.');
        } else {
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to update transaction.']);
        }
    }
}
