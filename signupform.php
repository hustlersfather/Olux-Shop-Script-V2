<?php
ob_start();
session_start();
include "includes/config.php";
date_default_timezone_set('UTC');

if(isset($_SESSION['sname']) and isset($_SESSION['spass'])){
    header("location: index.html");
    exit();
}

if (isset($_POST['username'],$_POST['email'],$_POST['password_signup'],$_POST['password_signup2'])) {
    $uname = strip_tags($_POST['username']);
    $email = strip_tags($_POST['email']);
    $pass1 = strip_tags($_POST['password_signup']);
    $pass2 = strip_tags($_POST['password_signup2']);
    $ip    = getenv("REMOTE_ADDR");
    $rdate = date("y-m-d");
    $lvisi = date('y-m-d');

    $passstrlen = strlen($pass1);

    $stmt = mysqli_prepare($dbcon, "SELECT * FROM users WHERE username=?");
    mysqli_stmt_bind_param($stmt, "s", $uname);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $userexist = mysqli_num_rows($result);

    $stmt = mysqli_prepare($dbcon, "SELECT * FROM users WHERE email=?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $emailexist = mysqli_num_rows($result);

    if(empty($uname) or empty($email) or empty($pass1) or empty($pass2)){
        $errorbox = "<div class='alert alert-dismissible alert-info'><button type='button' class='close' data-dismiss='alert'>×</button><p>Please check all entries</p></div>";
        echo '{"state":"0","errorbox":"'.$errorbox.'","url":""}';
    }elseif(strlen($uname) > 16){
        $errorbox = "<div class='alert alert-dismissible alert-info'><button type='button' class='close' data-dismiss='alert'>×</button><p>Username must be less than 16 chars.</p></div>";
        echo '{"state":"0","errorbox":"'.$errorbox.'","url":""}';
    }elseif($userexist == 1 || $uname == "NONE" || $uname == "NULL" || $uname == "SYSTEM" || $uname == "none" || $uname == "system"){
        header('location:signup.html?error=userexist');
        exit;
    }elseif($emailexist == 1){
        header('location:signup.html?error=emailexist');
        exit;
    }elseif($pass1 != $pass2){
        header('location:signup.html?error=passnotmatch');
        exit;
    }elseif($passstrlen <6 or $passstrlen > 16){
        header('location:signup.html?error=passlength');
        exit;
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errorbox = "<div class='alert alert-dismissible alert-info'><button type='button' class='close' data-dismiss='alert'>×</button><p>Invalid email!</p></div>";
        echo '{"state":"0","errorbox":"'.$errorbox.'","url":""}';
    }else{
        $password = password_hash($pass1, PASSWORD_DEFAULT);

        $stmt = mysqli_prepare($dbcon, "INSERT INTO users
        (username,password,email,balance,ipurchassed,ip,lastlogin,datereg,resseller,img,testemail,resetpin)
        VALUES
        (?,?,?,?,?,?,?,?,?,?,?,?)");
        mysqli_stmt_bind_param($stmt, "sssssssssssi", $uname, $password, $email, $balance, $ipurchassed, $ip, $lvisi, $rdate, $resseller, $img, $email, $resetpin);
        mysqli_stmt_execute($stmt);

        header('location:login.html?success=register');
        exit;
    }
    mysqli_close($dbcon);
    ob_end_flush();
} else {
    header('location:index.html');
    exit;
}
?>