<?
session_start();
$base_usr="https://www.ok.umatravel.club";

$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/config.php';
include_once $url_system.'login/function_users.php';
logout($link);

header("Location: ".$base_usr);

?>