<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\AccountName;
use App\Models\Transaction;

class VoucherHelper
{
    public function getBalance()
    {
        return Transaction::all()->reduce(function ($balance, $transaction) {
            return $balance + ($transaction->trans_type == 'Debit' ? $transaction->amount : -$transaction->amount);
        }, 0);
    }

    public function handleTransaction($request)
    {
        $this->validateRequest($request);
        $formattedData = $this->formatData($request);

        if ($formattedData == false) {
            return false;
        }

        return $this->createTransaction($formattedData);
    }

    public function handleUpdate($request, $transaction)
    {
        $this->validateRequest($request);
        $formattedData = $this->formatData($request);
        return $this->updateTransaction($transaction, $formattedData);
    }

    protected function validateRequest($request)
    {
        $request->validate([
            'voucher_at' => 'required',
            'account_name_id' => 'required',
            'amount' => 'required',
            'details' => 'required',
        ]);
    }

    protected function formatData($request)
    {
        $userId = auth()->id();
        $amount = $request->amount;

        $accountName = AccountName::findOrFail($request->account_name_id);
        $transType = $accountName->trans_type;

        $voucherAt = Carbon::parse($request->voucher_at . ' ' . date('H:i:s'));

        if ($transType == 'Credit' && $this->balanceChecker($amount) == false) {
            return false;
        }

        return [
            'user_id' => $userId,
            'voucher_at' => $voucherAt,
            'trans_type' => $transType,
            'account_name_id' => $request->account_name_id,
            'amount' => $amount,
            'details' => $request->details,
        ];
    }

    protected function balanceChecker($amount)
    {
        return $amount <= $this->getBalance();
    }

    protected function createTransaction($data)
    {
        return Transaction::create($data);
    }

    protected function updateTransaction($transaction, $data)
    {
        $transaction->fill($data);
        return $transaction->save();
    }

    public function getParentAccountNames()
    {
        return AccountName::whereNull('parent_id')->get();
    }
}
