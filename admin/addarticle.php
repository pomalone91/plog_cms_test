<?php
// TODO - Add revision button to undeleted rows
// TODO - hook up revision button to republish.php
require_once '../DataBaseConnection.php';
include '../header.php';
session_start();

if ($_SESSION['user'] == 'admin') {
    // Table with published articles w/ buttons to delete
    displayHeader('Admin Interface');
    
    // Form to add new articles
    echo '<h2> Add new articles </h2>';
//     echo '<html>';
//     echo '<body>';
    echo '<form action="upload.php" method="post" enctype="multipart/form-data">';

    // Text inputs
    echo 'Title: <input type="text" name="title"><br>';
    echo 'Summary: <input type="text" name="summary"><br>';

    // Upload file
    echo 'Select article to upload:';
    echo '<input type="file" name="fileToUpload" id="fileToUpload">';
    echo '<input type="submit" value="Upload File" name="submit">';
    echo '</form>';
    
    header("Location:userlogin.php");
} else {
    header("Location:userlogin.php");
}

?>