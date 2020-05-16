<?php
    session_start();
    if(isset($_POST['submit'])){
       include_once 'dbh.inc.php';
       $postSubject = $_POST['postSubject'];
       $postContent = $_POST['postContent'];
       $file = $_FILES['file'];
       $fileName = $_FILES['file']['name'];
       $fileTmpName = $_FILES['file']['tmp_name'];
       $fileSize = $_FILES['file']['size'];
       $fileError = $_FILES['file']['error'];
       $fileType = $_FILES['file']['type'];
       $fileExt =  explode('.', $fileName);
       $fileActualExt = strtolower(end($fileExt));
       $allowed = array('jpg', 'jpeg', 'png', 'pdf');
       if(in_array($fileActualExt, $allowed)){
            if($fileError === 0){
                if($fileSize < 5000000 ){
                    $fileNewName = uniqid('', true).  ".".$fileActualExt;
                    $fileDestination = 'uploads/'.$fileNewName;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $insertSql = "insert into posts (post_subject, post_content, post_creator_uid, post_picture_link) VALUES (?, ?, ?, ?); ";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $insertSql)){
                        echo "insert SQL error";
                    } else{
                        mysqli_stmt_bind_param($stmt, "ssss", $postSubject, $postContent, $_SESSION['u_uid'], $fileDestination);
                        mysqli_stmt_execute($stmt);
                        header("Location: ../homepage.php?uploadsuccess");
                        exit();
                    }
                }else{
                    echo "File size bigger then 5mb";
                }
            }else{
                echo "There was an error uploading your file";
            }
       }
       else{
        echo "You cannot upload files of this type";
       }
    }
?>