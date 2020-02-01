<?php
// Connect to database
require_once 'DataBaseConnection.php';

// Query database
$statement = "SELECT id, title, summary, pubDate, filename FROM blog.articles WHERE deleteDate is NULL ORDER BY pubDate DESC";
$results = $con->query($statement);     // Get array of results of query

// Show error message.
if (!$results) {
    $message = "Whole query " . $search;
    echo $message;
    die('Invalid query: ' . mysqli_error($con));
}

// Fetch data from results and encode in JSON
$resultsArray = array();
while ($row = $results->fetch_assoc()) {
    $resultsArray[] = $row;
}

// Display results encoded as JSON
echo json_encode($resultsArray);


?>