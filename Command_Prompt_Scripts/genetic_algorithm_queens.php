<?php
/**
 * Created by PhpStorm.
 * User: Courtland
 * Date: 11/24/2018
 * Time: 4:00 PM
 */
require("../Classes/State.php");
require("../Classes/GeneticAlogirthm.php");

$previousAdam = 0;
$previousEve = 0;
$adam = 0;
$eve = 0;
$countA = 0;
$countB = 0;
$thresh = 5;
$maxFitness = 0;
$bestResult = new State();

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
    while($counter != 1000)
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

            if($fitness[$i] == $population[$i]->getValue())
            {
                echo $population[$i]->getValue() . "<br>";
                echo "<h1>DONE</h1>";
                $population[$i]->showBoard();
                $foundSol = true;
            }
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
            $fittest = max($fitness);

            if($fittest > $maxFitness)
            {
                $maxFitness = $fittest;
                $bestResult = $population[array_search($maxFitness, $fitness)];

                echo "<h3>State " . $bestResult->getName() . "</h3><br>";
                echo "<h3>Best Fitness: " . $bestResult->getFitness() . " </h3><hr>";
                echo  $bestResult->showBoard() . "<br>";
            }
            // Selecting adam and eve
            $genetic->selectParents($algorithm);
            //$genetic->select();

            $current = $genetic->getParentOne()->getFitness();
            $current2 = $genetic->getParentTwo()->getFitness();

            /****************Prevent Algorithm From Gettting Stuck****************/
            if($adam != $current)
            {
                $adam = $current;
                $countA = 0;
            }

            else
            {
                $countA++;

                if($countA == $thresh)
                {
                    // Mutate Adam
                }
            }

            if($eve != $current2)
            {
                $eve = $current2;
                $countB = 0;
            }

            else
            {
                $countB++;

                if($countB == $thresh)
                {
                    // Mutate Adam
                    //$genetic->setParentTwo($population[]);

                    // Mutate Eve
                    //echo "Mutating Eve<br>";
                }
            }
            /****************Prevent Algorithm From Gettting Stuck****************/

            // Reproducing children
            $genetic->reproduce();

            // New population
            $genetic->newPopulation();
        }

        $counter++;
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