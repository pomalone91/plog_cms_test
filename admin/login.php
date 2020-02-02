<?php
session_start();
unset($_SESSION['badPass']);

$username = $_POST['username'];
$password = trim($_POST['password']);

require_once '../DataBaseConnection.php';

$hashed = hash("ripemd128", $password);

$sql = "SELECT * FROM blog.users WHERE username='" . $username . "' AND password='" . $hashed . "' AND deletedAt IS NULL";
// echo "<br>" . $sql;
$result = $con->query($sql);


if (!result) {
    $message = "Whole query " . $sql;
//     echo $message;
    die('Invalid query: ' . mysqli_error());
}

$count = $result->num_rows;

// echo "<br># of rows returned: ";
// echo $count;

if ($count == 1) {
//     echo("login success");
    $_SESSION['user'] = $username;
    $_SESSION['password'] = $password;
//     echo "<br>dumping session: ";
//     var_dump($_SESSION);
    header("Location:loginSuccess.php");
} else {
//     echo "<br>login failed"; 
    header("Location:userlogin.php");
    $_SESSION['badPass']++;
}



