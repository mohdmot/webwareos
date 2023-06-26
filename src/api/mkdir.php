<?php

session_start();
if (!isset($_SESSION['login'])) $_SESSION['login']='no';

if ($_SESSION['login'] == 'no') exit('<script>window.location="/index.php"</script>');
$usr = $_SESSION['usr'];
$psw = $_SESSION['psw'];
$dp = '../'.$usr.'/'.$psw.'/'.str_replace('home/','',$_GET['dp']);

if (is_dir(dirname($dp))) mkdir($dp);
echo '<script>history.back()</script>';

?>