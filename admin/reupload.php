<?php
// TODO - Clean up print statments
session_start();
require_once '../DataBaseConnection.php';

if ($_SESSION['user'] == 'admin') {
    $target_dir = "/Library/WebServer/Documents/plog_cms_test/articles/";
//     /*LIVE DIRECTORY*/ $target_dir = "/var/www/html/ninecirclesofshell.com/public_html/articles/";
    $filename = basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . $filename;
    $id = $_POST['article-list'];
    echo $filename;
    echo $target_file;
//     echo '<br>';
// 
//     // Meta data
//     $title = $_POST['title'];
//     $summary = $_POST['summary'];
// 
//     echo "Title: " . $title . "<br>";
//     echo "Summary: " . $summary . "<br>";

    $uploadOk = 1;

    // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

//     echo "var_dump $_POST: ";
//     var_dump($_POST);
//     echo "<br>";

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
//     if (file_exists($target_file)) {
//         echo "Sorry, file already exists.";
//         $uploadOk = 0;
//     }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
    // TODO - Check if filename matches at id. If it doesn't, cancel the upload and warn user
    // query table for filename at id
    // compare and if no match abort upload
    echo 'id is ';
    echo $id;
    $fileNameInTables = '';
    $fileNameStatement = "SELECT filename FROM blog.articles WHERE id = " . $id;
    $results = $con->query($fileNameStatement);
    
    // Show error message.
    if (!$results) {
        $message = "Whole query " . $search;
        echo $message;
        die('Invalid query: ' . mysqli_error($con));
    } else {
        echo '<br> Filename in table is ';
    
        while ($row = $results->fetch_assoc()) {
            $fileNameInTables = $row['filename'];
        }    
    }
    echo $fileNameInTables;
    
    if ($fileNameInTables != $filename) {
        echo "file name does not match value in table " . $fileNameInTables;
    } else {
        // Do the upload
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            // If file already exists delete it
            if (file_exists($target_file)) {
                unlink($target_file);
            }
            
            // Upload file
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". basename($_FILES["fileToUpload"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
                echo '<br>';
                echo $_FILES["fileToUpload"]["tmp_name"];
                echo '<br>';
                echo basename($_FILES["fileToUpload"]["name"]);
                echo '<br>';
                var_dump($_FILES);
            }
        }

        // If the file was re-uploaded, update records in database
        if ($uploadOk == 1) {
            echo '<br>';
            echo 'id is ';
            echo $id;
            echo '<br>';
            $statement = $con->prepare("UPDATE blog.articles SET lastPublished = CURRENT_DATE() WHERE id = " . $id);
    //         $statement->bind_param("i", $id);
            $result = $statement->execute();
    
        //     Uncomment below to show error message in testing
 
        //     if (!$results) {
        //         $message = "Whole query " . $search;
        //         echo $message;
        //         die('Invalid query: ' . mysqli_error($con));
        //     }

        }    
    }   
} else {
    header("Location:userlogin.php");
}

?>