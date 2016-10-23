<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 10/22/16
 * Time: 3:10 PM
 */
?>

<div class="col-xs-12">

    <!--    Pending Bids-->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Your Pending Job Requests</h3>
        </div>
        <div class="panel-body">
            <!-- Placeholder -->
            <div id="job-table-placeholder">
                Loading...
            </div>
            <!-- Table -->
            <table class="table" id="pending-job-table" style="display: none;">
                <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Bids</th>
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
            <div id="open-job-table-placeholder">
                Loading...
            </div>
            <!-- Table -->
            <table class="table" id="open-job-table" style="display: none;">
                <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Cost</th>
                    <th>Pro Name</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

    <!--    Job history table-->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Job History</h3>
        </div>
        <div class="panel-body">
            <!-- Placeholder -->
            <div id="job-history-table-placeholder">
                Loading...
            </div>
            <!-- Table -->
            <table class="table" id="job-history-table" style="display: none;">
                <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Cost</th>
                    <th>Pro Name</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="job-modal">
    <div class="modal-dialog" role="document">
        <form id="job-form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Request a Job</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="job-title">Job Title</label>
                        <input class="form-control" type="text" name="job_title" id="job-title"
                               placeholder="e.g. Piano Lessons" required>
                    </div>
                    <div class="form-group">
                        <label for="job-category-select">Category</label>
                        <select class="form-control" id="job-category-select" name="job_category">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="job-title">Job Description</label>
                        <textarea class="form-control" name="job_description" id="job-description"
                                  placeholder="e.g. Piano Lessons" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="bids-modal">
    <div class="modal-dialog" role="document">
        <form id="bids-form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Bids</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-striped" id="bids-table">
                        <thead>
                        <tr>
                            <th>Pro</th>
                            <th>Cost</th>
                            <th>Message</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    $(document).ready(function () {
        getPendingJobs();
        getOpenJobs();
        getJobHistory();
        loadCategories();
        initializeJobSubmit();
    });

    function getPendingJobs() {
        $.ajax({
            url: "scripts/pendingJobs.php",
            type: "get"
        })
            .done(function (res) {
                var jobs = JSON.parse(res);
                console.log("bids", jobs);
                var table = $('#pending-job-table');
                populateJobs(jobs, table);
                table.show();
                $('#job-table-placeholder').hide();
            });
    }

    function getOpenJobs() {
        $.ajax({
            url: "scripts/openJobs.php",
            type: "get"
        })
            .done(function (res) {
                var jobs = JSON.parse(res);
                console.log("open jobs", jobs);
                var table = $('#open-job-table');
                populateOpenJobs(jobs, table);
                table.show();
                $('#open-job-table-placeholder').hide();
            });
    }

    function getJobHistory() {
        $.ajax({
            url: "scripts/jobHistory.php",
            type: "get"
        })
            .done(function (res) {
                var jobs = JSON.parse(res);
                console.log("job history", jobs);
                var table = $('#job-history-table');
                populateJobHistory(jobs, table);
                table.show();
                $('#job-history-table-placeholder').hide();
            });
    }

    function populateJobs(jobs, table) {
        var body = $('tbody', table).html("");
        for (var i in jobs) {
            if (jobs[i]["bid_count"] > 0) {
                var row = $(
                    "<tr>" +
                    "<td>" + jobs[i]["title"] + "</td>" +
                    '<td><a href="javascript:bidModal(' + jobs[i]["id"] + ');">' + jobs[i]["bid_count"] + '</a></td>' +
                    "<td>" + jobs[i]["description"] + "</td>" +
                    "</tr>");
            }
            else {
                var row = $(
                    "<tr>" +
                    "<td>" + jobs[i]["title"] + "</td>" +
                    "<td>" + jobs[i]["bid_count"] + "</td>" +
                    "<td>" + jobs[i]["description"] + "</td>" +
                    "</tr>");
            }
            row.appendTo(body);
        }
    }

    function populateOpenJobs(jobs, table) {
        var tbody = $('tbody', table).html("");
        for (var i in jobs) {
            var row = $(
                "<tr>" +
                "<td>" + jobs[i]["title"] + "</td>" +
                "<td>" + jobs[i]["cost"] + "</td>" +
                "<td>" + jobs[i]["description"] + "</td>" +
                "</tr>");
            row.appendTo(tbody);
        }
    }

    function populateJobHistory(jobs, table) {
        var tbody = $('tbody', table).html("");
        for (var i in jobs) {
            var row = $(
                "<tr>" +
                "<td>" + jobs[i]["title"] + "</td>" +
                "<td>" + jobs[i]["cost"] + "</td>" +
                "<td>" + jobs[i]["description"] + "</td>" +
                "</tr>");
            row.appendTo(tbody);
        }
    }

    function showJobModal() {
        $('#job-modal').modal('show');
    }

    function initializeJobSubmit() {
        var form = $('#job-form');
        form.submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: 'scripts/submitJob.php',
                type: 'post',
                data: $(this).serialize()
            })
                .done(function (res) {
                    var results = JSON.parse(res);
                    if (results.success) {
                        $('#job-modal').modal('hide');
                        form[0].reset();
                        swal({
                            title: "Success",
                            type: "success",
                            text: "Your job was created."
                        });
                        getPendingJobs();
                    }
                })
        })
    }

    function loadCategories() {
        //job-category-select
        $.ajax({
            url: 'scripts/dbAccessor.php',
            type: "post",
            data: {
                data_type: "categories"
            }
        })
            .done(function (res) {
                var options = JSON.parse(res);
                for (var i in options) {
                    $('<option value="' + options[i]["id"] + '">' + options[i]["category_name"] + '</option>')
                        .appendTo($('#job-category-select'));
                }
            })
    }

    function bidModal(id) {
        $.ajax({
            url: 'scripts/bidsForJob.php',
            type: 'post',
            data: {
                id: id
            }
        })
            .done(function(res){
                var bids = JSON.parse(res);
                console.log("bids", bids);
                populateBids(bids);
                $('#bids-modal').modal('show');
            });
    }

    function populateBids(bids) {
        var tbody = $('tbody', "#bids-table").html("");
        for (var i in bids) {
            var row = $(
                "<tr>" +
                "<td>" + bids[i]["first_name"] + "</td>" +
                "<td>" + bids[i]["cost"] + "</td>" +
                "<td>" + bids[i]["message"] + "</td>" +
                '<td><button type="button" class="btn btn-success" onclick="acceptBid(' + bids[i]["id"] + ')">Accept Bid</button></td>' +
                "</tr>");
            row.appendTo(tbody);
        }
    }

    function acceptBid(id) {
        $.ajax({
            url: 'scripts/acceptBid.php',
            type: 'post',
            data: {
                id: id
            }
        })
            .done(function(res) {
                var results = JSON.parse(res);
                if (results.success) {
                    $('#bids-modal').modal('hide');
                    swal({
                        title: "Bid Accepted!",
                        text: "The bid was accepted and the Pro will be notified.",
                        type: 'success'
                    });
                    getPendingJobs();
                    getOpenJobs();
                }
            });
    }

</script>
