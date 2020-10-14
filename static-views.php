<?php
// Make connection to database.
// require_once 'DataBaseConnection.php';

// $dbcon = $con;


// Get the static page count
function getViewCount($page, $con) {
    if (!($statement = $con->prepare("SELECT views FROM blog.static_views WHERE description = ?"))) {
        echo "Prepare failed: (" . $con->errno . ") " . $con->error;   
    }
    if (!$statement->bind_param("s", $page)) {
        echo "Binding parameters failed: (" . $statement->errno . ") " . $statement->error;
    }
    if (!$statement->execute()) {
        echo "Execute failed: (" . $statement->errno . ") " . $statement->error;
    }
    $result = $statement->get_result();
    $row = $result->fetch_assoc();
    $views = $row['views'];
    return $views;
}

// Update the static page count
function setViewCount($page, $con) {

    $views = getViewCount($page, $con);
    $views++;

    // Update view counters
    $viewsUpdateStatement = $con->prepare("UPDATE blog.static_views SET views = ? WHERE description LIKE ?");
    $viewsUpdateStatement->bind_param("is", $views, $page);
    $viewsUpdateResults = $viewsUpdateStatement->execute();

}
?>