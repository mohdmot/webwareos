<!DOCTYPE html>
<?php
    session_start();
    $usr = $_SESSION['usr'];
    $psw = $_SESSION['psw'];
    
    if (!isset($_SESSION['login'])) {$_SESSION['login']='no';}
    
    if ($_SESSION['login'] == 'no') {
        exit('<script>window.location="index.php"</script>');
    }

    $path = '';
    if (isset($_GET['p'])) {
        $path = $_GET['p'];
    }
?>
<script>
function file_dialog (path) {
    document.getElementById('file-dialog').showModal()
    document.getElementById('file-dialog-dl').href = 'api/download.php?p='+path
    document.getElementById('file-dialog-fe').href = 'file_editor.php?p='+path
}
</script>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebwareOS - File Manager</title>
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
    </style>
</head>
<body style="font-family:'Terminal Medium'; background-color: rgb(15, 15, 15);color: whitesmoke;">
    <!-- FILE DIALOG -->
    <dialog id="file-dialog">
        <center>
            <a id="file-dialog-dl" ><button>Download</button></a>
            <a id="file-dialog-fe" ><button>File Editor</button></a><br><br>
            <input type="button" value="CLOSE" onclick="document.getElementById('file-dialog').close()">
        </center>
    </dialog>
    <!-- COPY DIALOG -->
    <dialog id="copy-dialog">
        <form action="api/copy.php">
            <h3>Copy File</h3>
            <hr>
            <input name="from" type="text" placeholder="Enter full file path" value="<?php echo "home/".$path ?>">
            <input name="to" type="text" placeholder="Enter the new path">
            <input type="submit" value="COPY">
            <input type="button" value="CLOSE" style="margin-right: 10px" onclick="document.getElementById('copy-dialog').close()">
        </form>
        <p style="font-size: 10px;">eg. home/show.ppt</p>
        <p style="font-size: 10px;">&ensp;&ensp;home/MY_PPT/show.ppt</p>
    </dialog>
    <!------------------->
    <!-- RENAME DIALOG -->
    <dialog id="rename-dialog">
        <form action="api/rename.php">
            <h3>Rename File/Directory</h3>
            <hr>
            <input name="from" type="text" placeholder="Enter full file name with path" value="<?php echo "home/".$path ?>">
            <input name="to" type="text" placeholder="Enter the new file name with path">
            <input type="submit" value="RENAME">
            <input type="button" value="CLOSE" style="margin-right: 10px" onclick="document.getElementById('rename-dialog').close()">
        </form>
        <p style="font-size: 10px;">eg. home/show.ppt</p>
        <p style="font-size: 10px;">&ensp;&ensp;home/notshow.ppt</p>
    </dialog>
    <!------------------->
    <!-- DELETE DIALOG -->
    <dialog id="delete-dialog">
        <form action="api/delete.php">
            <h3>Delete File</h3>
            <hr>
            <input name="fp" type="text" placeholder="Enter full file path" value="<?php echo "home/".$path ?>">
            <input type="radio" name="type" value="dir">Directory
            <input type="radio" name="type" value="file">File
            <input type="submit" value="DELETE">
            <input type="button" value="CLOSE" style="margin-right: 10px" onclick="document.getElementById('delete-dialog').close()">
        </form>
        <p style="font-size: 10px;">eg. home/show.ppt</p>
    </dialog>
    <!------------------->
    <!-- MKDIR DIALOG -->
    <dialog id="mkdir-dialog">
        <form action="api/mkdir.php">
            <h3>Makedir</h3>
            <hr>
            <input name="dp" type="text" placeholder="Enter full dir path" value="<?php echo "home/".$path ?>">
            <input type="submit" value="MAKE">
            <input type="button" value="CLOSE" style="margin-right: 10px" onclick="document.getElementById('mkdir-dialog').close()">
        </form>
        <p style="font-size: 10px;">eg. home/myshows</p>
    </dialog>
    <!------------------->
    <!-- UPLOAD DIALOG -->
    <dialog id="upload-dialog">
        <form action="api/upload_file.php" method="post" enctype="multipart/form-data">
            <h3>Upload File</h3>
            <hr>
            <input name="target" type="text" placeholder="Enter full file path" value="<?php echo "home/".$path ?>">
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="UPLOAD">
            <input type="button" value="CLOSE" style="margin-right: 10px" onclick="document.getElementById('upload-dialog').close()">
        </form>
    </dialog>
    <!------------------->
    <h2>Path : <?php echo 'home/'.$path; ?></h2>
    <!-- TOP METHODS BUTTON -->
    <a href="<?php
    echo 'file_manager.php?p=';
    $arr = explode('/',$path);
    $arr = array_slice($arr,0,-1);
    echo join('/',$arr);
    ?>">
    <img src="img/back.png" class='ico'>&ensp;<p style='display:inline;' class='method'>Back</p></a>
    &ensp;&ensp;
    <a onclick="document.getElementById('copy-dialog').showModal()" class='method' href="#">Copy</a>
    &ensp;&ensp;
    <a onclick="document.getElementById('delete-dialog').showModal()" class='method' href="#">Delete</a>
    &ensp;&ensp;
    <a onclick="document.getElementById('rename-dialog').showModal()" class='method' href="#">Rename</a>
    &ensp;&ensp;
    <a onclick="document.getElementById('mkdir-dialog').showModal()" class='method' href="#">Mkdir</a>
    &ensp;&ensp;
    <a class='method' href="file_editor.php?d=<?php echo $path; ?>">FileEditor</a>
    &ensp;&ensp;
    <a onclick="document.getElementById('upload-dialog').showModal()" class='method' href="#">Upload</a>
    <br><br>
    <!------------------------>

    <!--- FILE AND FOLDER BOX --->
    <div style="border: 1px #fff solid;border-radius: 10px; background-image: linear-gradient(to left, rgb(15, 15, 15) ,  #000 );">
        <br>
        <?php
            $where_iam = $usr.'/'.$psw.'/'.$path;
            $files = array_diff(scandir($where_iam), array('.', '..'));
            foreach ($files as $value) {
                if (is_dir($where_iam.'/'.$value)){
                    echo '<a href="file_manager.php?p='.$path.'/'.$value.'" ><img src="img/folder.png" class="ico">&ensp;<p class="folder">'.$value.'</p></a><br>';
                }
            }

            foreach ($files as $value) {
                if (!is_dir($where_iam.'/'.$value)){
                    //echo '<a onclick="file_dialog()" href="api/download.php?p='.$path.'/'.$value.'" ><img src="img/file.png" class="ico">&ensp;<p class="file">'.$value.'</p></a><br>';
                    echo '<a onclick="file_dialog(\''.$path.'/'.$value.'\')" href="#" ><img src="img/file.png" class="ico">&ensp;<p class="file">'.$value.'</p></a><br>';
                }
            }
        ?>
        <br>
    </div>
    <!----------------------------->
    <p><a href="api/logout.php" class='method'>Logout</a></p>
</body>
</html>