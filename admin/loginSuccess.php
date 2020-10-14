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
    echo '<h2> <a href="addarticle.php"> Add a New Article</a> </h2>';
//     echo '<html>';
//     echo '<body>';
    // echo '<form action="upload.php" method="post" enctype="multipart/form-data">';
// 
//     // Text inputs
//     echo 'Title: <input type="text" name="title"><br>';
//     echo 'Summary: <input type="text" name="summary"><br>';
// 
//     // Upload file
//     echo 'Select article to upload:';
//     echo '<input type="file" name="fileToUpload" id="fileToUpload">';
//     echo '<input type="submit" value="Upload File" name="submit">';
//     echo '</form>';
//     echo '</body>';
//     echo '</html>';
    // Static page views
    echo '<h2>Static Page Counts</h2>';

    $staticStatement = "SELECT description, views FROM blog.static_views";
    $staticResults = $con->query($staticStatement);     // Get array of results of query
    
//     $results = $con->query($statement);     // Get array of results of query
    // Show error message.
    if (!$staticResults) {
        $message = "Whole query " . $search;
        echo $message;
        die('Invalid query: ' . mysqli_error($con));
    }
    echo '<div id="table-scroller">';
    echo '<table>';
    echo "<tr><th> Description </th><th> Views </th></tr>";

        // Loop through the articles pulled in by the query.
    while ($row = $staticResults->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['description']  . '</td>';
        echo '<td>' . $row['views'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '</div>';

    // Published Articles    
    echo '<h2> Published Articles </h2>';
    
    // Select article titles for re-upload
    $statement = "SELECT id, title, filename, views FROM blog.articles WHERE deleteDate IS NULL ORDER BY id";
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
    $statement = "SELECT id, title, filename, pubDate, lastPublished, views FROM blog.articles WHERE deleteDate IS NULL ORDER BY id";
    $results = $con->query($statement);     // Get array of results of query
    // Show error message.
    if (!$results) {
        $message = "Whole query " . $search;
        echo $message;
        die('Invalid query: ' . mysqli_error($con));
    }
    // Form for unpublishing articles
    echo '<div id="table-scroller">';
    echo '<table>';
        echo "<tr><th> ID </th><th> View Count </th><th> Title </th><th> Filename </th><th> Published </th><th> Last Revised </th></tr>";



    // Loop through the articles pulled in by the query.
    while ($row = $results->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id']  . '</td>';
        echo '<td>' . $row['views'] . '</td>';
        echo '<td> <a href="articleupdate.php?id=' . $row['id'] . '">' . $row['title'] . 
        '</a></td>';
        echo '<td>' . $row['filename'] . '</td>';

        
        $pubDate = new DateTime($row['pubDate']);
        echo '<td>' . $pubDate->format('m-d-y') . '</td>';
        
        $lastPublished = new DateTime($row['lastPublished']);
        echo '<td>' . $lastPublished->format('m-d-y') . '</td>';
        echo '</tr>';
    }

    // Add a button that unpublishes articles
    // Clicking it will launch a PHP script to insert it
    // When the button is clicked I need to get the ID for the entry it corresponds to into the $_SESSION? Or the $_POST? And then launch my delete.php script
    echo '</table>';
    echo '</div>';

    // Second table showing deleted articles w/ buttons to publish
    echo '<h2> Unpublished </h2>';
//     echo '<form action="publish.php" method="post">';
    echo '<div id="table-scroller">';
    echo '<table>';
    echo "<tr><th> ID </th><th> View Count </th><th> Title </th><th> Filename </th><th> Published </th></tr>";
    // Query for published articles
    // SELECT where deletedAt is NULL
    $statement = "SELECT id, title, filename, pubDate, views FROM blog.articles WHERE deleteDate IS NOT NULL ORDER BY id";
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
        echo '<td>' . $row['views'] . '</td>';
        echo '<td> <a href="articleupdate.php?id=' . $row['id'] . '">' . $row['title'] . 
        '</a></td>';
        echo '<td>' . $row['filename'] . '</td>';
        
        $pubDate = new DateTime($row['pubDate']);
        echo '<td>' . $pubDate->format('m-d-y') . '</td>';
//         echo '<td>' . $row['pubDate'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '</div>';
    echo '<br>';
    echo '<br>';
    echo '<br>';
    echo '<br>';
    echo '<br>';

    

//     echo "Session user: <br>";
//     var_dump($_SESSION);
} else {
    header("Location:userlogin.php");
}

?>