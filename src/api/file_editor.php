<?php

session_start();
if (!isset($_SESSION['login'])) $_SESSION['login']='no';

if ($_SESSION['login'] == 'no') exit('<script>window.location="../index.php"</script>');
$usr = $_SESSION['usr'];
$psw = $_SESSION['psw'];

if ($_GET['a']=='save'){
    $fp = '../'.$usr.'/'.$psw.'/'.str_replace('home/','',$_GET['fp']);
    $text = $_GET['text'];
    if (is_dir(dirname($fp)))
    {
        $file = fopen($fp,'w');
        fwrite($file,$text);
        fclose($file);
        echo 'Saved successfully.';
    }else echo 'This directory is not defined.';
}
if ($_GET['a']=='open'){
    $fp = '../'.$usr.'/'.$psw.'/'.str_replace('home/','',$_GET['fp']);
    if ($file = fopen($fp, "r")) {
        while(!feof($file)) {
            echo fgets($file);
        }
        fclose($file);
    }else echo '[ THIS FILE IS NOT EXISTS ]';
}

?>