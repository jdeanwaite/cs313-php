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
if ($_POST && $_POST["id"]) {
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbName);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (!mysqli_select_db($conn, $dbName)) {
        die("Uh oh, couldn't select database $dbName");
    }

    $id = $_POST["id"];
    $sql = "update bid set accepted = 1 where id = $id";
    mysqli_query($conn, $sql);

    $results["success"] = true;
    echo json_encode($results);
} else {
    echo json_encode($results);
}