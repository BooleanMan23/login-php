<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Homepage</h1>
<?php
        if(isset($_SESSION['u_id'])){
            echo "Welcome " .$_SESSION['u_uid'];
        
            echo '    <form action="includes/logout.inc.php" method = "POST">
            <button type = "submit" name = "submit">Logout</button>
        </form>';
    
    }
       
        
    ?>
<h1>Write a Post</h1>
    <form action="includes/createpost.inc.php" method="POST" enctype ="multipart/form-data">
            <input type="text" name = "postSubject" placeholder="Subject">
            <input type="text" name= "postContent" placeholder="Content">
            <input type="file" name="file">
            <button type = "submit" name = "submit">Upload</button>
    </form>
</body>
</html>