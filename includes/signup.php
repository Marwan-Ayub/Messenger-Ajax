<?php
include 'config.php';
$username = x($_POST['username']);
$email = x($_POST['email']);
$password = x($_POST['password']);
$age = x($_POST['age']);
$gender = x($_POST['gender']);

if(empty($username) || empty($email) || empty($password) || empty($age) || empty($gender)){
   exit('Please fill all boxes');
}

if(!preg_match('/^[a-zA-Z]*$/',$username)){
    exit('Username is invalid');
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    exit('Email is invalid');
}

if( $age > 100 || $age <= 14){
    exit('Age is not valid');
}

$checkUser = mysqli_query($db, "SELECT `username` FROM `user` WHERE `username` = '$username'");
if(mysqli_num_rows($checkUser) > 0){
    exit('Username already exists');
}


$checkEmail = mysqli_query($db, "SELECT `email` FROM `user` WHERE `email` = '$email'");
if(mysqli_num_rows($checkEmail) > 0){
    exit('Username already exists');
}

// success
$password = hash('gost',$password);
$success = mysqli_query($db, "INSERT INTO `user`(`username`,`email`,`password`,`age`,`gender`) VALUES ('$username','$email','$password','$age','$gender')");
if($success){
    exit("success");
}