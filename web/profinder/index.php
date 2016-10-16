<?php require_once('../views/header.php') ?>

<?php
require_once('scripts/dbAccessor.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <h2>Pro Finder</h2>
            <ul>
                <li><a href="jobs.php">View all jobs</a></li>
            </ul>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-xs-12">
                    <h2>Your Job Requests</h2>


                    <?php
                    if ($jobs != null && $jobs->num_rows > 0) {
                        echo "<ol>";
                        // output data of each row
                        while ($row = $jobs->fetch_assoc()) {
                            echo "<li>" . $row["title"] . "</li>";
                        }
                        echo "</ol>";
                    } else {
                        echo "You have no current job requests.";
                    }
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <h2>Your Incomming Bids</h2>

                    <?php
                    if ($bids != null && $bids->num_rows > 0) {
                        echo "<table class='table table-striped'>
                    <thead>
                    <tr>
                        <th>Job Title</th>
                        <th>Cost</th>
                        <th>Placed By</th>
                        <th>Message</th>
                    </tr>
                    </thead>
                    <tbody>";
                        // output data of each row
                        while ($row = $bids->fetch_assoc()) {
                            echo "<tr>" .
                                "<td>" . $row["title"] . "</td>" .
                                "<td>" . $row["cost"] . "</td>" .
                                "<td>" . $row["first_name"] . "</td>" .
                                "<td>" . $row["message"] . "</td>" .
                                "</tr>";
                        }
                        echo "
                    </tbody>
                    </table>";
                    } else {
                        echo "You have no current job requests.";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('../views/footer.php') ?>
