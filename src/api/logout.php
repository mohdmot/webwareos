<?php
session_start();
$_SESSION['usr']='';
$_SESSION['psw']='';
$_SESSION['login']='no';
echo '<script>window.location="/index.php"</script>';
?>