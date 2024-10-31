<?php

namespace App\Helpers;

use App\Models\Transaction;

class ReportHelper
{
    public function dateRangeTransactions($startDate, $endDate)
    {
        $transactions = Transaction::with('accountName')
            ->select('account_name_id', 'trans_type', 'amount')
            ->whereBetween('voucher_at', [$startDate, $endDate])
            ->orderBy('account_name_id')
            ->get();
        return $transactions;
    }

    public function dateRangeReports($transactions)
    {
        $newTransactions = [];

        foreach ($transactions as $transaction) {
            $accountId = $transaction->account_name_id;
            $accountName = $transaction->accountName->name;
            $accountNameBn = $transaction->accountName->name_bn;
            $transType = $transaction->trans_type;
            $amount = $transaction->amount;

            if (isset($newTransactions[$accountId])) {
                // if (isset($newTransactions[$accountId][$transType])) {
                    $newTransactions[$accountId]['amount'] += $amount;
                // } else {
                //     $newTransactions[$accountId][$transType] = $amount;
                // }
            } else {
                $newTransactions[$accountId] = [
                    'accountName' => $accountName,
                    'accountNameBn' => $accountNameBn,
                    'transType' => $transType,
                    'amount' => $amount,
                ];
            }
        }
        return $newTransactions;
    }
}
