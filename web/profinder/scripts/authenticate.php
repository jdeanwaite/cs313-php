<?php
session_start();
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 10/22/16
 * Time: 11:50 AM
 */

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

$sql = "select id, first_name, last_name, email, password, type from user where email = '" . $_POST["email"] . "'";
$user = mysqli_query($conn, $sql);
$password = $_POST["password"];

if ($user != null && $user->num_rows >= 1) {
    while ($row = $user->fetch_assoc()) {
        if (password_verify($password, $row["password"])) {
            $authenticated = true;
            $row["password"] = null;
            $_SESSION["user"] = $row;
            $_SESSION["authenticated"] = true;
            break;
        }
    }
}

if ($authenticated) {
    header('Location: ../index.php');
} else {
    header('Location: ../login.php');
}