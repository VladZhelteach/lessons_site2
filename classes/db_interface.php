<?php
interface DB_Interface {
    public function open_connection();
    public function close_connection();
    public function set_sql_text($sql_text);
    public function query();
    public function fetch();
    public function get_result();
    public function get_result_num_rows();
}
?>