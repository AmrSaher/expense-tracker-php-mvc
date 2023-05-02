<!DOCTYPE html>
<html>
    <head>
        <title>Transactions</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            table tr th, table tr td {
                padding: 5px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: right;
            }
        </style>
    </head>
    <body>
        <a href="/" style="font-size: 20px; font-weight: bold; text-decoration: none;"><-</a>
        <hr />
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check #</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($transactions as $transaction): ?>
                    <tr>
                        <td><?= $transaction['date'] ?></td>
                        <td><?= $transaction['check'] ?></td>
                        <td><?= $transaction['description'] ?></td>
                        <td style="font-weight: bold; color: <?= (float) str_replace('$', '', $transaction['amount']) > 0 ? 'green' : ((float) str_replace('$', '', $transaction['amount']) == 0 ? 'black' : 'red') ?>"><?= $transaction['amount'] ?></td>
                    </tr>    
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Income:</th>
                    <td style="font-weight: bold; color: green;"><?= '$' . $totals['totalIncome'] ?></td>
                </tr>
                <tr>
                    <th colspan="3">Total Expense:</th>
                    <td style="font-weight: bold; color: red;"><?= '-$' . abs($totals['totalExpense']) ?></td>
                </tr>
                <tr>
                    <th colspan="3">Net Total:</th>
                    <td><?= '$' . $totals['netTotal'] ?></td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
