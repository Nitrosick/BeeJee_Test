<?php

class DB
{
    public static function getConnection()
    {
        $paramsPath = ROOT . '/app/config/db.php';
        $params = include $paramsPath;

        $db = new PDO("mysql:host={$params['host']};dbname={$params['dbname']}", $params['user'], $params['password']);

        return $db;
    }
}
