<?php
echo exec('whoami');
echo "<br>";

$target_dir = "/Library/WebServer/Documents/plog_cms_test/articles/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;

// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

echo "var_dump $_POST: ";
var_dump($_POST);
echo "<br>";

// Check if file is markdown
if(isset($_POST["submit"])) {
    $type = $_FILES["fileToUpload"]["type"];
    echo $type;
    echo "<br>";
    if($type != "text/markdown") {
        echo "Bad file type. Should be plaintext Markdown<br>";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Do the upload
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>