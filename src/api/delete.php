<?php

session_start();
if (!isset($_SESSION['login'])) $_SESSION['login']='no';

if ($_SESSION['login'] == 'no') exit('<script>window.location="/index.php"</script>');
$usr = $_SESSION['usr'];
$psw = $_SESSION['psw'];
$fp = '../'.$usr.'/'.$psw.'/'.str_replace('home/','',$_GET['fp']);

if ($_GET['type']=='file'){
    if (file_exists($fp)) unlink($fp);
}else{
    if (is_dir($fp)) {
        $objects = scandir($fp);
        foreach ($objects as $object){
        if ($object != '.' && $object != '..'){
            if (filetype($fp.'/'.$object) == 'dir') {rrmdir($fp.'/'.$object);}
            else {unlink($fp.'/'.$object);}
        }
        }

        reset($objects);
        rmdir($fp);
    }
}
echo '<script>history.back()</script>';

?>