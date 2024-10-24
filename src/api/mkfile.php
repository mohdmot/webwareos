<?php

session_start();
if (!isset($_SESSION['login'])) $_SESSION['login']='no';

if ($_SESSION['login'] == 'no') exit('<script>window.location="../index.php"</script>');
$usr = $_SESSION['usr'];
$psw = $_SESSION['psw'];
$fp = '../'.$usr.'/'.$psw.'/'.str_replace('home/','',$_GET['fp']);

file_put_contents($fp, '');
echo '<script>history.back()</script>';

?>