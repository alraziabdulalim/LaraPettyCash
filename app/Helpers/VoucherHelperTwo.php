<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\AccountName;
use App\Models\Transaction;

class VoucherHelperTwo
{
    public function getBalance()
    {
        $transactions = Transaction::all();
        $balance = 0;

        foreach ($transactions as $transaction) {
            $balance += ($transaction->trans_type == 'Debit') ? $transaction->amount : - ($transaction->amount);
        }

        return $balance;
    }

    public function handleTransaction($request)
    {
        $this->validateRequest($request);
        $formattedData = $this->formatData($request);
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
        // Fetch account name and type
        $accountName = AccountName::findOrFail($request->account_name_id);
        $accountTypeId = $accountName->trans_type;

        // Combine voucher date and time
        $voucherDateTimeString = $request->voucher_at . ' ' . date('H:i:s');
        $voucherAt = Carbon::parse($voucherDateTimeString);

        // Return the formatted data
        return [
            'voucher_at' => $voucherAt,
            'trans_type' => $accountTypeId,
            'account_name_id' => $request->account_name_id,
            'amount' => $request->amount,
            'details' => $request->details,
        ];
    }

    protected function createTransaction($data)
    {
        return Transaction::create($data);
    }

    protected function updateTransaction($transaction, $data)
    {
        $transaction->voucher_at = $data['voucher_at'];
        $transaction->trans_type = $data['trans_type'];
        $transaction->account_name_id = $data['account_name_id'];
        $transaction->amount = $data['amount'];
        $transaction->details = $data['details'];

        return $transaction->save();
    }

    public function parentAccountName()
    {
        $parentNames = AccountName::where('parent_id', NULL)->get();
    }
}
