<?php
namespace App\Database;

class Database {
    public static function getConnection() {
        return new \mysqli("localhost", "root", "", "userlist");
    }
}
