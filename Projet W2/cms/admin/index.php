<?php

session_start();

include_once('../includes/connection.php');


if (isset($_SESSION['logged_in'])){
    //display index
}else {
    
    if (isset($_POST['username'], $_POST['password'])){
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        if(empty($username) or empty($password)){
            $error = 'All fields are required!';
        } else {
            $query = $pdo->prepare("SELECT * FROM users WHERE user_name = ? AND user_password = ?");

            $query->bindValue(1, $username);
            $query->bindValue(1, $password);

            $query->execute();

            $num = $query->rowCount();

            if($num == 1){
                $_SESSION['logged_in'] = true;
                header('Location: index.php');
                exit();

            } else {
                $error = 'Incorrect details!';
            }
        }
    }




    ?>

    <html>
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link href="../assets/style.css" rel="stylesheet">
        </head>
        <body>
            <div class="container">
                <a href="index.php" id="logo">CMS</a>
                
                <br><br>

                <?php if (isset($error)){ ?>
                    <small style="color: red;"><?php echo $error; ?>
                    <br><br>
                <?php } ?>           

                <form action="index.php" method="post" autocomplete="off">
                    <input type="text" name="username" placeholder="Username" />
                    <input type="password" name="password" placeholder="password" />
                    <input type="submit" value="Login" />
            </div>


            
        </body>
    </html>


    <?php
}

?>