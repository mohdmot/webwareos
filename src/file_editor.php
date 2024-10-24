<!DOCTYPE html>
<?php
    session_start();

    if (!isset($_SESSION['login'])) {$_SESSION['login']='no';}
    if ($_SESSION['login'] == 'no') {
        exit('<script>window.location="index.php"</script>');
    }

    $usr = $_SESSION['usr'];
    $psw = $_SESSION['psw'];

    $path = '';
    $dir = false;
    if (isset($_GET['p'])) {
        $path = $_GET['p'];
    }else if (isset($_GET['d'])) {
        $path = $_GET['d'];
        $dir = true;
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebwareOS - File Editor</title>
    <link rel="stylesheet" href="css/file_manager.css">
    <!--
    <style>
        @font-face {
        font-family: 'Terminal Medium';
        font-style: normal;
        font-weight: normal;
        src: local('Terminal Medium'), url('Terminal.woff') format('woff');
        }
        .ico {
            width: 25px;
            display: inline;
            margin-left: 10px;
        }
        .folder {
            color: rgb(99, 69, 124);
            display: inline;
        }
        .file {
            color: rgb(71, 98, 121);
            display: inline;
        }
        .method {
            color : rgb(111, 81, 192);
        }
        a {
            text-decoration: none;
        }
        dialog {
            background-image: linear-gradient(to left, rgb(15, 15, 15) ,  #000 );
            color: whitesmoke;
            border: 2px #fff solid;
            border-radius: 15px;
        }
        input {
            font-family:'Terminal Medium';
            border-radius: 6px;
            border: 2px #ffffff solid;
            background-color: rgb(41, 41, 41);
            color: whitesmoke;
        }
        button {
            border-radius: 6px;
            border: 2px #ffffff solid;
            font-family:'Terminal Medium';
            background-color: rgb(20, 20, 20);
            color: whitesmoke;
        }
        textarea {
            background-color: rgb(10,10,10);
            color: white;
            font-size: 16px;
        }
    </style>-->
    <script>
        function feditor_save() {
            fp = document.getElementById('filepath').value
            text =  document.getElementById('filetext').value
            console.log(text)
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                // Typical action to be performed when the document is ready:
                document.getElementById("out").innerHTML = xhttp.responseText;
                }
            };
            xhttp.open("GET", 'api/file_editor.php?a=save&fp=' + encodeURI(fp) + '&text=' + encodeURI(text), true);
            xhttp.send(); 
        }
        function feditor_open() {
            fp = document.getElementById('filepath').value
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                // Typical action to be performed when the document is ready:
                document.getElementById("filetext").innerHTML = xhttp.responseText;
                document.getElementById("filetext").value = xhttp.responseText;
                }
            };
            xhttp.open("GET", "api/file_editor.php?a=open&fp=" + encodeURI(fp), true);
            xhttp.send(); 
        }
    </script>
    <dialog id="saved-dialog">
        <h3>File Saved !!</h3>
        <input type="button" class="button" value="CLOSE" onclick="document.getElementById('saved-dialog').close()">
    </dialog>
</head>
<body style="font-family:'Terminal Medium'; background-color: rgb(15, 15, 15);color: whitesmoke;">
    <h1>File Editor</h1>
    <a href="file_manager.php"><button style="width:30px; height:30px; font-size: 20px; position: absolute; top: 23px; right: 10px;">x</button></a>
    <hr>
    <h3 style='display:inline;'>Path :</h3><input type="text" id="filepath" value="<?php echo 'home/'.$path ?>" style='width:200px;'>
    <span style='position: absolute; right: 10px;'>
        <button style='width: 100px;' onclick="feditor_open()" >Open</button>
        <button style='width: 100px;' onclick="feditor_save(); document.getElementById('saved-dialog').showModal()" >Save</button>
    </span>
    <br><br>
    <script><?php if (!$dir) {echo 'feditor_open()';} ?></script>
    <textarea style='width:100%;' id="filetext" rows='25'></textarea>
</body>
</html>