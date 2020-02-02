<?php
// *** LIVE SET UP *** //
// $host = "127.0.0.1";
// $user = "root";
// $password = "plog90";
// $dbname = "Library";
// $key = "99754106633f94d350db34d548d6091a";

// *** TEST SET UP *** //
$host = "127.0.0.1";
$user = "root";
$password = "lemming89";
$dbname = "blog";
$key = "99754106633f94d350db34d548d6091a";

$con = new mysqli($host, $user, $password, $dbname)
	or die ('Could not connect to the database server' . mysqli_connect_error($con));
if($con->connect_error == false) {
//    echo "<h2>We Connected</h2>";
} else {
    echo $con->connect_error;
}
//print_r($con);

//$con->close();

// passphrase=44fdcv8jf3&title=posttest&summary=poop&filename=articles/file.md