<?php
class PageBlog extends Page {
    private Post $post;
    private $post_list;
    private $post_list_sort;
    private $post_list_limit;

    public function __construct($db_connect, $dir, $post_list_sort, $post_list_limit) {
        $this->db_connect = $db_connect;
        $this->post = new Post($this->db_connect);
        $this->post_list = array();
        $this->post_list_sort = $post_list_sort;
        $this->post_list_limit = $post_list_limit;
        $this->template = new Template($dir);
    }

    public function __destruct() {
        //
    }

    private function select_data() {
        $this->db_connect->set_sql_text("SELECT * FROM `pages` WHERE ident='blog'");
        $this->db_connect->query();
        if ($this->db_connect->get_result_num_rows() > 0) {
            $this->result_fetch_assoc();
        } else {
            $this->db_connect->set_sql_text("SELECT * FROM `pages` WHERE ident='404'");
            $this->db_connect->query();
            $this->result_fetch_assoc();
        }
        
    }

    private function result_fetch_assoc_list() {
        $url = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/?page=blog&post=";
        $post_link = array();
        while ($row = $this->db_connect->fetch()) {
            $post_link["id"] = $row["id"];
            $post_link["link"] = $url . $post_link["id"];
            $post_link["title"] = $row["title"];
            $this->post_list[] = $post_link;
        }
    }

    public function select_list_data($sort, $num) {
        $sql = "SELECT `id`, `title` FROM `posts`";
        switch ($sort) {
            case "desc":
                $sort = " ORDER BY `id` DESC ";
                break;
            case "asc":
                $sort = " ORDER BY `id` ASC ";
                break;
            default:
            $sort = " ORDER BY `id` ASC ";
                break;
        }
        if ($num > 0) {
            $limit = "LIMIT " . $num;
        } else {
            $limit = "";
        }
        $sql = $sql . $sort . $limit ;

        $this->db_connect->set_sql_text($sql);
        $this->db_connect->query();
        if ($this->db_connect->get_result_num_rows() > 0) {
            $this->result_fetch_assoc_list();
        }
    }

    private function render_post_list($sort, $num) {
        $this->select_list_data($sort, $num);
        $url = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/?page=blog&post=";
        echo("<ol>\n");
        foreach($this->post_list as $post_link) {
            echo("<li><a href='$url" . $post_link["id"]  . "'>" . $post_link["title"] . "</a></li>\n");
        }
        echo("</ol>\n");
    }

    public function render() {
        if (isset($_GET["post"])) {
            $this->select_list_data($this->post_list_sort, $this->post_list_limit);
            $post_data = $this->post->get_for_template();
            $this->template->set_title($post_data["title"]);
            $this->template->set_top_menu_items($this->menu_items);
            $this->template->set_blog_menu_items($this->post_list);
            $this->template->set_content($post_data["content"]);
            $this->template->set_comments($post_data["comments"]);
            $this->template->render("blog");
        } else {
            $this->select_data();
            $this->select_list_data($this->post_list_sort, $this->post_list_limit);
            $this->template->set_title($this->title);
            $this->template->set_top_menu_items($this->menu_items);
            $this->template->set_blog_menu_items($this->post_list);
            $this->template->set_content($this->content);
            $this->template->render("blog");
        }
    }
}
?>