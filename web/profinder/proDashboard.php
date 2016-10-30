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

<div class="modal fade" tabindex="-1" role="dialog" id="search-modal">
    <div class="modal-dialog" role="document">
        <form id="search-form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Search Jobs</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-striped" id="search-table">
                        <thead>
                        <tr>
                            <th>Category</th>
                            <th>Job Title</th>
                            <th>Job Description</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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

        initSearchTableSubmit();
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

    function showSearchModal() {
        $('#search-form')[0].reset();
        $('#search-modal').modal('show');
        getSearchResults();
    }

    function getSearchResults() {
        $('#search-table').find('tbody').html("Loading...");
        $.ajax({
            url: 'scripts/searchableJobs.php',
            type: 'get'
        })
            .done(function (res) {
                res = JSON.parse(res);
                var tbody = $('#search-table').find('tbody');
                tbody.html("");
                for (var i in res) {
                    tbody.append($(
                        '<tr>' +
                        '<td>' + res[i]["category_name"] + '</td>' +
                        '<td>' + res[i]["job_title"] + '</td>' +
                        '<td>' + res[i]["description"] + '</td>' +
                        '<td><input type=number class="form-control" name="bid_amount" id="bid-amount" placeholder="$5.00"></td>' +
                        '<td><button type="button" name="placeBid" data-id="' + res[i]["job_id"] + '" class="btn btn-success">Bid</button></td>' +
                        '</tr>'
                    ));
                }

                $('[name="placeBid"]').click(handlePlaceBidClick);
            })
    }

    var selectedId = null;
    var bidAmount = 0;
    function handlePlaceBidClick() {
        selectedId = $(this).data("id");
        var amountInput = $(this).closest("tr").find("input");
        bidAmount = amountInput.val() || 0;
        $('#search-form').submit();
    }

    function initSearchTableSubmit() {
        $('#search-form').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: 'scripts/submitBid.php',
                type: 'post',
                data: {
                    job_id: selectedId,
                    bid_amount: bidAmount
                }
            })
                .done(function (res) {
                    res = JSON.parse(res);
                    console.log("bid place results", res);
                    if (res["success"]) {
                        console.log("this");
                        $('#search-modal').modal('hide');
                        swal({
                            title: "Success",
                            type: "success",
                            text: "Your bid was placed!"
                        });
                    }
                });
            bidAmount = 0;
            selectedId = null;
        });
    }
</script>
