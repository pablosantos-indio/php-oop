<?php

declare(strict_types=1);

namespace App\DB;

use PDO;
use App\Config;

class DBConnection
{
    private $connection;

    public function __construct()
    {
        $host = Config::DB_HOST;
        $database = Config::DB_NAME;
        $user = Config::DB_USER;
        $password = Config::DB_PASS;

        $this->connection = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
