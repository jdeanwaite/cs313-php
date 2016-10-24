<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 10/24/16
 * Time: 8:06 AM
 */

session_start();
if (!$_SESSION || !$_SESSION["authenticated"]) {
    header('Location: login.php');
}
require_once('../../views/header.php');
?>

<div class="container">

    <h5>Welcome, <?php echo $_SESSION["userEmail"] ?>!</h5>

</div>

<?php require_once('../../views/footer.php') ?>
