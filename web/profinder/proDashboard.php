<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 10/22/16
 * Time: 1:38 PM
 */
?>

<div class="col-xs-12">

<!--    Pending Bids-->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Your Pending Bids</h3>
        </div>
        <div class="panel-body">
            <!-- Placeholder -->
            <div id="bid-table-placeholder">
                Loading...
            </div>
            <!-- Table -->
            <table class="table" id="bid-table" style="display: none;">
                <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Cost</th>
                    <th>Job Description</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

<!--    Open bids-->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Your Open Jobs</h3>
        </div>
        <div class="panel-body">
            <!-- Placeholder -->
            <div id="open-bid-table-placeholder">
                Loading...
            </div>
            <!-- Table -->
            <table class="table" id="open-bid-table" style="display: none;">
                <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Cost</th>
                    <th>Job Description</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $.ajax({
            url: "scripts/pendingBids.php",
            type: "get"
        })
            .done(function (res) {
                var bids = JSON.parse(res);
                console.log("bids", bids);
                var table = $('#bid-table');
                populateBids(bids, table);
                table.show();
                $('#bid-table-placeholder').hide();
            });

        $.ajax({
            url: "scripts/openBids.php",
            type: "get"
        })
            .done(function (res) {
                var jobs = JSON.parse(res);
                console.log("open jobs", jobs);
                var table = $('#open-bid-table');
                populateOpenJobs(jobs, table);
                table.show();
                $('#open-bid-table-placeholder').hide();
            });
    });

    function populateBids(bids, table) {
        for (var i in bids) {
            var row = $(
                "<tr>" +
                "<td>" + bids[i]["title"] + "</td>" +
                "<td>" + "$" + parseFloat(bids[i]["cost"]).toFixed(2) + "</td>" +
                "<td>" + bids[i]["description"] + "</td>" +
                "</tr>");
            row.appendTo(table);
        }
    }

    function populateOpenJobs(job, table) {
        for (var i in job) {
            var row = $(
                "<tr>" +
                "<td>" + job[i]["title"] + "</td>" +
                "<td>" + "$" + parseFloat(job[i]["cost"]).toFixed(2) + "</td>" +
                "<td>" + job[i]["description"] + "</td>" +
                "<td><button class=\"btn btn-default complete-button\">Complete</button></td>" +
                "</tr>");
            row.appendTo(table);
        }
    }
</script>
