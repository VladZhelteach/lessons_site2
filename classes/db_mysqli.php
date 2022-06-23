<?php
class DB_mysqli implements DB_Interface {
    private mysqli $mysqli_obj;
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $sql_text;
    private $result;
    //private $result_table;

    public function __construct($servername, $username, $password, $dbname) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        //$this->result_table = array();
    }

    public function __destruct() {
        //
    }

    public function open_connection() {
        $this->mysqli_obj = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    }

    public function close_connection() {
        $this->mysqli_obj->close();
    }

    public function set_sql_text($sql_text) {
        $this->sql_text = $sql_text;
    }

    public function query() {
        $this->result = $this->mysqli_obj->query($this->sql_text);
    }

    public function fetch() {
        return $this->result->fetch_assoc();
    }

    public function get_result() {
        return $this->result;
    }

    public function get_result_num_rows() {
        return $this->result->num_rows;
    }

}
?>