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

$jobs = getJobRequests($conn);
$bids = getBidRequests($conn);


function getJobRequests($conn)
{
    $sql = "select * from job j join user u on u.id = j.created_by join category c on c.id = j.category_id";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function getBidRequests($conn)
{
    $sql = "select * from bid b join user u on u.id = b.placed_by join job j on j.id = b.job_id";
    $result = mysqli_query($conn, $sql);
    return $result;
}