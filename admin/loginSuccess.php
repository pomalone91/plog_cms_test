<?php
// TODO - Add revision button to undeleted rows
// TODO - hook up revision button to republish.php
require_once '../DataBaseConnection.php';
include '../header.php';
session_start();

if ($_SESSION['user'] == 'admin') {
    // Table with published articles w/ buttons to delete
    displayHeader('Admin Interface');
    echo '<h2> Published Articles </h2>';
    
    // Select article titles for re-upload
    $statement = "SELECT id, title, filename FROM blog.articles WHERE deleteDate IS NULL ORDER BY id";
    $results = $con->query($statement);     // Get array of results of query
    // Show error message.
    if (!$results) {
        $message = "Whole query " . $search;
        echo $message;
        die('Invalid query: ' . mysqli_error($con));
    }
    
    // New form with dropdown menu for re-upload
//     echo '<select id="reuploads" name="article-list" form="reuploadform">';
//     while ($row = $results->fetch_assoc()) {
//         $id = $row['id'];
//         $title = $row['title'];
//         echo '<option value="' . $id . '">' . $title . '</option>';
//     }
//     echo '</select>';
//     
//     echo '<form action="reupload.php" method="post" enctype="multipart/form-data" id="reuploadform">';
//     echo '<input type="file" name="fileToUpload" id="fileToUpload">';
//     echo '<input type="submit" value="Upload File" name="submit">';
//     echo '</form>';
    
    
    

    // Query for published articles
    // SELECT where deletedAt is NULL    
    $statement = "SELECT id, title, filename, pubDate, lastPublished FROM blog.articles WHERE deleteDate IS NULL ORDER BY id";
    $results = $con->query($statement);     // Get array of results of query
    // Show error message.
    if (!$results) {
        $message = "Whole query " . $search;
        echo $message;
        die('Invalid query: ' . mysqli_error($con));
    }
    // Form for unpublishing articles
    echo '<table>';
        echo "<tr><th> ID </th><th> Title </th><th> Published </th><th> Last Revised </th></tr>";



    // Loop through the articles pulled in by the query.
    while ($row = $results->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id']  . '</td>';
        echo '<td> <a href="articleupdate.php?id=' . $row['id'] . '">' . $row['title'] . 
        '</a></td>';
        echo '<td>' . $row['filename'] . '</td>';
        echo '<td>' . $row['pubDate'] . '</td>';
        echo '<td>' . $row['lastPublished'] . '</td>';
        echo '</tr>';
    }

    // Add a button that unpublishes articles
    // Clicking it will launch a PHP script to insert it
    // When the button is clicked I need to get the ID for the entry it corresponds to into the $_SESSION? Or the $_POST? And then launch my delete.php script
    echo '</table>';


    // Second table showing deleted articles w/ buttons to publish
    echo '<h2> Unpublished </h2>';
//     echo '<form action="publish.php" method="post">';
    echo '<table>';
    echo "<tr><th> ID </th><th> Title </th><th> Published </th></tr>";
    // Query for published articles
    // SELECT where deletedAt is NULL
    $statement = "SELECT id, title, filename, pubDate FROM blog.articles WHERE deleteDate IS NOT NULL ORDER BY id";
    $results = $con->query($statement);     // Get array of results of query

    // Show error message.
    if (!$results) {
        $message = "Whole query " . $search;
        echo $message;
        die('Invalid query: ' . mysqli_error($con));
    }

    // Loop through the articles pulled in by the query.
    while ($row = $results->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id']  . '</td>';
        echo '<td> <a href="articleupdate.php?id=' . $row['id'] . '">' . $row['title'] . 
        '</a></td>';
        echo '<td>' . $row['filename'] . '</td>';
        echo '<td>' . $row['pubDate'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';

    // Form to add new articles
    echo '<h2> Add new articles </h2>';
    echo '<html>';
    echo '<body>';
    echo '<form action="upload.php" method="post" enctype="multipart/form-data">';

    // Text inputs
    echo 'Title: <input type="text" name="title"><br>';
    echo 'Summary: <input type="text" name="summary"><br>';

    // Upload file
    echo 'Select article to upload:';
    echo '<input type="file" name="fileToUpload" id="fileToUpload">';
    echo '<input type="submit" value="Upload File" name="submit">';
    echo '</form>';
    echo '</body>';
    echo '</html>';

//     echo "Session user: <br>";
//     var_dump($_SESSION);
} else {
    header("Location:userlogin.php");
}

?>