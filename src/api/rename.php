<?php
session_start();
if (!isset($_SESSION['login'])) $_SESSION['login']='no';

if ($_SESSION['login'] == 'no') exit('<script>window.location="/index.php"</script>');
$usr = $_SESSION['usr'];
$psw = $_SESSION['psw'];
$from = '../'.$usr.'/'.$psw.'/'.str_replace('home/','',$_GET['from']);
$to = '../'.$usr.'/'.$psw.'/'.str_replace('home/','',$_GET['to']);

if (file_exists($from) && is_dir(dirname($to))) rename($from,$to);
echo '<script>history.back()</script>';
?>