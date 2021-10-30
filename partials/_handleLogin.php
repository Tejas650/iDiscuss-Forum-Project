<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include '_db.php';
    $user = $_POST['username'];
    $password = $_POST['password'];

    $sql = "Select * FROM `users` where user_email ='$user'";
    $result = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($result);
    if($num==1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['pass'])){
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['sno'] = $row['sno'];
            $_SESSION['username'] = $user;
            echo "loggedin " . $user;
        }
        header("Location: /idiscuss forum project/index.php");
    }
    header("Location: /idiscuss forum project/index.php");
}

?>