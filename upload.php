<?php
// What's in body?
$body = file_get_contents("php://input");
echo "body: ";
print_r($body);
echo "<br>";

// What's in $_POST?
echo "var_dump $_POST: ";
var_dump($_POST);
echo "<br>";

// What's in /tmp?
echo "scandir /tmp";
$dir = "/tmp";
print_r(scandir($dir, 0));
echo "<br>";

// What's in $_FILES?
echo "files: ";
print_r($_FILES);
echo "<br>";
?>