<?php

declare(strict_types=1);

namespace App\Models;

use App\Model;

class Transaction extends Model 
{
    public function create(int $check, string $description, string $amount, string $date) : int 
    {
        $stmt = $this->db->prepare(
            "INSERT INTO `transactions` (`check`, `description`, amount, `date`) 
            VALUES (?, ?, ?, ?)"
        );

        $stmt->execute([$check, $description, $amount, $date]);

        return (int) $this->db->lastInsertId();
    }

    public function all() : array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM `transactions`"
        );

        $stmt->execute();

        return $stmt->fetchAll();
    }
}