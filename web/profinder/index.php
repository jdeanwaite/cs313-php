<?php
session_start();
if (!$_SESSION || !$_SESSION["authenticated"]) {
    header('Location: login.php');
}
require_once('../views/header.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="col-xs-12 profile">
                    <h4>Welcome, <?php echo $_SESSION["user"]["first_name"] ?>!</h4>
                    <span class="text-muted">Not <?php echo $_SESSION["user"]["first_name"] ?>? <a
                            href="scripts/logout.php">Logout</a></span><br>
                    <img src="http://aminoapps.com/static/img/user-icon-placeholder.png" class="profile">
                    <br>
                    <span>Account Type: <strong><?php echo ucwords($_SESSION["user"]["type"]) ?></strong></span>
                </div>
            </div>
            <br>
            <ul class="nav nav-pills nav-stacked">
                <li role="presentation" class="active"><a href="index.php">Dashboard</a></li>
                <?php
                if ($_SESSION["user"]["type"] == "pro")
                {
                    echo '<li role="presentation"><a href="javascript:showSearchModal();">Search Jobs</a></li>';
                }
                else
                {
                    echo '<li role="presentation"><a href="javascript:showJobModal();">Request Job</a></li>';
                }
                ?>
            </ul>
        </div>
        <div class="col-md-9">
            <div class="row">
                <?php
                if ($_SESSION["user"]["type"] == "pro") {
                    require_once('proDashboard.php');
                } else {
                    require_once('userDashboard.php');
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php require_once('../views/footer.php') ?>
