<?php
class PagePostSubmit extends Page {
    //private Signin $signin;

    public function __construct($db_connect, $dir) {
        $this->db_connect = $db_connect;
        //$this->signin = $signin;
        $this->template = new TemplateAdmin($dir);
    }

    public function __destruct() {
        //
    }

    public function set_content($content) {
        $this->content = $content;
    }

    public function form_action() {
        if (isset($_POST["title"]) && isset($_POST["txtarea"]) && isset($_POST["state"])) {
            $name = $_SESSION['user_name'];
            $title = htmlspecialchars($_POST["title"]);
            $txtarea = htmlspecialchars($_POST["txtarea"]);
            $state = htmlspecialchars($_POST["state"]);
            $datetime = date('Y-m-d H:i:s');
        
            $sql = "INSERT INTO `posts`(`author`, `date_publ`, `title`, `text`, `status`) VALUES (\"$name\",\"$datetime\",\"$title\",\"$txtarea\",\"$state\")";
            $this->db_connect->set_sql_text($sql);
            $this->db_connect->query();
            $result = $this->db_connect->get_result();
            if ($result == true) {
                $this->set_content("New POST created successfully");
            } else {
                $this->set_content("Error posting");
            }
        }
    }

    private function select_data() {
        $this->db_connect->set_sql_text("SELECT * FROM `pages` WHERE ident='new_post_submit'");
        $this->db_connect->query();
        if ($this->db_connect->get_result_num_rows() > 0) {
            $this->result_fetch_assoc();
        } else {
            $this->db_connect->set_sql_text("SELECT * FROM `pages` WHERE ident='404'");
            $this->db_connect->query();
            $this->result_fetch_assoc();
        }
    }

    public function render() {
        $this->select_data();
        $this->form_action();
        $this->template->set_title($this->title);
        $this->template->set_top_menu_items($this->menu_items);
        $this->template->set_content($this->content);
        $this->template->render("page");
    }
}
?>