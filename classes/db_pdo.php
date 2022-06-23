<?php
class DB_pdo implements DB_Interface {
    private PDO $pdo_obj;
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
        //$this->mysqli_obj = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $this->pdo_obj = new PDO("mysql:host=" . $this->servername . ";dbname=" . $this->dbname, $this->username, $this->password);
    }

    public function close_connection() {
        //$this->mysqli_obj->close();
        $this->pdo_obj = null;
    }

    public function set_sql_text($sql_text) {
        $this->sql_text = $sql_text;
    }

    public function query() {
        //$this->result = $this->mysqli_obj->query($this->sql_text);
        $this->result = $this->pdo_obj->query($this->sql_text);
    }

    public function fetch() {
        //return $this->result->fetch_assoc();
        return $this->result->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    }

    public function get_result() {
        return $this->result;
    }

    public function get_result_num_rows() {
        //return $this->result->num_rows;
        return $this->result->rowCount();
    }

}
?>