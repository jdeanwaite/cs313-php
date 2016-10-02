<?php if (!isset($_SESSION)) {
    session_start();
} ?>

<?php require_once('../../views/header.php') ?>

<script type="text/javascript">
    <?php
    if (isset($_SESSION)) {
        if ($_SESSION["posted"] === true) {
            echo "window.location.href = \"results.php\";";
        }
    }
    ?>
</script>

<div class="container">
    <h1>PHP Survey (<a href="results.php">see results</a>)</h1>
    <form id="survey-form" action="results.php" method="post">
        <h4>Who is the best college football team of all time?</h4>

        <div class="radio">
            <label>
                <input type="radio" name="surveySelection" value="alabama">
                Alabama
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="surveySelection" value="lsu">
                LSU
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="surveySelection" value="clemson">
                Clemson
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="surveySelection" value="byu">
                BYU
            </label>
        </div>

        <h4>Is Nick Saban a scary individual?

            <div class="radio">
                <label>
                    <input type="radio" name="sabanSelection" value="yes">
                    Yes
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="sabanSelection" value="no">
                    No
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="sabanSelection" value="scared">
                    Too scared to answer
                </label>
            </div>

            <h4>Will Alabama win the National Championship this year?

                <div class="radio">
                    <label>
                        <input type="radio" name="champSelection" value="yes">
                        Yes
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="champSelection" value="no">
                        No
                    </label>
                </div>


                <h4>Who do you like better as a running back for Alabama?</h4>

                <div class="radio">
                    <label>
                        <input type="radio" name="rbSelection" value="bo">
                        Bo Scarbrough
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="rbSelection" value="jacobs">
                        Joshua Jacobs
                    </label>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit Answer</button>
                </div>
    </form>
</div>

<?php require_once('../../views/header.php') ?>
