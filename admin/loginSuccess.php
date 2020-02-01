<?php
require_once '../DataBaseConnection.php';

// Table with published articles w/ buttons to delete
echo '<h2> Published Articles </h2>';
echo '<form action="delete.php" method="post">';
echo '<table>';
    echo "<tr><th> ID </th><th> Title </th><th> Published </th></tr>";
// Query for published articles
// SELECT where deletedAt is NULL
$statement = "SELECT id, title, filename, pubDate FROM blog.articles WHERE deleteDate IS NULL ORDER BY id";
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
    echo '<td>' . $row['title'] . '</td>';
    echo '<td>' . $row['filename'] . '</td>';
    echo '<td>' . $row['pubDate'] . '</td>';
    echo '<td><input type="checkbox" name="id' . $row['id'] . '" value="' .$row['id'] . '"> Unpublish';
    echo '</tr>';
}

// TODO - Add a button that unpublishes articles
// Clicking it will launch a PHP script to insert it
// When the button is clicked I need to get the ID for the entry it corresponds to into the $_SESSION? Or the $_POST? And then launch my delete.php script
echo '</table>';
echo '<input type="submit">Unpublish</input>';
echo '</form>';


// Second table showing deleted articles w/ buttons to publish
echo '<h2> Unpublished </h2>';
echo '<form action="publish.php" method="post">';
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
    echo '<td>' . $row['title'] . '</td>';
    echo '<td>' . $row['filename'] . '</td>';
    echo '<td>' . $row['pubDate'] . '</td>';
    echo '<td><input type="checkbox" name="id' . $row['id'] . '" value="' .$row['id'] . '"> Publish </td>';
    echo '</tr>';
    // Make a new article tag for that article.

//     echo '<h2><a href="article.php?id=' . $row['id'] . '">' . $row['title'] . '</a></h2>';
//     echo "<p> <strong>" . parseMarkdown($row['summary']) . "</strong> </p>";
//     echo "<p>" . $row['content'] . "</p>";
//     echo "</article>";
}
echo '</table>';
echo '<input type="submit">Publish</input>';
echo '</form>';



// Form to add new articles
echo '<h2> Add new articles </h2>';
// Upload field button
echo '<html>';
echo '<body>';
echo '<form action="upload.php" method="post" enctype="multipart/form-data">';
echo 'Select article to upload:';
echo '<input type="file" name="fileToUpload" id="fileToUpload">';
echo '<input type="submit" value="Upload File" name="submit">';
echo '</form>';
echo '</body>';
echo '</html>';

echo $_SESSION['username'];
?>