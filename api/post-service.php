<?php
// Connect to database
require_once '../DataBaseConnection.php';

// Get JSON data
$data = json_decode(file_get_contents("php://input"));

//     echo "\npassphrase " . $data->passphrase;
//     echo "\nkey " . $key;
//     echo "\npubdate " . !empty($data->pubDate);
//     echo "\ntitle " . !empty($data->title);
//     echo "\nsummary " . !empty($data->summary);
//     echo "\nfilename " . !empty($data->filename);
//     echo "\npassphrase " . strcmp($data->passphrase, $key);

echo "\nrequest type " . $data->requestType;

handleUploadFile();

switch($data->requestType) {
    case "post":
        handlePostData($data->pubDate, $data->title, $data->summary, $data->filename, $data->passphrase, $passphrase, $con, $data->queryType, $data->id);
        break;
    case "upload":
        handleUploadFile();
        break;
    default:
        echo "bad request type";
        break;
}


// Handles data sent through post used to update database
function handlePostData($pubDate, $title, $summary, $filename, $sentPassphrase, $key, $con, $queryType, $id) {
    echo "handling post request"; 
    
    // Check that data isn't empty and check for correct API key
    if(
        !empty($pubDate) &&
        !empty($title) &&
        !empty($summary) &&
        !empty($filename) &&
        strcmp($sentPassphrase, $key)
    ){
        echo "good data";

        // Set response code
        http_response_code(201);

        /* UPDATE 0.1.0: Add a switch statement here to switch on requestType. Write an insert for insert and update for update requests.
        */
        echo "query type: " . $queryType;
        switch($queryType) {
            case "insert":
                echo "INSERTING";
                $filenameString = $filename;
                $statement = $con->prepare("INSERT INTO blog.articles (pubDate, title, summary, filename) VALUE (CURRENT_DATE(), ?, ?, ?)");
                $statement->bind_param("sss", $title, $summary, $filenameString);
                $result = $statement->execute();
                break;
            case "update": 
                echo "UPDATING";
                $statement = $con->prepare("UPDATE blog.articles SET title = ?, summary = ? WHERE id = ?");
                $statement->bind_param("ssi", $title, $summary, $id);
                $result = $statement->execute();
                break;
            case "delete":
                // This will just update the deleteDate field, not actually delete a record.
                break;
            default:
                echo "bad query type";
                break;
        }
//         // Create query
//         $statement = $con->prepare("INSERT INTO blog.articles (pubDate, title, summary, filename) VALUE (CURRENT_DATE(), ?, ?, ?)");
//         $statement->bind_param("sss", $title, $summary, $filename);
        
        // Insert record
//         $result = $statement->execute();
//         if (!$result) {
//             echo "No result";
//             die('Invalid query: ' . mysqli_error($con));    
//         } else {
//             echo "yes result";
//         }
//         echo $result;
    } else {
        echo "bad data";
    }
}

// Handles requests to upload files to the server
function handleUploadFile() {
    echo "handling upload request";
    print_r($_FILES);
//     $file = $_FILES["name"];
//     echo $file;
    
}





?>