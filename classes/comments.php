<?php
class Comments {
    private $db_connect;
    private $post_id;
    private $items;

    public function __construct($db_connect, $post_id) {
        $this->db_connect = $db_connect;
        $this->post_id = $post_id;
        $this->items = array();
    }

    public function __destruct() {
        //
    }

    //protected function result_fetch_assoc($result) {
    protected function result_fetch_assoc() {
        $new_item = array();
        //while ($row = $result->fetch_assoc()) {
        while ($row = $this->db_connect->fetch()) {
            $new_item["id"] = $row["id"];
            $new_item["post_id"] = $row["post_id"];
            $new_item["author"] = $row["author"];
            $new_item["date_publ"] = $row["date_publ"];
            $new_item["title"] = $row["title"];
            $new_item["comment"] = $row["comment"];
            $new_item["likes"] = $row["likes"];
            $new_item["dislikes"] = $row["dislikes"];
            $rate_likes = (int) $row["likes"];
            $rate_dislikes = (int) $row["dislikes"];
            if ($rate_likes > 0) {
                $rate = $rate_likes / ($rate_likes + $rate_dislikes);
            } elseif ($rate_likes == 0 && $rate_dislikes > 0) {
                $rate = -($rate_dislikes / ($rate_likes + $rate_dislikes));
            } else {
                $rate = 0;
            }
            $new_item["rate"] = $rate;
            $this->items[] = $new_item;
        }
    }

    public function select_data() {
        $this->db_connect->set_sql_text("SELECT * FROM `comments` WHERE `post_id` = " . $this->post_id . "");
        $this->db_connect->query();
        if ($this->db_connect->get_result_num_rows() > 0) {
            $this->result_fetch_assoc();
        }
        
        /*$result = $this->db_connect->query("SELECT * FROM `comments` WHERE `post_id` = " . $this->post_id . "");
        if ($result->num_rows > 0) {
            $this->result_fetch_assoc($result);
        }*/
    }

    public function get_items() {
        return $this->items;
    }

    private function render_item($item_id) {
        echo("<b>" . $this->items[$item_id]["author"] . "</b><br>\n");
        echo($this->items[$item_id]["date_publ"] . "<br>\n");
        echo("<u>" . $this->items[$item_id]["title"] . "</u><br>\n");
        echo($this->items[$item_id]["comment"] . "<br>\n");
        echo("<img src='files/img/like_icon.png' width='20px'> " . $this->items[$item_id]["likes"] . "\n");
        echo("<img src='files/img/dislike_icon.png' width='20px'> " . $this->items[$item_id]["dislikes"] . "\n");
        $color = "black";
        if ($this->items[$item_id]["rate"] > 0) {
            $color = "green";
        }
        if ($this->items[$item_id]["rate"] < 0) {
            $color = "#ff0000";
        }
        echo("Rate: <span style='color: $color'>" . round($this->items[$item_id]["rate"], 2) . "</span><br>\n");
        echo("<hr>\n");
    }

    public function render() {
        echo("Comments:<br>\n");
        $this->select_data();
        for ($i = 0; $i < count($this->items); $i++) {
            $this->render_item($i);
        }
    }
}
?>