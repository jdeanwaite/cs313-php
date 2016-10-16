<?php require_once('../views/header.php') ?>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <h2>Pro Finder</h2>
            <ul>
                <li><a href="jobs.php">View all jobs</a></li>
                <li><a href="">View incoming bids</a></li>
            </ul>
        </div>
        <div class="col-md-9">
            <h2>Your Job Requests</h2>

            <?php
            $data_to_fetch = "jobs";

            $data = null;
            require_once('scripts/dbAccessor.php');

            if ($data != null && $data->num_rows > 0) {
                echo "<ol>";
                // output data of each row
                while($row = $data->fetch_assoc()) {
                    echo "<li>" . $row["title"] . "</li>";
                }
                echo "</ol>";
            } else {
                echo "You have no current job requests.";
            }
            ?>

        </div>
    </div>
</div>

<?php require_once('../views/footer.php') ?>
