<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 10/15/16
 * Time: 10:13 PM
 */

$servername = "us-cdbr-iron-east-04.cleardb.net";
$username = "b1633b6a10ff99";
$password = "8ad6b63d";
$dbName = "heroku_5866a6643d6eccb";
//$servername = "localhost";
//$username = "root";
//$password = "root";
//$dbName = "pro_finder";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbName);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!mysqli_select_db($conn, $dbName)) {
    die("Uh oh, couldn't select database $dbName");
}

if ($_POST && $_POST["data_type"] == "categories") {
    echo json_encode(getCategories($conn));
}

function getCategories($conn) {
    $sql = "select * from category";
    $categories = mysqli_query($conn, $sql);
    $results = [];
    if ($categories != null && $categories->num_rows > 0) {
        while ($row = $categories->fetch_assoc()) {
            $results[] = $row;
        }
    }
    return $results;
}