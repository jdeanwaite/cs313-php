<?php require_once('results-process.php') ?>
<?php require_once('../../views/header.php') ?>

    <div class="container">
        <h1>PHP Survey Results</h1>
        <h4>Who is the best college football team of all time?</h4>
        <ul>
            <li>Alabama: <?php echo $current_results["surveySelection"]["alabama"] ?></li>
            <li>LSU: <?php echo $current_results["surveySelection"]["lsu"] ?></li>
            <li>Clemson: <?php echo $current_results["surveySelection"]["clemson"] ?></li>
            <li>BYU: <?php echo $current_results["surveySelection"]["byu"] ?></li>
        </ul>

        <h4>Is Nick Saban a scary individual?</h4>
        <ul>
            <li>Yes: <?php echo $current_results["sabanSelection"]["yes"] ?></li>
            <li>No: <?php echo $current_results["sabanSelection"]["no"] ?></li>
            <li>Too scared to answer: <?php echo $current_results["sabanSelection"]["scared"] ?></li>
        </ul>

        <h4>Will Alabama win the National Championship this year?</h4>
        <ul>
            <li>Yes: <?php echo $current_results["champSelection"]["yes"] ?></li>
            <li>No: <?php echo $current_results["champSelection"]["no"] ?></li>
        </ul>

        <h4>Who do you like better as a running back for Alabama?</h4>
        <ul>
            <li>Bo Scarbrough: <?php echo $current_results["rbSelection"]["bo"] ?></li>
            <li>Joshua Jacobs: <?php echo $current_results["rbSelection"]["jacobs"] ?></li>
        </ul>
    </div>

<?php require_once('../../views/footer.php') ?>
