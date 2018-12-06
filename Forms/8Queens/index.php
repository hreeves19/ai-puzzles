<?php
/**
 * Created by PhpStorm.
 * User: Courtland
 * Date: 11/24/2018
 * Time: 3:47 PM
 */?>
<!DOCTYPE html>
<html>
<head>
    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js" integrity="sha384-pjaaA8dDz/5BgdFUPX6M/9SUZv4d12SUPF0axWc+VRZkx5xU3daN+lYb49+Ax+Tl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        #chessboard {
            padding: 0px;
            margin: 0 auto;
            border: 2px solid #181818;
        }

        #chessboard tr td {
            width: 60px;
            height: 60px;
        }

        #chessboard tr:nth-child(2n) td:nth-child(2n+1) {
            background: #9f9f9f;
        }

        #chessboard tr:nth-child(2n+1) td:nth-child(2n) {
            background: #9f9f9f;
        }
    </style>
</head>
<title>N Puzzle Queen</title>
<body>

<div class="container">
    <h1>N-Queen Puzzle Problem</h1>
    <hr>

    <form id="puzzle">
        <div class="form-group">
            <label for="numQueens">Number of Queens</label>
            <input type="text" class="form-control" id="numQueens" aria-describedby="Number of Queens" placeholder="Enter Number of Queens" name="numQueens" required>
        </div>
        <div class="form-group">
            <label for="popSize">Population Size</label>
            <input type="text" class="form-control" id="popSize" aria-describedby="Size of the population" placeholder="Enter Population Size" name="popSize" required>
        </div>
        <div class="form-group">
            <label for="iteration">Number of Iterations</label>
            <input type="text" class="form-control" id="iteration" aria-describedby="Number of Iteration" placeholder="Enter Number of Iterations" name="iteration" required>

        </div>
        <div class="form-group">
            <label for="algorithm">Select algorithm to solve puzzle</label>
            <select class="form-control" id="algorithm" name="algorithm" required>
                <option value="0">Adam and Eve Selection</option>
                <option value="1">K-Tournament Selection</option>
            </select>
        </div>
        <hr>
        <h5>Our added features to genetic algorithm</h5>
        <div>

        </div>

        <button type="button" class="btn btn-primary" onclick="execute()">Submit</button>
    </form>

    <div id="load" class="text-center" style="display: none;">
        <figure class="">
            <img src="loading2.gif" class="rounded mx-auto d-block">
            <figcaption><h2>Loading...</h2></figcaption>
        </figure>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <canvas id="mutations"></canvas>
        </div>
        <div class="col" style="width: 100%; height: 100%;">
            <canvas id="canvas"></canvas>
        </div>
    </div>
<!--    <h1>Log</h1>
    <div class="container border rounded" style="width: 100%; height: 450px; max-height: 450px; overflow-y: scroll;">
        <p  id="console"></p>
    </div>
    <br>
    <div class="row">
        <div class="col-3">
            <input type="button" class="btn btn-secondary" value="Stop Following Log" onclick="followLog()" id="scroll">
        </div>
        <div class="col-3">
            <input type="button" class="btn btn-danger" value="Stop Log" onclick="stopLog()" id="stop">
        </div>
        <div class="col-3">
            <input type="button" class="btn btn-primary" value="Start Log" onclick="updateLog()" style="display: none;" id="start">
        </div>
    </div>
    <br>-->
    <div id="response">

    </div>
    <br>
</div>

<script>
    var timer;
    var follow = true;
    var counter = 0;
    var log = "";

    $(document).ready(function() {
        /*updateLog();*/
    });

    function followLog()
    {
        // increment counter
        counter++;

        // Not follow
        if(counter % 2)
        {
            follow = false;
            document.getElementById("scroll").value = "Follow Log";
        }

        else
        {
            follow = true;
            document.getElementById("scroll").value = "Stop Following Log";
        }
    }

    function updateLog()
    {
        //timer = setInterval(function()
        //{
            /*document.getElementById("stop").style.display = "block";
            document.getElementById("start").style.display = "none";*/

        //}, 5000) // INTERVAL
        $.ajax({
            url: "../../Server_Scripts/GetLog.php", method: "post",
            success: function(data)
            {
                var jsonfile = JSON.parse(data);
                var keys = Object.keys(jsonfile);

                // Line Chart Example
                var ctx = document.getElementById("mutations");
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    options: {
                        animation: false,
                        scales: {
                            yAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: "Number of Solutions"
                                }
                            }],
                            xAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: "Number of iterations"
                                }
                            }]
                        }
                    },
                    data: {
                        labels: Object.keys(jsonfile),
                        datasets: [{
                            label: "Solutions Found",
                            data: Object.values(jsonfile),
                            // #8DC641 #21357
                            borderColor: '#4286f4',
                            backgroundColor: '#4286f4',
                            fill: false,
                        }],
                    },
                }); // CANVAS
            } // SUCCESS
        }); // AJAX CALL

        $.ajax({
            url: "../../Server_Scripts/GetLog.php", method: "post",
            success: function(data)
            {
                var jsonfile = JSON.parse(data);
                var keys = Object.keys(jsonfile);

                // Line Chart Example
                var ctx = document.getElementById("canvas");
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    options: {
                        animation: false,
                        scales: {
                            yAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: "Number of Solutions"
                                }
                            }],
                            xAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: "Number of iterations"
                                }
                            }]
                        }
                    },
                    data: {
                        labels: Object.keys(jsonfile),
                        datasets: [{
                            label: "Solutions Found",
                            data: Object.values(jsonfile),
                            // #8DC641 #21357
                            borderColor: '#4286f4',
                            backgroundColor: '#4286f4',
                            fill: false,
                        }],
                    },
                }); // CANVAS
            } // SUCCESS
        }); // AJAX CALL
    }



    function stopLog()
    {
        clearInterval(timer);
        document.getElementById("start").style.display = "block";
        document.getElementById("stop").style.display = "none";
    }

    function updateScroll()
    {
        var element = document.getElementById("console");
        element.scrollTop = element.scrollHeight;
    }


    function execute()
    {
        // Get textboxes values store it in a variable
        var numberQueens = document.getElementById("numQueens").value;
        var popSize = document.getElementById("popSize").value;
        var algorithm = document.getElementById("algorithm").value;
        var iteration = document.getElementById("iteration").value;
        document.getElementById("load").style.display = "block";

        //ajax call
        $.ajax({
            url: "../../Server_Scripts/ExecutePuzzle.php",
            method: "post",
            data: {numQueens: numberQueens, popSize: popSize, algorithm: algorithm, iteration: iteration},
            success: function(data){
                document.getElementById("load").style.display = "none";
                document.getElementById("response").innerHTML = data;
                updateLog();
            }
        });
    }
</script>
</body>
</html>
