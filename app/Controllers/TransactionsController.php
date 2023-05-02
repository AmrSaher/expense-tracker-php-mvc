<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Transaction;
use App\View;

class TransactionsController
{
    public function index() : View
    {
        $transactionModel = new Transaction();
        $transactions = $transactionModel->all();

        $totals = [
            'netTotal' => 0,
            'totalIncome' => 0,
            'totalExpense' => 0
        ];
    
        foreach($transactions as $transaction) {
            $amount = (float) str_replace('$', '', $transaction['amount']);
            $totals['netTotal'] += $amount;
            if ($amount >= 0) {
                $totals['totalIncome'] += $amount;
            } else {
                $totals['totalExpense'] += $amount;
            }
        }

        return View::make('transactions/index', [
            'transactions' => $transactions,
            'totals' => $totals
        ]);
    }
}