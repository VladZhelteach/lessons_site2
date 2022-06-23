<?php
class Menu {
    private $db_connect;
    private $id_menu;
    private $items;

    public function __construct($db_connect, $id_menu) {
        $this->db_connect = $db_connect;
        $this->id_menu = $id_menu;
        $this->items = array();
    }

    public function __destruct() {
        //
    }

    /*protected function result_fetch_assoc($result) {
        $item = array();
        $domain = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'];
        while ($row = $result->fetch_assoc()) {
            $item["link"] = str_replace("{domain}", $domain, $row["link"]);
            $item["text"] = $row["text"];
            $this->items[] = $item;
        }
    }*/

    protected function result_fetch_assoc() {
        $item = array();
        $domain = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'];
        while ($row = $this->db_connect->fetch()) {
            $item["link"] = str_replace("{domain}", $domain, $row["link"]);
            $item["text"] = $row["text"];
            $this->items[] = $item;
        }
    }
    
    public function select_data() {
        $this->db_connect->set_sql_text("SELECT * FROM `menus` WHERE `id_menu`=" . $this->id_menu . "");
        $this->db_connect->query();
        $this->result_fetch_assoc();
        //$result = $this->db_connect->get_result();
        //$this->result_fetch_assoc($result);

        /*$result = $this->db_connect->query("SELECT * FROM `menus` WHERE `id_menu`=" . $this->id_menu . "");
        if ($result->num_rows > 0) {
            $this->result_fetch_assoc($result);
        }*/
    }

    public function get_items() {
        return $this->items;
    }

    public function render() {
        $this->select_data();
        echo("<ul>\n");
        foreach($this->items as $item) {
            echo("<li><a href='" . $item["link"]  . "'>" . $item["text"] . "</a></li>\n");
        }
        echo("</ul>\n");
    }
}
?>