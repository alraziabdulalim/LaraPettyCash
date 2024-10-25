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
    // public function getBalance(): float
    // {
    //     return Transaction::sum(fn($transaction) => $transaction->trans_type === 'Debit' ? $transaction->amount : -$transaction->amount);
    // }

    public function handleTransaction($request)
    {
        $formattedData = $this->validateAndFormatData($request);
        if (!$formattedData || ($formattedData['trans_type'] === 'Credit' && !$this->hasSufficientBalance($formattedData['amount']))) {
            return false;
        }

        return $this->createTransaction($formattedData);
    }

    public function handleUpdate($request, $transaction)
    {
        $formattedData = $this->validateAndFormatData($request);
        if (!$formattedData || ($formattedData['trans_type'] === 'Credit' && !$this->hasSufficientBalanceForUpdate($formattedData['amount'], $transaction->amount))) {
            return false;
        }

        return $this->updateTransaction($transaction, $formattedData);
    }

    protected function validateAndFormatData($request): array|bool
    {
        $this->validateRequest($request);

        $accountName = AccountName::findOrFail($request->account_name_id);
        $voucherAt = Carbon::parse($request->voucher_at . ' ' . now()->format('H:i:s'));

        return [
            'user_id' => auth()->id(),
            'voucher_at' => $voucherAt,
            'trans_type' => $accountName->trans_type,
            'account_name_id' => $request->account_name_id,
            'amount' => $request->amount,
            'details' => $request->details,
        ];
    }

    protected function validateRequest($request): void
    {
        $request->validate([
            'voucher_at' => 'required|date',
            'account_name_id' => 'required|exists:account_names,id',
            'amount' => 'required|numeric|min:0',
            'details' => 'required|string|max:255',
        ]);
    }

    protected function hasSufficientBalance(float $amount): bool
    {
        return $this->getBalance() >= $amount;
    }

    protected function hasSufficientBalanceForUpdate(float $newAmount, float $originalAmount): bool
    {
        return $this->getBalance() >= max(0, $newAmount - $originalAmount);
    }

    protected function createTransaction(array $data)
    {
        return Transaction::create($data);
    }

    protected function updateTransaction($transaction, array $data): bool
    {
        return $transaction->update($data);
    }

    public function getParentAccountNames()
    {
        return AccountName::whereNull('parent_id')->get();
    }
}
