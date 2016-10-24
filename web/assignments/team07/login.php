<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 10/24/16
 * Time: 8:06 AM
 */

session_start();

if ($_POST && $_POST["email"] && $_POST["password"]) {
    $servername = "us-cdbr-iron-east-04.cleardb.net";
    $email = "b1633b6a10ff99";
    $password = "8ad6b63d";
    $dbName = "heroku_5866a6643d6eccb";

// Create connection
    $conn = mysqli_connect($servername, $email, $password, $dbName);

// Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (!mysqli_select_db($conn, $dbName)) {
        die("Uh oh, couldn't select database $dbName");
    }

    $email = $_POST["email"];
    $password = $_POST["password"];
    $sql = "select * from user where email = '$email'";
    $user = mysqli_query($conn, $sql);

    $authenticated = false;
    if ($user != null && $user->num_rows > 0) {
        $_SESSION["authenticated"] = true;
        while ($row = $user->fetch_assoc()) {
            if (password_verify($password, $row["password"])) {
                $authenticated = true;
                $_SESSION["userId"] = $row["id"];
                $_SESSION["userEmail"] = $row["email"];
                $_SESSION["authenticated"] = true;
                break;
            }
        }
    }

    if ($authenticated) {
        header('Location: welcome.php');
    } else {
        header('Location: login.php');
    }
}
?>

<?php require_once('../../views/header.php') ?>

<div class="container">

    <form class="form-signin" id="form-signin" action="login.php" method="post">
        <h3 class="form-signin-heading">Login</h3>
        <div class="form-group">
            <label for="email" class="sr-only">Email address</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email" required="" autofocus="">
        </div>
        <div class="form-group">
            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
        </div>
        <button class="btn btn-md btn-primary btn-block" type="submit">Sign-in</button>
        <a href="register.php">Register</a>
    </form>

</div>

<?php require_once('../../views/footer.php') ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#form-signin').validate();
    })
</script>

