<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 10/24/16
 * Time: 8:06 AM
 */

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
    $password = $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $sql = "insert into user (email, password) values ('$email', '$password')";
    $user = mysqli_query($conn, $sql);

    header('Location: login.php');
}
?>

<?php require_once('../../views/header.php') ?>

<div class="container">

    <form class="form-signin" id="form-register" action="register.php" method="post">
        <h3 class="form-signin-heading">Register</h3>
        <div class="form-group">
            <label for="email" class="sr-only">Email address</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email" required=""
                   autofocus="">
        </div>
        <div class="form-group">
            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password"
                   required="">
        </div>
        <div class="form-group">
            <label for="password-confirm" class="sr-only">Confirm Password</label>
            <input type="password" id="password-confirm" name="passwordConfirm" class="form-control"
                   placeholder="Confirm Password" required="">
        </div>
        <button class="btn btn-md btn-primary btn-block" type="submit">Register</button>
    </form>

</div>

<?php require_once('../../views/footer.php') ?>

<script type="text/javascript">
    $(document).ready(function () {
        $.validator.addMethod("passwordMatch", function (value, element) {
            return value == $("#password").val();
        }, "The passwords must match.");

        $.validator.addMethod("passwordNumber", function (value, element) {
            return /(?=.*\d)/.test(value);
        }, "Must contain a number.");

        $('#form-register').validate();
        $("#password").rules("add", {
            minlength: 7,
            passwordNumber: true
        });
        $('#password-confirm').rules('add', {
            passwordMatch: true
        })
    })
</script>
