<?php
/**
 * Created by PhpStorm.
 * User: Courtland
 * Date: 11/24/2018
 * Time: 4:00 PM
 */
require("../Classes/State.php");
require("../Classes/GeneticAlogirthm.php");

// Getting command line arguements
if(isset($argv[0]) && isset($argv[1]) && isset($argv[2]) && isset($argv[3]))
{
    // Getting command line arguments
    $filepath = $argv[0];
    $queens = $argv[1];
    $popSize = $argv[2];
    $algorithm = $argv[3];
    $foundSol = false;
    $fitness = array();
    $counter = 0;

    $size = $queens * $queens;

    // Creating population array
    $population = array();

    echo "<hr><h1>Results</h1>";

    // Creating initial population
    for($i = 0; $i < $popSize; $i++)
    {
        // Creating the state (individual)
        array_push($population, new State());
        $population[$i]->setName($i);

        $population[$i]->setQueens($queens);

        // Setting initial state
        if(!$population[$i]->randomizeChromosome())
        {
            echo "State could not be initialized for individual " . $i . ".";
        }

        // Set the value
        // if N = 28 then value = 28
        $population[$i]->setValue($queens);
    }

    // Population is now initialized enter the while loop
    while(/*!$foundSol*/$counter != 100)
    {
        echo "<h1>Iteration $counter</h1><hr>";

        // Creating initial population
        for($i = 0; $i < $popSize; $i++)
        {
            $population[$i]->setName($i);

            // We set the one array
            $population[$i]->setOneArray();

            // Calculate initial fitness
            array_push($fitness, $population[$i]->calculateFitness());
        }

        // Population
        $genetic = new GeneticAlogirthm();
        $genetic->setPopulation($population);

        // Selecting
        if($genetic->calculateProbability($fitness) == false)
        {
            $foundSol = true;
            echo "Error: The population was not initialized. Counter at: $counter<br>";
        }

        else
        {
            // Selecting adam and eve
            $genetic->select();

            // Reproducing children
            $genetic->reproduce();

            // New population
            $genetic->newPopulation();
        }

        $counter++;
        $foundSol = true;
        unset($fitness);
        $fitness = array();
    }
}

else
{
    echo "Not all arguments were set, here is the list: ";
    var_dump($argv);
}
?>