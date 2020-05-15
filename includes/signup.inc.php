<?php
    if(isset($_POST['signUpButton'])){
        include_once 'dbh.inc.php';
        $wolo = "wolo";
        $userFirst = mysqli_real_escape_string($conn, $_POST['userFirst']);
        $userLast = mysqli_real_escape_string($conn, $_POST['userLast']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $uid = mysqli_real_escape_string($conn, $_POST['uid']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        // Error Handler
        if(empty($userFirst) || empty($userLast) || empty($email) || empty($uid) || empty($password)){
            header("Location: ../signup.php?signup=empty");
            exit();
        }
        else{
            //Check if input characters are valid
            if(!preg_match("/^[a-zA-Z]*$/", $userFirst) || !preg_match("/^[a-zA-Z]*$/", $userLast)){
                header("Location: ../signup.php?signup=invalid");
                exit();
            } else {
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        header("Location: ../signup.php?signup=invalidEmail");
                        exit();
                    } else {
                        // check if user_uid already exist
                        $sql = "SELECT * from users WHERE user_uid= '$uid' ";
                        $result = mysqli_query($conn, $sql);
                        $resultCheck = mysqli_num_rows($result);
                        if($resultCheck > 0){
                            header("Location: ../signup.php?signup=userExist");
                            exit();
                        } else {
                            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                            // Insert the user into the database
                            $insertSql = "insert into users (user_first, user_last, user_email, user_uid, user_password) VALUES (?, ?, ?, ?, ?); ";
                            $stmt = mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt, $insertSql)){
                                echo "insert SQL error";
                            } else{
                                mysqli_stmt_bind_param($stmt, "sssss", $userFirst, $userLast, $email, $uid, $hashedPwd);
                                mysqli_stmt_execute($stmt);
                                 header("Location: ../signup.php?signup=success");
                                exit();
                            }




                           
                        }
                    }
                 }
        }
    } else {
        header("Location: ../signup.php?signup=wololo");
        exit();
    }

?>