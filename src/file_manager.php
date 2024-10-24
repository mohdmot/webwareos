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
    if (isset($_GET['p'])) {
        $path = $_GET['p'];
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebwareOS - File Manager</title>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/file_manager.css">
    <script src="js/main.js"></script>
</head>
<body>
    <!-- COPY DIALOG -->
    <dialog id="details-dialog">
        <h3 style="">Item Details</h3><a class="xbtn" href="#" onclick="document.getElementById('details-dialog').close()"><b>⛌</b></a>     
        <hr>
        <p id="file-details"></p>
    </dialog>
    <!-- Image Viewer -->
    <dialog id="image-viewer">
        <h3>Image Viewer</h3><a class="xbtn" href="#" onclick="document.getElementById('image-viewer').close()"><b>⛌</b></a>
        <hr>
        <center>
            <img id="showen-img" alt="">
        </center>
    </dialog>
    <!-- FILE DIALOG -->
    <dialog id="openfile-dialog">
        <h3 style="">Open With</h3><a class="xbtn" href="#" onclick="document.getElementById('openfile-dialog').close()"><b>⛌</b></a>
        <hr>
        <center>
            <a id="openfile-dialog-dl" ><input type="button" class="button" value="Download"></a>
            <a id="openfile-dialog-iv" ><input type="button" class="button" value="Image Viewer"></a>
            <a id="openfile-dialog-fe" ><input type="button" class="button" value="File Editor"></a>
            <br><br>
            <input type="button" class="button" value="CLOSE" onclick="document.getElementById('openfile-dialog').close()">
        </center>
    </dialog>
    <!-- COPY DIALOG -->
    <dialog id="copy-dialog">
        <form action="api/copy.php">
            <h3>Copy File</h3><a class="xbtn" href="#" onclick="document.getElementById('copy-dialog').close()"><b>⛌</b></a>
            <hr>
            <input name="from" id="src-copy" readonly="readonly" type="text" placeholder="Enter full file path" value="<?php echo "home/".$path ?>">
            <input name="to" autocomplete="off" type="text" placeholder="Enter the new path">
            <input type="submit" class="button" value="Copy">
        </form>
        
    </dialog>
    <!------------------->
    <!-- RENAME DIALOG -->
    <dialog id="rename-dialog">
        <form action="api/rename.php">
            <h3>Rename</h3><a class="xbtn" href="#" onclick="document.getElementById('rename-dialog').close()"><b>⛌</b></a>
            <hr>
            <input name="from" id="src-rename" readonly="readonly" type="text" placeholder="Enter full file name with path" value="<?php echo "home/".$path ?>">
            <input name="to" autocomplete="off" type="text" placeholder="Enter the new file name with path">
            <input type="submit" class="button" value="Rename">
        </form>
        <p style="font-size: 10px;">eg. home/show.ppt</p>
        <p style="font-size: 10px;">&ensp;&ensp;home/notshow.ppt</p>
    </dialog>
    <!------------------->
    <!-- New Folder DIALOG -->
    <dialog id="mkdir-dialog">
        <form action="api/mkdir.php">
            <h3>New Folder</h3><a class="xbtn" href="#" onclick="document.getElementById('mkdir-dialog').close()"><b>⛌</b></a>
            <hr><br>
            <input autocomplete="off" name="dp" type="text" placeholder="Enter full dir path" value="<?php echo "home/".$path ?>">
            <p style="font-size: 10px;">eg. home/myshows</p>
            <input class="button" type="submit" value="Create">
        </form>
    </dialog>
    <!------------------->
    <!-- New File Dialog -->
    <dialog id="mkopenfile-dialog">
        <form action="api/mkfile.php">
            <h3>New File</h3><a class="xbtn" style="margin-left:60%;" href="#" onclick="document.getElementById('mkopenfile-dialog').close()"><b>⛌</b></a>
            <hr><br>
            <input name="fp" autocomplete="off" type="text" placeholder="Enter full file path" value="<?php echo "home/".$path ?>">
            <p style="font-size: 10px;">eg. home/file.txt</p>
            <input class="button" type="submit" value="Create">
        </form>
    </dialog>
    <!------------------->
    <!-- UPLOAD DIALOG -->
    <dialog id="upload-dialog">
        <form action="api/upload_file.php" method="post" enctype="multipart/form-data">
            <h3 style="display:inline;">Upload File</h3><a class="xbtn" href="#" onclick="document.getElementById('upload-dialog').close()"><b>⛌</b></a>
            <hr>
            <input autocomplete="off" name="target" type="text" placeholder="Enter full file path" value="<?php echo "home/".$path ?>">
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" class="button" value="Upload">
        </form>
    </dialog>
    <!------------------->
    <h2>Path : <?php echo 'home/'.$path; ?></h2>
    
    <!-- TOP METHODS BUTTON -->
    <div id="topbtndiv">
        <a href="<?php
        echo 'file_manager.php?p=';
        $arr = explode('/',$path);
        $arr = array_slice($arr,0,-1);
        echo join('/',$arr);
        ?>">
            <!--<button class="leftbtn"><img src="img/back.png" class='ico'><p>Back</p></button>-->
            <button class="leftbtn"><p>↶</p> Back</button>
        </a>
        <!-- Dropdown Menu (+) -->
        <div class="dropdown">
            <button class="rightbtn" style="width: 48px;" onclick="plus_onclick()">+</button>
            <div class="dropdown-list">
                <a href="#" onclick="document.getElementById('mkopenfile-dialog').showModal()">File</a>
                <a href="#" onclick="document.getElementById('mkdir-dialog').showModal()">Folder</a>
            </div>
        </div>
        <a class='method' href="file_editor.php?d=<?php echo $path; ?>">
            <button class="rightbtn">FileEditor</button>
        </a>
        <button class="rightbtn" onclick="document.getElementById('upload-dialog').showModal()">Upload</button>
    </div>
    <br><br>
    <!------------------------>

    <!--- FILE AND FOLDER BOX --->
    <div id="files-box">
        <br>
        <table id="files-table">
            <tr>
                <td class="fimg"></td>
                <td class="fname">Name</td>
                <td class="fsize">Size</td>
                <td class="fdate">Last Modified</td>
                <td class="fdel"></td>
                <td class="fcpy"></td>
                <td class="fren"></td>
            </tr>
            <?php
                $where_iam = $usr.'/'.$psw.'/'.$path;
                $files = array_diff(scandir($where_iam), array('.', '..'));
                foreach ($files as $value) {
                    if (is_dir($where_iam.'/'.$value)){
                        echo '<tr>';
                        echo '<td class="fimg"><a href="file_manager.php?p='.$path.'/'.$value.'" ><img src="img/folder.png" class="ico"></a></td>';
                        echo '<td class="fname"><a href="file_manager.php?p='.$path.'/'.$value.'" ><p class="folder">'.$value.'</p></a></td>';
                        echo '<td class="fsize">'.filesize($where_iam.'/'.$value).'</td>';
                        echo '<td class="fdate">'.date("F d Y H:i:s.", filemtime($where_iam.'/'.$value)).'</td>';
                        echo '<td class="fdel"><center><a href="api/delete.php?fp='.urlencode($path.'/'.$value).'&type=dir">Delete</a></center></td>';
                        echo '<td class="fren"><center><a href="#" onclick="document.getElementById(\'rename-dialog\').querySelector(\'#src-rename\').value=\''.$path.'/'.$value.'\';document.getElementById(\'rename-dialog\').showModal();">Rename</a></center></td>';
                        echo '<td class="fcpy"></td>';
                        echo '<td class="fdet"><center><a onclick="show_details(this)" >:</a></center></td>';
                        echo '</tr>';
                    }
                }

                foreach ($files as $value) {
                    if (!is_dir($where_iam.'/'.$value)){
                        //echo '<a onclick="openfile_dialog()" href="api/download.php?p='.$path.'/'.$value.'" ><img src="img/file.png" class="ico">&ensp;<p class="file">'.$value.'</p></a><br>';
                        echo '<tr>';
                        echo '<td class="fimg"><a onclick="openfile_dialog(\''.$path.'/'.$value.'\')" href="#" ><img src="img/file.png" class="ico"></a></td>';
                        echo '<td class="fname"><a onclick="openfile_dialog(\''.$path.'/'.$value.'\')" href="#" ><p class="file">'.$value.'</p></a></td>';
                        echo '<td class="fsize">'.filesize($where_iam.'/'.$value).'</td>';
                        echo '<td class="fdate">'.date("F d Y H:i:s.", filemtime($where_iam.'/'.$value)).'</td>';
                        echo '<td class="fdel"><center><a href="api/delete.php?fp='.urlencode($path.'/'.$value).'&type=file">Delete</a></center></td>';
                        echo '<td class="fren"><center><a href="#" onclick="document.getElementById(\'rename-dialog\').querySelector(\'#src-rename\').value=\''.$path.'/'.$value.'\';document.getElementById(\'rename-dialog\').showModal();">Rename</a></center></td>';
                        echo '<td class="fcpy"><center><a href="#" onclick="document.getElementById(\'copy-dialog\').querySelector(\'#src-copy\').value=\''.$path.'/'.$value.'\';document.getElementById(\'copy-dialog\').showModal();">Copy</a></center></td>';
                        echo '<td class="fdet"><center><a onclick="show_details(this)" >:</a></center></td>';
                        echo '</tr>';
                    }
                }

            ?>
        </table>
        <?php
        // is page is empty show this img
        if (!$files) {
            echo '<center><img id="page-empty" src="img/empty.png"></center>';
            echo '<style>.fname , .fsize , .fdate { display:none; }</style>';
        }
        ?>
        <br>
    </div>
    <!----------------------------->
    <p><a href="api/logout.php" class='method'>Logout</a></p>
</body>
</html>