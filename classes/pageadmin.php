<?php
class PageAdmin extends Page {
    private TemplateAdmin $template2;
    
    public function __construct($db_conn, $dir) {
        $this->db_connect = $db_conn;
        if (isset($_GET["page"])) {
            $this->ident = $_GET["page"];
        } else {
            $this->ident = "main";
        }
        $this->template2 = new TemplateAdmin($dir);
    }

    public function __destruct() {
        //
    }

    private function select_data() {
        $this->db_connect->set_sql_text("SELECT * FROM `pages` WHERE ident='" . $this->ident . "'");
        $this->db_connect->query();
        //$result = $this->db_connect->query("SELECT * FROM `pages` WHERE ident='" . $this->ident . "'");
        //if ($result->num_rows > 0) {
        if ($this->db_connect->get_result_num_rows() > 0) {
            //$this->result_fetch_assoc($result);
            $this->result_fetch_assoc();
        } else {
            $this->db_connect->set_sql_text("SELECT * FROM `pages` WHERE ident='404'");
            $this->db_connect->query();
            $this->result_fetch_assoc();
            //$result = $this->db_connect->query("SELECT * FROM `pages` WHERE ident='404'");
            //$this->result_fetch_assoc($result);
        }
    }

    public function render() {
        $this->select_data();
        $this->template2->set_title($this->title);
        $this->template2->set_top_menu_items($this->menu_items);
        $this->template2->set_content($this->content);
        //echo("<center><h1>" . $this->title . "</h1></center>\n");
        //echo($this->content) . "<br>\n";
        $this->template2->render("page");
    }

}
?>