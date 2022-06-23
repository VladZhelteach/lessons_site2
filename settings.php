<?php
$include_path = $_SERVER['DOCUMENT_ROOT'] . "/include";
$classes_path = $_SERVER['DOCUMENT_ROOT'] . "/classes";

include_once("$include_path/db_config.php");
include_once("$classes_path/db_interface.php");
include_once("$classes_path/db_mysqli.php");
include_once("$classes_path/db_pdo.php");
include_once("$classes_path/template.php");
include_once("$classes_path/templateadmin.php");
include_once("$classes_path/comments.php");
include_once("$classes_path/menu.php");
include_once("$classes_path/page.php");
include_once("$classes_path/post.php");
include_once("$classes_path/pageblog.php");
include_once("$classes_path/pageadmin.php");
include_once("$classes_path/page_postwriter.php");
include_once("$classes_path/page_postwriter_submit.php");
include_once("$classes_path/signin.php");
include_once("$classes_path/pagesignin.php");
include_once("$classes_path/websiteinterface.php");
include_once("$classes_path/lessonssite2.php");
include_once("$classes_path/lessonssite2admin.php");
include_once("$classes_path/greeting.php");

?>