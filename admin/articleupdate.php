<?php

require_once '../DataBaseConnection.php';
include '../header.php';
session_start();

if ($_SESSION['user'] == 'admin') {    
    $id = isset( $_GET['id'] ) ? $_GET['id'] : "";
//     echo $id;

    // Set up SQL query
    // TODO - don't use * in select statement
    $statement = "SELECT id, title, filename, pubDate, lastPublished FROM blog.articles WHERE deleteDate IS NULL AND id =" . $id;
    $results = $con->query($statement);     // Get array of results of query

    // Show error message.
    if (!$results) {
        $message = "Whole query " . $search;
        echo $message;
        die('Invalid query: ' . mysqli_error($con));
    }

    // Loop through the articles pulled in by the query.
    while ($row = $results->fetch_assoc()) {
        // Display header w/ article's title.
        displayHeader($row['title']);
    
        // Get published and last published dates into proper formatOutput
        $pubDate = new DateTime($row['pubDate']);
        $lastPublished = new DateTime($row['lastPublished']);
    
        // Make a new article tag for that article.    
        echo "<title>" .$row['title'] . "</title>";
        echo "</head>";
        echo "<body>";
        echo "<article>";
        echo "<p>";
        echo "<h2>" . $row['title'] . "</h2>";
        echo "<em>" . $pubDate->format('j F, Y') . "</em><br>";
        if ($row['lastPublished'] != NULL) {
            echo "<em> Last revised " . $lastPublished->format('j F, Y') . "</em>";    
        }
        echo "</p>";
        
        // File update
        echo '<h3>File</h3>';
        
        // New form with dropdown menu for re-upload
//         echo '<select id="reuploads" name="article-list" form="reuploadform">';
//         while ($row = $results->fetch_assoc()) {
//             $id = $row['id'];
//             $title = $row['title'];
//             echo '<option value="' . $id . '">' . $title . '</option>';
//         }
//         echo '</select>';
    
        echo '<form action="reupload.php" method="post" enctype="multipart/form-data">';
        // Extra hidden input to grab ID
        echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
        echo 'File: ' . $row['filename'] . '<br>';
        echo '<input type="file" name="fileToUpload" id="fileToUpload" value="' . $row['id'] . '">';
        echo '<input type="submit" value="Upload File" name="submit">';
        echo '</form>';

        
        
        // Image management
        // Show list of image files with options to delete and upload new ones
        echo '<h3>Images</h3>';
        
        // Publishing options
        // Show current publishing status.
        // If published show option to unpublish and vice versa
        echo '<h3>Publishing</h3>';
                
    //     echo "<h2>" . $row['title'] . "</h2>";
    //     echo "<p> <strong>" . $row['summary'] . "</strong> </p>";
        // Echo the markdown contents here
//         echo getMarkdown("articles/" . $row['filename']);
    //     echo "<p>" . $row['content'] . "</p>";
        echo "</article>";
    }
        
} else {
    header("Location:userlogin.php");
}

?>