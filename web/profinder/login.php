<?php
    session_start();
?>
<?php require_once('../views/header.php') ?>

<?php
require_once('scripts/dbAccessor.php');
?>

<div class="container">

    <form class="form-signin" action="scripts/authenticate.php" method="post">
        <h3 class="form-signin-heading">Sign in to Pro Finder</h3>
        <div class="form-group">
        <label for="username" class="sr-only">Email address</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required="" autofocus="">
        </div>
        <div class="form-group">
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
        </div>
        <button class="btn btn-md btn-primary btn-block" type="submit">Sign in</button>
        <a href="register.php">Register</a>
    </form>

</div>

<?php require_once('../views/footer.php') ?>
