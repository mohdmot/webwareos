<?php
session_start();

$usr = $_GET['usr'];
$psw = $_GET['psw'];

if (!isset($_SESSION['login'])) { $_SESSION['login']='no'; }

if ($usr == 'admin' && $psw == 'iamtheadmin123'){
    echo '<script>window.location="../file_manager.php"</script>';
    $_SESSION['usr']=$usr;
    $_SESSION['psw']=$psw;
    $_SESSION['login']='yes';
}else{
    echo '<script>window.location="../index.php?err=1"</script>';
}
?>
