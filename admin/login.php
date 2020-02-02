<?php
session_start();
unset($_SESSION['badPass']);

$myusername = $_POST['myusername'];
$mypassword = $_POST['mypassword'];
$_SESSION['success'] = 0;

require_once '../DataBaseConnection.php';

$hashed = hash("ripemd128", $mypassword);

$sql = "SELECT * FROM blog.users where username='" . $myusername . "' and password='" . $hashed . "'";
// echo $sql;
$result = $con->query($sql);


if (!result) {
    $message = "Whole query " . $sql;
//     echo $message;
    die('Invalid query: ' . mysqli_error());
}

$count = $result->num_rows;

if ($count == 1) {
//     echo("login success");
    $_SESSION['user'] = $myusername;
    $_SESSION['password'] = $mypassword;
    $_SESSION['success'] = 1;
//     var_dump($_SESSION);
    header("Location:loginSuccess.php");
} else {
//     echo("login failed");
    header("Location:userlogin.php");
    $_SESSION['badPass']++;
}



