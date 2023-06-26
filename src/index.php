<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebwareOS</title>
    <style>
        @font-face {
        font-family: 'Terminal Medium';
        font-style: normal;
        font-weight: normal;
        src: local('Terminal Medium'), url('Terminal.woff') format('woff');
        }
        .input {
            font-family:'Terminal Medium';
            width: 200px;
            border-radius: 6px;
            border: 2px #ffffff solid;
            background-color: rgb(41, 41, 41);
            color: whitesmoke;
        }
        .button {
            border-radius: 6px;
            border: 2px #ffffff solid;
            font-family:'Terminal Medium';
            width: 200px;
            background-color: rgb(20, 20, 20);
            color: whitesmoke;
        }
        #box {
            border: 2px #fff solid;
            border-radius: 20px;
            width: 320px;
            height: 160px;
            background-image: linear-gradient(to right, rgb(53, 53, 53) ,  #000 );
        }
        body {
            background-image : url('img/bgs/bg<?php echo rand(0,9) ?>.jpg');
        }
    </style>
</head>
<body style="font-family:'Terminal Medium'; background-color: rgb(53, 53, 53);color: whitesmoke;">
    <center>
        <img src="img/logo.png" alt="" style="width: 70%;">
        <form action="api/login.php">
            <div id="box">
                <br>
                <input name="usr" type="text" placeholder="Username" class="input"><br><br>
                <input name="psw" type="password" placeholder="Password" class="input">
                <br>
                <p style="font-family:'Terminal Medium';color: rgb(204, 12, 12);">
                <?php
                if (isset($_GET['err'])) {
                    echo $_GET['err'];
                }
                ?>
               </p>
                <input type="submit" value="Login" class="button">
            </div>
        </form>
    </center>
    <p style="position: absolute; left:10px; bottom: 10px;">WebwareOS 0.1.0</p>
</body>
</html>