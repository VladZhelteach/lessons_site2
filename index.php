<?php
$settings_path = $_SERVER['DOCUMENT_ROOT'] . "/settings.php";
include_once($settings_path);

$db_connect = new db_pdo($servername, $username, $password, $dbname);
$db_connect->open_connection();

$signin = new Signin($db_connect);

$website = new LessonsSite2();
$top_menu = new Menu($db_connect, 1);
$top_menu->select_data();

if (isset($_GET["page"])) {
    $page_ident = $_GET["page"];
    switch ($page_ident) {
        case 'blog':
            $page = new PageBlog($db_connect, "basic", "desc", 0);
            break; 
        case 'signin':
            $page = new PageSignin($db_connect, "basic", $signin);
            break; 
        default:
            $page = new Page($db_connect, "basic");
            break;
    }
} else {
    $page = new Page($db_connect, "basic");
}

//$website->add_header("$include_path/header.php");
//$website->add_footer("$include_path/footer.php");
$website->add_menu($top_menu);
$top_menu_items = $top_menu->get_items();
$page->set_menu_items($top_menu_items);
$website->set_page($page);
$website->render();

$db_connect->close_connection();
?>