<?php
$settings_path = $_SERVER['DOCUMENT_ROOT'] . "/settings.php";
include_once($settings_path);

//var_dump($_SERVER);
//echo($_SERVER['HTTP_HOST']);

$db_connect = new db_pdo($servername, $username, $password, $dbname);
$db_connect->open_connection();

$signin = new Signin($db_connect);

$website = new LessonsSite2admin();
$top_menu = new Menu($db_connect, 2);
$top_menu->select_data();

if (isset($_GET["page"])) {
    $page_ident = $_GET["page"];
    switch ($page_ident) {
        case 'new_post':
            $page = new PostWriter($db_connect, "basic");
            break;
        case 'new_post_submit':
            $page = new PagePostSubmit($db_connect, "basic");
            break; 
        case 'signin':
            $page = new PageSignin($db_connect, "basic", $signin);
            break;
        default:
            $page = new PageAdmin($db_connect, "basic");
            break;
    }
} else {
    $page = new PageAdmin($db_connect, "basic");
}

//$website->add_header("$include_path/header.php");
//$website->add_footer("$include_path/footer.php");
$website->add_menu($top_menu);
$website->set_sign_in($signin);
$top_menu_items = $top_menu->get_items();
$page->set_menu_items($top_menu_items);
$website->set_page($page);
$website->render();

$db_connect->close_connection();
?>