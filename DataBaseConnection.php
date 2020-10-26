<?php
include "keys.php";

$con = new mysqli($host, $user, $dbPassword, $dbname)
	or die ('Could not connect to the database server' . mysqli_connect_error($con));
if($con->connect_error == false) {
//    echo "<h2>We Connected</h2>";
} else {
    echo $con->connect_error;
}
//print_r($con);

//$con->close();