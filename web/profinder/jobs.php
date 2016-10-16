<?php require_once('../views/header.php') ?>

<?php
require_once('scripts/dbAccessor.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <h2>Pro Finder</h2>
            <ul>
                <li><a href="index.php">View my dashboard</a></li>
            </ul>
        </div>
        <div class="col-md-9">
            <h2>All Jobs</h2>

            <?php
            if ($jobs != null && $jobs->num_rows > 0) {
                echo "<table class='table table-striped'>
                    <thead>
                    <tr>
                        <th>User</th>
                        <th>Cateogry</th>
                        <th>Title</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>";
                // output data of each row
                while ($row = $jobs->fetch_assoc()) {
                    echo "<tr>" .
                        "<td>" . $row["first_name"] . "</td>" .
                        "<td>" . $row["category_name"] . "</td>" .
                        "<td>" . $row["title"] . "</td>" .
                        "<td>" . $row["description"] . "</td>" .
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

<?php require_once('../views/footer.php') ?>
