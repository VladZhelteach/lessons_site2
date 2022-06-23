<?php
class TemplateAdmin extends Template {

    public function __construct($dir) {
        $this->files = array();
        $this->dir = $dir;
        $this->comments = array();
    }

    public function __destruct() {
        //
    }

    protected function render_writer_content() {
        include($_SERVER['DOCUMENT_ROOT'] . "/templates/" . $this->dir . "/writer_form.php");
    }

    public function render($page) {
        $this->render_header();
        $this->render_top_menu();
        if ($page == "new_post") {
            $this->render_sign_form();
            //$this->render_content();
            if (isset($_COOKIE['user_name']) && isset($_COOKIE['user_role'])) {
                if ($_SESSION['user_role'] == 1) {
                    $this->render_writer_content();
                } else {
                    echo("Only administrator can view this page!");
                }
            } else {
                echo("Only authorized administrator can view this page!");
            }    
        } else {
            $this->render_sign_form();
            if (isset($_COOKIE['user_name']) && isset($_COOKIE['user_role'])) {
                if ($_SESSION['user_role'] == 1) {
                    $this->render_content();
                } else {
                    echo("Only administrator can view this page!");
                }
            } else {
                echo("Only authorized administrator can view this page!");
            }
        }
        $this->render_footer();
    }

}
?>