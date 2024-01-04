<?php

session_start();
if (!isset($_SESSION['login'])) $_SESSION['login']='no';

if ($_SESSION['login'] == 'no') exit('<script>window.location="../index.php"</script>');
$usr = $_SESSION['usr'];
$psw = $_SESSION['psw'];
$target_dir = '../'.$usr.'/'.$psw.'/'.str_replace('home/','',$_POST['target']) ;

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir)) {
    echo '<script>history.back()</script>';
} else {
    echo "Error in uploading the file.";
}


?>