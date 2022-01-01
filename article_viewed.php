<?php
/* 
EVERY TIME AN ARTICLE IS CLICKED, THIS SCRIPT WILL RUN TO ADD A NEW RECORD TO VIEWS TABLE

Create a new function.
    - Get current date.
    - Chop it into bits...
        ,viewedAt           DATETIME
        ,view_year          INT
        ,view_month         INT
        ,view_day           INT
        ,view_quarter       VARCHAR(2)
        ,view_time          TIME
    - Insert bits into blog.views
 
*/

function articleViewed($articleId, $con) {

    // Change the line below to your timezone!
    date_default_timezone_set('America/Denver');
    
    // Date
    $viewDate = date('Y-m-d H:i:s', time());
    
    // date components
    $viewYear = date('Y');
    $viewMonth = date('m');
    $viewDay = date('d');
    $viewQ = ceil((int)$viewMonth/3);
    $viewTime = date("H:i:s");
    

//     echo 'Date ' . $viewDate;
//     echo '<p>';
//     echo 'Year ' . $viewYear;
//     echo '<p>';
//     echo 'Month ' . $viewMonth;
//     echo '<p>';
//     echo 'Day ' . $viewDay;
//     echo '<p>';
//     echo 'Quarter ' . $viewQ;
//     echo '<p>';
//     echo 'Time ' . $viewTime;
    
    /*
    Query
    -- Insert into views table
    INSERT INTO blog.views (articleId, viewedAt, view_year, view_month, view_day, view_quarter, view_time)
    VALUES 
        (NULL, '2022-01-01 10:56:36', 2022, 01, 01, 1, '10:56:36')
        ,(1, '2022-01-01 10:56:36', 2022, 01, 01, 1, '10:56:36');
    */
    

    $statement = $con->prepare("INSERT INTO blog.views (articleId, viewedAt, view_year, view_month, view_day, view_quarter, view_time) VALUE (?, ?, ?, ?, ?, ?, ?)");
    $statement->bind_param("isiiiis", $articleId, $viewDate, $viewYear, $viewMonth, $viewDay, $viewQ, $viewTime);
    $result = $statement->execute();
    
//     Uncomment below to show error message in testing

//     if (!$results) {
//         $message = "Whole query " . $search;
//         echo $message;
//         die('Invalid query: ' . mysqli_error($con));
//     }

    

    
                        

}
?>