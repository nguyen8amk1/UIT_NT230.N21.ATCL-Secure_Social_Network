<?php
    class Database
    {
        private static $instance = null;
        private $connection;
    
        private function __construct()
        {
            // Establish the database connection
            $hostname = getenv("MYSQL_SERVER");
            $username = getenv("MYSQL_USER");
            $password = getenv("MYSQL_PASSWORD");
            $database = getenv("MYSQL_DATABASE");
    
            $this->connection = new mysqli($hostname, $username, $password, $database);
    
            if ($this->connection->connect_error) {
                die("Connection failed: " . $this->connection->connect_error);
            }
        }
    
        public static function getInstance()
        {
            if (self::$instance === null) {
                self::$instance = new Database();
            }
            return self::$instance;
        }
    
        public function getConnection()
        {
            return $this->connection;
        }
    }
    
    $database = Database::getInstance();
    $connection = $database->getConnection();
?>