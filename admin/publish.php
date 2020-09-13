<?php
require_once '../DataBaseConnection.php';

session_start();

if ($_SESSION['user'] == 'admin') {

    print_r($_POST);

    $id = $_POST['id'];
    $option = $_POST['option'];

    if ($option == 'Publish') {
        $sql = 'UPDATE blog.articles SET deleteDate = NULL, lastPublished = CURRENT_DATE() WHERE id = ' . $id;
    } else {
        $sql = 'UPDATE blog.articles SET deleteDate = CURRENT_DATE() WHERE id = ' . $id;
    }

    $statement = $con->prepare($sql);
    $result = $statement->execute();

    header("Location:loginSuccess.php");
} else {
    header("Location:userlogin.php");
}

?>