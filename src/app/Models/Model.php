<?php

namespace App\Models;

use App\DB\DBConnection;

class Model
{
    private DBConnection $DBConnection;

    public function __construct(string $lastName = null, string $firstName = null, string $address = null)
    {
        $this->DBConnection = new DBConnection();
    }

    public function getDBConnection(): DBConnection
    {
        return $this->DBConnection;
    }
}
