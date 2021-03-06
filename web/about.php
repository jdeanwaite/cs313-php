<?php require_once('views/header.php') ?>

    <div class="container">
        <div class="row">
            <div class="col-xs-6">
                <h1>All about Justin (almost)</h1>
                <hr>
                <p>
                    My name is Justin Waite and I grew up in the great state of everywhere. I was born in Florida and I
                    have
                    lived in Florida, Alabama, Utah, California, Virginia, Texas, Washington, Arizona, and now Idaho.
                    Moving around so much as a young kid was hard in some ways but great in others. As usual, things
                    always turn out. Here is a map of everyone I have lived or been. Green means I've lived there, blue
                    means I have visited there, and orange means I haven't been there yet.
                </p>
                <p>
                    I met my wife, McKenna, in Washington. We have been married for a little over a year
                    now and we do not have any kids. We are both in school right now. She graduates after the winter
                    semester,
                    and I am aiming to graduate after spring.
                </p>
            </div>

            <div class="col-xs-6">
                <div id="placed-ive-been" style="position: relative; width: 500px; height: 300px;"></div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xs-6">
                <img src="/images/family1.jpg" class="contained">
            </div>
            <div class="col-xs-6">
                <img src="/images/meandwife.jpg" class="contained">
            </div>
        </div>
    </div>

    <script src="//cdnjs.cloudflare.com/ajax/libs/d3/3.5.3/d3.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/topojson/1.6.9/topojson.min.js"></script>
    <script type="text/javascript" src="js/datamaps.usa.min.js"></script>

    <script type="text/javascript">
        var usaMap = new Datamap({
            scope: 'usa',
            element: document.getElementById('placed-ive-been'),
            geographyConfig: {
                highlightBorderColor: '#bada55',
                highlightBorderWidth: 3
            },

            fills: {
                'Lived': '#a5e1d4',
                'Visited': '#9dc3d9',
                'Not Visited': '#dedede',
                defaultFill: '#EDDC4E'
            },
            data: {
                "AZ": {
                    "fillKey": "Lived",
                },
                "CO": {
                    "fillKey": "Visited",
                },
                "DE": {
                    "fillKey": "Not Visited",
                },
                "FL": {
                    "fillKey": "Lived",

                },
                "GA": {
                    "fillKey": "Visited",

                },
                "HI": {
                    "fillKey": "Visited",

                },
                "ID": {
                    "fillKey": "Lived",

                },
                "IL": {
                    "fillKey": "Not Visited",

                },
                "IN": {
                    "fillKey": "Not Visited",

                },
                "IA": {
                    "fillKey": "Not Visited",

                },
                "KS": {
                    "fillKey": "Visited",

                },
                "KY": {
                    "fillKey": "Visited",

                },
                "LA": {
                    "fillKey": "Visited",

                },
                "MD": {
                    "fillKey": "Visited",

                },
                "ME": {
                    "fillKey": "Not Visited",

                },
                "MA": {
                    "fillKey": "Visited",

                },
                "MN": {
                    "fillKey": "Not Visited",

                },
                "MI": {
                    "fillKey": "Visited",

                },
                "MS": {
                    "fillKey": "Visited",

                },
                "MO": {
                    "fillKey": "Visited",

                },
                "MT": {
                    "fillKey": "Visited",

                },
                "NC": {
                    "fillKey": "Visited",

                },
                "NE": {
                    "fillKey": "Not Visited",

                },
                "NV": {
                    "fillKey": "Visited",

                },
                "NH": {
                    "fillKey": "Not Visited",

                },
                "NJ": {
                    "fillKey": "Not Visited",

                },
                "NY": {
                    "fillKey": "Visited",

                },
                "ND": {
                    "fillKey": "Not Visited",

                },
                "NM": {
                    "fillKey": "Visited",

                },
                "OH": {
                    "fillKey": "Visited",

                },
                "OK": {
                    "fillKey": "Visited",

                },
                "OR": {
                    "fillKey": "Visited",

                },
                "PA": {
                    "fillKey": "Visited",

                },
                "RI": {
                    "fillKey": "Not Visited",

                },
                "SC": {
                    "fillKey": "Visited",

                },
                "SD": {
                    "fillKey": "Not Visited",

                },
                "TN": {
                    "fillKey": "Visited",

                },
                "TX": {
                    "fillKey": "Lived",

                },
                "UT": {
                    "fillKey": "Lived",

                },
                "WI": {
                    "fillKey": "Not Visited",

                },
                "VA": {
                    "fillKey": "Lived",

                },
                "VT": {
                    "fillKey": "Not Visited",

                },
                "WA": {
                    "fillKey": "Lived",

                },
                "WV": {
                    "fillKey": "Visited",

                },
                "WY": {
                    "fillKey": "Visited",

                },
                "CA": {
                    "fillKey": "Lived",

                },
                "CT": {
                    "fillKey": "Not Visited",

                },
                "AK": {
                    "fillKey": "Not Visited",

                },
                "AR": {
                    "fillKey": "Visited",

                },
                "AL": {
                    "fillKey": "Lived",

                }
            }
        });
        usaMap.labels();
    </script>

<?php require_once('views/footer.php') ?>
