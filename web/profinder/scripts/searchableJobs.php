<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 10/29/16
 * Time: 6:50 PM
 */

session_start();

$servername = "us-cdbr-iron-east-04.cleardb.net";
$username = "b1633b6a10ff99";
$password = "8ad6b63d";
$dbName = "heroku_5866a6643d6eccb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbName);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!mysqli_select_db($conn, $dbName)) {
    die("Uh oh, couldn't select database $dbName");
}

$userId = $_SESSION['user']['id'];
$sql = "select j.id as job_id, j.title as job_title, j.description, c.category_name from job j join category c on c.id = j.category_id where j.id not in (select b.job_id from bid b where accepted = 1 or placed_by = $userId)";
$jobs = mysqli_query($conn, $sql);

$results = [];
if ($jobs != null && $jobs->num_rows > 0) {
    while ($row = $jobs->fetch_assoc()) {
        $results[] = $row;
    }
}
else
{
}

echo json_encode($results);

//echo json_encode($bids);
