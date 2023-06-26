<?php
session_start();
if (!isset($_SESSION['login'])) $_SESSION['login']='no';

if ($_SESSION['login'] == 'no') exit('<script>window.location="/index.php"</script>');
$usr = $_SESSION['usr'];
$psw = $_SESSION['psw'];
$filepath = '../'.$usr.'/'.$psw.'/'.str_replace('home/','',$_GET['p']);

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename($filepath));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filepath));
ob_clean();
flush();
if (file_exists($filepath)) readfile($filepath);
exit;


?>