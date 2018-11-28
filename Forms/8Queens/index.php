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
            <input type="text" class="form-control" id="numQueens" aria-describedby="Number of Queens" placeholder="Enter Number of Queens" name="numQueens">
        </div>
        <div class="form-group">
            <label for="popSize">Population Size</label>
            <input type="text" class="form-control" id="popSize" aria-describedby="Size of the population" placeholder="Enter Population Size" name="popSize">
        </div>
        <div class="form-group">
            <label for="algorithm">Select algorithm to solve puzzle</label>
            <select class="form-control" id="algorithm" name="algorithm">
                <option value="0">Adam and Eve Selection</option>
                <option value="1">K-Tournament Selection</option>
            </select>
        </div>

        <button type="button" class="btn btn-primary" onclick="execute()">Submit</button>
    </form>

    <div id="load" class="text-center" style="display: none;">
        <figure class="">
            <img src="loading2.gif" class="rounded mx-auto d-block">
            <figcaption><h2>Loading...</h2></figcaption>
        </figure>
    </div>
    <div id="response">

    </div>
</div>

<script>
    $(document).ready(function() {

    });

    function execute()
    {
        // Get textboxes values store it in a variable
        var numberQueens = document.getElementById("numQueens").value;
        var popSize = document.getElementById("popSize").value;
        var algorithm = document.getElementById("algorithm").value;
        document.getElementById("load").style.display = "block";

        //ajax call
        $.ajax({
            url: "../../Server_Scripts/ExecutePuzzle.php",
            method: "post",
            data: {numQueens: numberQueens, popSize: popSize, algorithm: algorithm},
            success: function(data){
                document.getElementById("load").style.display = "none";
                document.getElementById("response").innerHTML = data;
            }
        });
    }
</script>
</body>
</html>
