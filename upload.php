<?php
echo "we uploadin";
$target_dir = "/tmp";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

echo "var_dump $_POST: ";
var_dump($_POST);

// Check if file is markdown
if(isset($_POST["submit"])) {
    $type = $_FILES["fileToUpload"]["type"]);
    echo $type;
    if($type !== "text/markdown" || "text/plain") {
        echo "Bad file type. Should be plaintext Markdown";
        $uploadOk = 0;
    } else {
        echo "Upload okay.";
        $uploadOk = 1;
    }
}



// *** OLD STUFF BELOW *** //
// What's in body?
// $body = file_get_contents("php://input");
// echo "body: ";
// print_r($body);
// echo "<br>";
// 
// What's in $_POST?
// echo "var_dump $_POST: ";
// var_dump($_POST);
// echo "<br>";
// 
// What's in /tmp?
// echo "scandir /tmp";
// $dir = "/tmp";
// print_r(scandir($dir, 0));
// echo "<br>";
// 
// What's in $_FILES?
// echo "files: ";
// print_r($_FILES);
// echo "<br>";
?>