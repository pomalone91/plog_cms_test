<?php
require_once '../DataBaseConnection.php';
// print_r($_POST);

// Loop through IDs in POST to build "IN" string
$inString = '(';
$i = 0;

foreach( $_POST as $stuff => $val ) {
     if( is_array( $stuff ) ) {
         foreach( $stuff as $thing) {
         }
     } else {
        if ($i < count($_POST) - 1) {
            $inString .= $val . ', ';
        } else {
            $inString .= $val;
        }
     }
     $i++;
 }
 
$inString .= ')';
if ($inString == '()') {
    header("Location:loginSuccess.php");
} else {
    // SQL Query 
    $sql = 'UPDATE blog.articles SET deleteDate = CURRENT_DATE() WHERE id IN ' . $inString;
    $statement = $con->prepare($sql);
    $result = $statement->execute();
}

header("Location:loginSuccess.php");
                
// $statement = "UPDATE blog.articles WHERE deleteDate IS NULL AND id IN " . $inString . " ORDER BY id";
// echo $statement;
// $results = $con->query($statement);     // Get array of results of query
?>