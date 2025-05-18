<?php
namespace Config;

class Database {
    private static $instance = null;
    private $connection;
    
    private function __construct() {
        $this->connection = new \PDO(
            "pgsql:
                host=localhost;
                dbname=akatsuki_travel",
                "postgres",
                "root",
            [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
        );
    }
    
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->connection;
    }
}