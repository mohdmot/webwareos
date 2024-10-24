<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/index.css">
        <title>WebwareOS</title>
    </head>

    <body style="background-image : url('img/bgs/bg<?php echo rand(0,9) ?>.jpg');">        
        <div class="Container">
            <div class="Box">
                <h1>Webware<span>OS</span></h1>
                <h2>Login</h2>
                <form action="api/login.php">
                    <div class="InputBox">
                        <input name="usr" type="text" class="input">
                        <label>Username</label>
                    </div>
                    <div class="InputBox">
                        <input name="psw" type="password" class="input">
                        <label>Password</label>
                    </div>
                    <p style="">
                    <?php
                    if (isset($_GET['err'])) {
                        echo "<span style='background-color: white; color: #222222; width: fit-content; border-radius: 5px; padding: 3px 3px 3px 3px; font-weight: 600; margin: 0 auto; display: block; margin-bottom: 20px;'><span style='color: red;'>Wrong</span> Username OR Password</span>";
                    }
                    ?>
                    </p>
                    <input type="submit" value="Login" class="button">
                </form>
            </div>
        </div>
        <p style="color: aliceblue; position: absolute; left:10px; bottom: 10px;">Webware<span style="color: #222222; text-shadow: -0.7px 0 #fff, 0 0.7px #fff, 0.7px 0 #fff, 0 -0.7px #fff;">OS</span> 0.2.0</p>
    </body>
</html>