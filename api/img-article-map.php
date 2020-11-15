<?php
// Connect to database
require_once '../DataBaseConnection.php';

// API request should include the article id
$articleID = $_GET['id'];

// Query database
$statement = "SELECT imageID, filename FROM blog.images WHERE articleID = " . $articleID .  " AND deleteDate is NULL";

$results = $con->query($statement);     // Get array of results of query

// print_r($results);

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
// print_r($resultsArray);
// Display results encoded as JSON
echo json_encode($resultsArray);


?>