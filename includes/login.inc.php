<?php 
    session_start();
    if(isset($_POST['loginButton'])){
        include 'dbh.inc.php';
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        // Error handler
        if(empty($email) || empty($password)){
            echo "wolo1";
            header("Location ../index.php?login=empty");
            exit();
        }else {
            $sql = "SELECT * FROM users WHERE user_email='$email'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck < 1) {
                echo "wolo2";
                header("Location: ../index.php?login=emailNotFound");
                exit();
            } else {
                if($row = mysqli_fetch_assoc($result)){
                    // dehashing the password
                    $hashedPwdCheck = password_verify($password, $row['user_password']);
                    if($hashedPwdCheck == false){
                        echo "wolo3";
                        header("Location: ../index.php?login=wrongPassword");
                        exit();
                    } elseif ($hashedPwdCheck == true) {
                        // log in the user here
                        $_SESSION['u_id'] = $row['user_id'];
                        $_SESSION['u_first'] = $row['user_first'];
                        $_SESSION['u_last'] = $row['user_last'];
                        $_SESSION['u_email'] = $row['user_email'];
                        $_SESSION['u_uid'] = $row['user_uid'];
                        echo "wolo4";
                        header("Location: ../index.php?login=success");
                        exit();
                    }
                }
            }
        }
    } else {
        header("Location ../index.php?login=error");
        exit();
    }


?>