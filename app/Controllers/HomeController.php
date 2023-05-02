<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\Models\Transaction;
use App\View;

class HomeController
{
    public function index(): View
    {
        return View::make('index');
    }

    public function upload()
    {
        $filePath = STORAGE_PATH . '/' . $_FILES['transactions_file']['name'];
        move_uploaded_file($_FILES['transactions_file']['tmp_name'], $filePath);

        $data = $this->csv2array($filePath);
        $transactionModel = new Transaction();

        foreach ($data as $transaction) {
            $transactionModel->create(
                (int) $transaction[1],
                $transaction[2],
                $transaction[3],
                $transaction[0]
            );
        }

        header('Location: /');
    }

    private function csv2array($path)
    {
        $file = fopen($path, 'r');
        $transactions = [];
        fgetcsv($file);

        while(($transaction = fgetcsv($file)) !== false) {
            $transactions[] = $transaction;
        }

        return $transactions;
    }
}
