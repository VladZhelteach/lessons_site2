<?php
class Post extends Page {
    private Comments $comments;

    public function __construct($db_conn) {
        $this->db_connect = $db_conn;
        if (isset($_GET["post"])) {
            $this->id = $_GET["post"];
        }
        $this->comments = new Comments($this->db_connect, $this->id);
    }

    public function __destruct() {
        //
    } 
    
    private function select_data() {
        //$result = $this->db_connect->query("SELECT * FROM `posts` WHERE id=" . $this->id . "");
        $this->db_connect->set_sql_text("SELECT * FROM `posts` WHERE id=" . $this->id . "");
        $this->db_connect->query();
        //if ($result->num_rows > 0) {
        if ($this->db_connect->get_result_num_rows() > 0) {
            //$this->result_fetch_assoc($result);
            $this->result_fetch_assoc();
        } else {
            //$result = $this->db_connect->query("SELECT * FROM `pages` WHERE ident='404'");
            //$this->result_fetch_assoc($result);
            $this->db_connect->set_sql_text("SELECT * FROM `pages` WHERE ident='404'");
            $this->db_connect->query();
            $this->result_fetch_assoc();
        }
    }

    public function get_for_template() {
        $this->select_data();
        $result = array();
        $result["title"] = $this->title;
        $result["content"] = $this->content;
        $this->comments->select_data();
        $result["comments"] = $this->comments->get_items();
        return $result;
    }

    public function render() {
        $this->select_data();
        echo("<center><h1>" . $this->title . "</h1></center>\n");
        echo("" . $this->content . "<br>\n");
        $this->comments->render();
    }

}
?>