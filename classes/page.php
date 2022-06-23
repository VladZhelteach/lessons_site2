<?php
class Page {
    protected Template $template;
    protected $db_connect;
    protected $id;
    protected $ident;
    protected $title;
    protected $author;
    protected $date_publ;
    protected $content;
    protected $menu_items;
    
    public function __construct($db_conn, $dir) {
        $this->db_connect = $db_conn;
        if (isset($_GET["page"])) {
            $this->ident = $_GET["page"];
        } else {
            $this->ident = "main";
        }
        $this->template = new Template($dir);
    }

    public function __destruct() {
        //
    }

    /*protected function result_fetch_assoc($result) {
        while ($row = $result->fetch_assoc()) {
            $this->id = $row["id"];
            $this->author = $row["author"];
            $this->date_publ = $row["date_publ"];
            $this->title = $row["title"];
            $this->content = $row["text"];
        }
    }*/

    protected function result_fetch_assoc() {
        while ($row = $this->db_connect->fetch()) {
            $this->id = $row["id"];
            $this->author = $row["author"];
            $this->date_publ = $row["date_publ"];
            $this->title = $row["title"];
            $this->content = $row["text"];
        }
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
    
    public function set_menu_items($menu_items) {
        $this->menu_items = $menu_items;
    }

    public function render() {
        $this->select_data();
        $this->template->set_title($this->title);
        $this->template->set_top_menu_items($this->menu_items);
        $this->template->set_content($this->content);
        //echo("<center><h1>" . $this->title . "</h1></center>\n");
        //echo($this->content) . "<br>\n";
        $this->template->render("page");
    }

}
?>