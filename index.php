<?php
// TODO - Forward paulmalone.blog
// TODO - Fix article order in index.php
// TODO - Update about section
// TODO - Update Plog Mac app
// TODO - Write "Soul of the Same Machine"
// TODO - Write "Stickiness of Religion"
/* TODO - Create web interface for CMS
        - Login
        - Upload
        - Form for title, summary and url to file
*/

// Show header
include "header.php";
include "markdownHandler.php";
displayHeader("Home");

// Make connection to database.
require_once 'DataBaseConnection.php';

// Greeting
// echo "<h1>Welcome to the Pblog</h1>";
echo '<div id="articles">';

// Gather 5 newest articles from database
$statement = "SELECT id, title, summary, pubDate FROM blog.articles WHERE deleteDate is NULL ORDER BY pubDate DESC LIMIT 5";
$results = $con->query($statement);     // Get array of results of query

// Show error message.
if (!$results) {
    $message = "Whole query " . $search;
    echo $message;
    die('Invalid query: ' . mysqli_error($con));
}


// Loop through the articles pulled in by the query.
while ($row = $results->fetch_assoc()) {
    // Make a new article tag for that article.
    echo "<article>";
    echo '<h2><a href="article.php?id=' . $row['id'] . '">' . $row['title'] . '</a></h2>';
    echo "<p> <strong>" . parseMarkdown($row['summary']) . "</strong> </p>";
    echo "<p>" . $row['content'] . "</p>";
    echo "</article>";
}

echo '</div>';

// Show footer
include "footer.php";
?>