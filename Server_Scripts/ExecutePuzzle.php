<?php
/**
 * Created by PhpStorm.
 * User: Courtland
 * Date: 11/24/2018
 * Time: 3:54 PM
 */
// Execute console
function isEnabled($func) {
    return is_callable($func) && false === stripos(ini_get('disable_functions'), $func);
}

// Checking to see if number of queens and the algorithm are set
if(isset($_POST["numQueens"]) && isset($_POST["popSize"]) && isset($_POST["algorithm"]) && isset($_POST["iteration"]) && isset($_POST["chaos"]) && isset($_POST["k"]) && isset($_POST["mutate"]))
{
    // Getting variables passed from form
    $queens = $_POST["numQueens"];
    $algorithm = $_POST["algorithm"];
    $popSize = $_POST["popSize"];
    $iteration = $_POST["iteration"];
    $chaos = $_POST["chaos"];
    $k = $_POST["k"];
    $mutate = $_POST["mutate"];

    if (isEnabled('shell_exec')) {
        // Executing command line script and passing arguements
        $temp = shell_exec('php C:/xampp/htdocs/ai-puzzles/Command_Prompt_Scripts/genetic_algorithm_queens.php ' . $queens . ' ' . $popSize . ' ' . $algorithm . ' ' . $iteration . ' ' . $chaos . ' ' . $k . ' ' . $mutate);
        echo $temp;
    }

    else
    {
        echo "Sorry, shell_exec() is not enabled on this server.";
    }
}

else
{
    echo "Parameters were not sent to ExecutePuzzle.php";
}
?>