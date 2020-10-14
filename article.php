<?php
// TODO - Add original and revision dates above first H2
include "header.php";
include "markdownHandler.php";
// Get article ID from URL
$id = isset( $_GET['id'] ) ? $_GET['id'] : "";

// Connect to Database
require_once 'DataBaseConnection.php';

// Set up SQL query
// TODO - don't use * in select statement
$statement = "SELECT * FROM blog.articles where id =" . $id . " and deleteDate is null";
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
//     echo "<h2>" . $row['title'] . "</h2>";
//     echo "<p> <strong>" . $row['summary'] . "</strong> </p>";
    // Echo the markdown contents here
    echo getMarkdown("articles/" . $row['filename']);
//     echo "<p>" . $row['content'] . "</p>";
    echo "</article>";
    
    // Update page view count
    $views = $row['views'];
    $views += 1;
    
    $viewsUpdateStatement = $con->prepare('UPDATE blog.articles SET views = ' . $views . ' WHERE id = ' . $id);
    $viewsUpdateResults = $viewsUpdateStatement->execute();
}
include "footer.php";
?>
    