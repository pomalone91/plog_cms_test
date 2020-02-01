<?php
require_once '../DataBaseConnection.php';

print_r($_POST);

// Set variables
$username = 'admin';
$password = 'TestPassword12345-0987';
$hashed = hash("ripemd128", $password);
$addedAt = date("Y/m/d");

// Determine what use wanted to do
    $insert = "INSERT INTO `blog`.`users` (`username`, `password`, `addedAt`) VALUES ('$username', '$hashed', '$addedAt');";
    $success = $con->query($insert);
    if ($success == false) {
        $failmess = "Whole query" . $insert . "<br>";
        echo $failmess;
        die ('Invalid query: ' . mysqli_error($con));
    } else {
     	echo "<br>You added: $username, at $addedAt";
    }
?>
<br><a href="form.php">Back</a>
<br><a href="userlogin.php">Back to log in</a>