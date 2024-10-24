<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\Transaction;

class TransactionHelper
{
    public function getDate($date)
    {
        $date = Carbon::createFromFormat('d-m-Y', $date);
        $newDate = $date->format('Y-m-d');

        return $newDate;
    }

    public function getDateTime($key, $date)
    {
        $time = ($key === 'startDate') ? '00:00:01' : '23:59:59';
        $dateTime = Carbon::parse("{$date} {$time}");
        return $dateTime;
    }

    public function calcBalance($transactions)
    {
        $balance = 0;

        foreach ($transactions as $transaction) {
            $balance += ($transaction->trans_type == 'Debit') ? $transaction->amount : 0;
            $balance -= ($transaction->trans_type == 'Credit') ? $transaction->amount : 0;
        }
        return $balance;
    }

    public function dateWiseBalance($startDate)
    {
        $transactions = Transaction::select('amount', 'trans_type')
            ->where('created_at', '<', $startDate)
            ->oldest()
            ->get();

        return $balance = $this->calcBalance($transactions);
    }

    public function getTransactions($startDate, $endDate)
    {
        $transactions = Transaction::whereBetween('created_at', [$startDate, $endDate])
            ->oldest()
            ->get();

        return $transactions;
    }
}
