<?php
include "header.php";
displayHeader("Archive");

// Make connection to database.
require_once 'DataBaseConnection.php';

// Greeting Message and SQL query for articles
echo "<h1>Archive</h1>";
$statement = "SELECT * FROM blog.articles where deleteDate is NULL ORDER BY pubDate DESC";
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
    echo "<p> <strong>" . $row['summary'] . "</strong> </p>";
    echo "<p>" . $row['content'] . "</p>";
    echo "</article>";
}

include "footer.php";
?>
