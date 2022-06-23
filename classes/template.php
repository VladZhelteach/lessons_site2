<?php
class Template {
    protected $dir;
    protected $files;
    protected $title;
    protected $top_menu_items;
    protected $blog_menu_items;
    protected $menu_items;
    protected $content;
    protected $comments;

    public function __construct($dir) {
        $this->files = array();
        $this->dir = $dir;
        $this->comments = array();
    }

    public function __destruct() {
        //
    }

    public function set_title($title) {
        $this->title = $title;
    }

    public function set_top_menu_items($top_menu_items) {
        $this->top_menu_items = $top_menu_items;
    }

    public function set_blog_menu_items($blog_menu_items) {
        $this->blog_menu_items = $blog_menu_items;
    }

    public function set_content($content) {
        $this->content = $content;
    }

    public function set_comments($comments) {
        $this->comments = $comments;
    }

    protected function render_header() {
        include($_SERVER['DOCUMENT_ROOT'] . "/templates/" . $this->dir . "/header.php");
    }

    protected function render_footer() {
        include($_SERVER['DOCUMENT_ROOT'] . "/templates/" . $this->dir . "/footer.php");
    }

    protected function render_top_menu() {
        include($_SERVER['DOCUMENT_ROOT'] . "/templates/" . $this->dir . "/topmenu_header.php");
        foreach($this->top_menu_items as $item) {
            include($_SERVER['DOCUMENT_ROOT'] . "/templates/" . $this->dir . "/topmenu_item.php");
        }
        include($_SERVER['DOCUMENT_ROOT'] . "/templates/" . $this->dir . "/topmenu_footer.php");
    }
    
    protected function render_blog_menu() {
        include($_SERVER['DOCUMENT_ROOT'] . "/templates/" . $this->dir . "/content_blog_menu.php");
        foreach($this->blog_menu_items as $item) {
            include($_SERVER['DOCUMENT_ROOT'] . "/templates/" . $this->dir . "/content_blog_menu_item.php");
        }
    }

    protected function render_content_blog() {
        include($_SERVER['DOCUMENT_ROOT'] . "/templates/" . $this->dir . "/content_blog.php");
        if (count($this->comments) > 0) {
            foreach($this->comments as $comment) {
                include($_SERVER['DOCUMENT_ROOT'] . "/templates/" . $this->dir . "/comment.php");
            }
        }
        include($_SERVER['DOCUMENT_ROOT'] . "/templates/" . $this->dir . "/comment_footer.php");
    }

    protected function render_sign_form() {
        include($_SERVER['DOCUMENT_ROOT'] . "/templates/" . $this->dir . "/submit_form.php");
    }

    protected function render_content() {
        include($_SERVER['DOCUMENT_ROOT'] . "/templates/" . $this->dir . "/content_page.php");
    }


    public function render($page) {
        $this->render_header();
        $this->render_top_menu();
        if ($page == "blog") {
            $this->render_sign_form();
            $this->render_blog_menu();
            $this->render_content_blog();
        } else {
            $this->render_sign_form();
            $this->render_content();
        }
        $this->render_footer();
    }

}
?>