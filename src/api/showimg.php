<?php
session_start();
if (!isset($_SESSION['login'])) $_SESSION['login']='no';

if ($_SESSION['login'] == 'no') exit('<script>window.location="../index.php"</script>');
$usr = $_SESSION['usr'];
$psw = $_SESSION['psw'];
$filepath = '../'.$usr.'/'.$psw.'/'.str_replace('home/','',$_GET['p']);


$imginfo = getimagesize($filepath);
header("Content-Type: {$imginfo['mime']}");
ob_clean();
flush();
if (file_exists($filepath)) readfile($filepath);
exit;

?>