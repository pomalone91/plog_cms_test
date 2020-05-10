<?php
// TODO - Write "Stickiness of Religion"
/* TODO - Create web interface for CMS
        - Login
        - Upload
        - Form for title, summary and url to file
*/

// Show header
include "header.php";
include "markdownHandler.php";
displayHeader("Nine Circles of Shell");

// Make connection to database.
require_once 'DataBaseConnection.php';

// Greeting
// echo "<h1>Welcome to the Pblog</h1>";
echo '<div id="articles">';

// Gather 5 newest articles from database
$statement = "SELECT id, title, filename, pubDate, lastPublished FROM blog.articles WHERE deleteDate is NULL ORDER BY pubDate DESC LIMIT 5";
$results = $con->query($statement);     // Get array of results of query

// Show error message.
if (!$results) {
    $message = "Whole query " . $search;
    echo $message;
    die('Invalid query: ' . mysqli_error($con));
}


// Loop through the articles pulled in by the query.
while ($row = $results->fetch_assoc()) {
    // Get dates
    $pubDate = new DateTime($row['pubDate']);
    $lastPublished = new DateTime($row['lastPublished']);
    
    // Make a new article tag for that article.
    echo "<article>";
    echo '<h2><a href="article.php?id=' . $row['id'] . '">' . $row['title'] . '</a></h2>';
    echo "<em>" . $pubDate->format('j F, Y') . "</em><br>";
    if ($row['lastPublished'] != NULL) {
        echo "<em> Last revised " . $lastPublished->format('j F, Y') . "</em>";    
    }
    // echo "<p>" . parseMarkdown($row['summary']) . " </p>";
	echo "<p>" . getMarkdown("articles/" . $row['filename']) . " </p>";
    echo "<p>" . $row['content'] . "</p>";
    echo "</article>";
    echo "<hr>";
}

echo '</div>';

// Link to archive
echo '<div id="more">';
echo '<a href="archive.php">More articles...</a>';
echo '</div>';

// Show footer
include "footer.php";
?>