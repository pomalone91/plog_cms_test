<?php
include "header.php";
displayHeader("Archive");

// Make connection to database.
require_once 'DataBaseConnection.php';

// Greeting Message and SQL query for articles
echo "<h2>Archive</h2>";
$statement = "SELECT id, title, pubDate FROM blog.articles where deleteDate is NULL ORDER BY pubDate DESC";
$results = $con->query($statement);     // Get array of results of query

// Show error message.
if (!$results) {
    $message = "Whole query " . $search;
    echo $message;
    die('Invalid query: ' . mysqli_error($con));
}

// Start table tag
echo '<table>';
echo "<tr><th> Title </th><th> Published </th></tr>";

// Loop through the articles pulled in by the query.
while ($row = $results->fetch_assoc()) {
    // Date set up
    $pubDate = new DateTime($row['pubDate']);
    
    // Start a new table row
    echo '<tr>';
    echo '<td>';
    echo '<strong><a href="article.php?id=' . $row['id'] . '">' . $row['title'] . '</a></strong>';
    echo '</td>';
    echo '<td>';
    echo $pubDate->format('j F, Y');
    echo "</td>";
    echo '</tr>';
}
echo '</table>';

include "footer.php";
?>
