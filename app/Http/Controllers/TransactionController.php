<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTransactionRequest;
use App\Models\AccountCategory;
use App\Models\AccountMeta;
use App\Models\AccountName;
use App\Models\AccountType;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store']);
    }

    public function index()
    {
        $accountTypes = AccountType::all();
        $accountCategories = AccountCategory::all();
        $accountNames = AccountName::all();
        $transactions = Transaction::all();
        return view('transactions.index', compact('accountTypes', 'accountCategories', 'accountNames', 'transactions'));
    }

    public function create()
    {
        $accountTypes = AccountType::all();
        $accountCategories = AccountCategory::all();
        $accountNames = AccountName::all();
        return view('transactions.create', compact('accountTypes', 'accountCategories', 'accountNames'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'accountname_id' => 'required',
            'amount' => 'required',
            'detail' => 'required',
        ]);

        // $accountName = AccountName::where('id', $request->accountname_id)->first();
        $transaction = $request->user()->transactions()->create([
            'accountname_id' => $request->accountname_id,
            'amount' => $request->amount,
            'detail' => $request->detail,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction successfully');
    }

    public function edit(Transaction $transaction)
    {
        $accountTypes = AccountType::all();
        $accountCategories = AccountCategory::all();
        $accountNames = AccountName::all();

        return view('transactions.edit', compact('accountTypes', 'accountCategories', 'accountNames', 'transaction'));
    }

    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $transaction->update($request->validated());
        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully');
    }

    public function show(Request $request)
    {
        $accountTypes = AccountType::all();
        $accountCategories = AccountCategory::all();
        $accountNames = AccountName::all();
        $transactions = Transaction::all();

        dd($request->dateFrom);
        return view('transactions.show', compact('accountTypes', 'accountCategories', 'accountNames', 'transactions'));
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully');
    }
}
