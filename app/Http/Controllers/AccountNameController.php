<?php

namespace App\Http\Controllers;

use App\Models\AccountName;
use Illuminate\Http\Request;
use App\Helpers\VoucherHelper;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AccountNameRequest;

class AccountNameController extends Controller
{
    protected $balance;

    public function __construct(VoucherHelper $voucherHelper)
    {
        $this->balance = $voucherHelper->getBalance();
    }

    public function index()
    {
        $balance = $this->balance;
        $accountNames = AccountName::with('topAccount')
            ->latest()->paginate(10);
        return view('account-names.index', compact('balance', 'accountNames'));
    }

    public function create()
    {
        $balance = $this->balance;
        $parentNames = AccountName::all();
        return view('account-names.create', compact('balance', 'parentNames'));
    }

    public function store(AccountNameRequest $request): RedirectResponse
    {
        AccountName::create([
            'name' => $request->name,
            'name_bn' => $request->name_bn,
            'parent_id' => $request->parent_id,
            'trans_type' => $request->trans_type,
            'account_group'=>$request->account_group,
        ]);

        return redirect()->route('account-names.index')
            ->with('success', 'Account name added successfully!');
    }

    public function show(string $id)
    {
        $balance = $this->balance;
        $accountName = AccountName::where('id', $id)
            ->with('topAccount')->first();
        return view('account-names.show', compact('balance', 'accountName'));
    }

    public function edit(string $id)
    {
        $balance = $this->balance;
        $accountName = AccountName::where('id', $id)->first();
        $parentNames = AccountName::all();
        return view('account-names.edit', compact('balance', 'accountName', 'parentNames'));
    }

    public function update(Request $request, string $id)
    {
        $accountName = AccountName::findOrFail($id);

        $accountName->update([
            'name' => $request->name,
            'name_bn' => $request->name_bn,
            'parent_id' => $request->parent_id,
            'trans_type' => $request->trans_type,
            'account_group'=>$request->account_group,
        ]);

        return redirect()->route('account-names.show', ['account_name' => $accountName->id])
            ->with('success', 'Account name updated successfully!');
    }

    public function destroy(string $id)
    {
        return view('account-names.index');
    }
}
