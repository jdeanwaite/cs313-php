<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 10/22/16
 * Time: 9:27 PM
 */
session_start();

$servername = "us-cdbr-iron-east-04.cleardb.net";
$username = "b1633b6a10ff99";
$password = "8ad6b63d";
$dbName = "heroku_5866a6643d6eccb";

$results = [];
$results["success"] = false;
if ($_POST && $_POST["job_title"] && $_POST["job_category"] && $_POST["job_description"]) {
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbName);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (!mysqli_select_db($conn, $dbName)) {
        die("Uh oh, couldn't select database $dbName");
    }

    $category_id = $_POST["job_category"];
    $job_title = $_POST["job_title"];
    $job_description = $_POST["job_description"];
    $user_id = $_SESSION["user"]["id"];
    $sql = "insert into job (category_id, created_by, title, description) values ($category_id, $user_id, '$job_title', '$job_description')";
    mysqli_query($conn, $sql);

    $results["success"] = true;
    echo json_encode($results);
} else {
    echo json_encode($results);
}