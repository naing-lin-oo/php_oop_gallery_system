<?php
    //require_once("new_config.php");
    class Database {
        public $connection;
        public $db;

        //First execute db_connection function
        function __construct() {
            $this->db = $this->open_db_connection();
        }

        //db_connection function
        public function open_db_connection() {
            //$this->connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            if($this->connection->connect_errno) {
                die("Database connection failed badly" . $this->connection->connect_error);
            }
            return $this->connection;
        }

        //query function
        public function query($sql) {
            //$result = mysqli_query($this->connection, $sql);
            $result = $this->db->query($sql);
            $this->comfirm_query($result);
            return $result;
        } 

        //show query error function
        private function comfirm_query($result) {
            if(!$result) {
                die("Query Failed" . $this->db->error);
            } 
        }

        //real_escape_string_error function
        public function escape_string($string) {
            return $this->db->real_escape_string($string);
        }

        //insert id function
        public function the_insert_id() {
            return $this->db->insert_id;
        }
    } 
    $database = new Database();
?>