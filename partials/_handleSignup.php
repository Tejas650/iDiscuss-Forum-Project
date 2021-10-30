<?php
$showError = false;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include '_db.php';
    $user_email = $_POST['username'];
    $pass = $_POST['signupPassword'];
    $cpass = $_POST['csignupPassword'];

    $existSql = "Select * from `users` WHERE user_email = '$user_email'";
    $result = mysqli_query($conn, $existSql);
    $num = mysqli_num_rows($result);
    if($num > 0){
        $showError = "User name is already exist";
    }
    else{
        if($pass == $cpass){
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `pass`, `date`) VALUES ('$user_email', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if($result){
                $showAlert = true;
                header("Location: /idiscuss forum project/index.php?signupsuccess=true");
                exit();
            }
        }
        else{
            $showError = "Password do not matched";
        }
    }
    header("Location: /idiscuss forum project/index.php?signupsuccess=false&error=$showError");
}

?>