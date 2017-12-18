<?php

namespace Application\Components;

class DB 
{
    const DB_CONFIG_PATH = ROOT . 'config/db_params.php';
    
    public static function getConnection()
    {
        $config = include(self::DB_CONFIG_PATH);
        $dsn = "mysql:host={$config['host']};dbname={$config['name']}";
        
        try {
            $db = new \PDO($dsn, $config['user'], $config['pass']);
            $db->setAttribute(\PDO::ATTR_EMULATE_PREPARES, true);
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            
            return $db ?: false;
        } catch(\PDOException $e) {
            echo 'Database error';
            exit;
        }
    }
}
