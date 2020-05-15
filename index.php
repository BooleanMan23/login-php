<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
   
    <h1>Home Page</h1>
    <form action="includes/login.inc.php" method = "POST">
        <input type="text" name= "email" placeholder="email">
        <input type="password" name = "password" placeholder ="password">
        <button type = "submit" name= "loginButton">login</button>
    </form>
    <a href="signup.php">Dont have an account? Sign up here!</a>
    <?php
        if(isset($_SESSION['u_id'])){
            echo "Welcome " .$_SESSION['u_uid'];
        }
        echo '    <form action="includes/logout.inc.php" method = "POST">
        <button type = "submit" name = "submit">Logout</button>
    </form>'
        
    ?>


</body>
</html>