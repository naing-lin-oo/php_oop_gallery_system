<?php
    //require_once("new_config.php");
    class Database {
        public $connection;

        //First execute db_connection function
        function __construct() {
            $this->open_db_connection();
        }

        //db_connection function
        public function open_db_connection() {
            //$this->connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            if($this->connection->connect_errno) {
                die("Database connection failed badly" . $this->connection->connect_error);
            }
        }

        //query function
        public function query($sql) {
            //$result = mysqli_query($this->connection, $sql);
            $result = $this->connection->query($sql);
            $this->comfirm_query($result);
            return $result;
        } 

        //show query error function
        private function comfirm_query($result) {
            if(!$result) {
                die("Query Failed" . $this->connection->error);
            } 
        }

        //real_escape_string_error function
        public function escape_string($string) {
            $escaped_string = $this->connection->real_escape_string($string);
            return $escaped_string;
        }

        //insert id function
        public function the_insert_id() {
            return mysqli_insert_id($this->connection);
        }
    } 
    $database = new Database();
?>