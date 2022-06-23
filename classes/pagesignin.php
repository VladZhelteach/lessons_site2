<?php
class PageSignin extends Page {
    private Signin $signin;

    public function __construct($db_connect, $dir, $signin) {
        $this->db_connect = $db_connect;
        $this->signin = $signin;
        $this->template = new Template($dir);
    }

    public function __destruct() {
        //
    }

    public function form_action() {
        if (isset($_POST["sign_in_login"]) && isset($_POST["sign_in_password"])) {
            $sign_in_login = $_POST["sign_in_login"];
            $sign_in_password = $_POST["sign_in_password"];
            $this->content = $this->signin->sign_in($sign_in_login, $sign_in_password);
        }
        if (isset($_POST["sign_out_button"])) {
            if ($_POST["sign_out_button"] == "out") {
                $this->content = $this->signin->sign_out();
            }
        }
    }

    private function select_data() {
        $this->db_connect->set_sql_text("SELECT * FROM `pages` WHERE ident='signin'");
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