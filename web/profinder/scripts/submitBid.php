<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 10/29/16
 * Time: 7:08 PM
 */

session_start();

$servername = "us-cdbr-iron-east-04.cleardb.net";
$username = "b1633b6a10ff99";
$password = "8ad6b63d";
$dbName = "heroku_5866a6643d6eccb";

$results = [];
$results["success"] = false;
if ($_POST && $_POST["job_id"] && $_POST["bid_amount"]) {
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbName);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (!mysqli_select_db($conn, $dbName)) {
        die("Uh oh, couldn't select database $dbName");
    }

    $user_id = $_SESSION["user"]["id"];
    $job_id = $_POST["job_id"];
    $bid_amount = $_POST["bid_amount"];
    $sql = "insert into bid (job_id, placed_by, cost) values ($job_id, $user_id, $bid_amount)";
    mysqli_query($conn, $sql);

    $results["success"] = true;
    echo json_encode($results);
} else {
    echo json_encode($results);
}