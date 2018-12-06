<?php
/**
 * Created by PhpStorm.
 * User: Courtland
 * Date: 11/24/2018
 * Time: 4:00 PM
 */
require("../Classes/State.php");
require("../Classes/GeneticAlgorithm.php");

$previousAdam = 0;
$previousEve = 0;
$adam = 0;
$eve = 0;
$countA = 0;
$countB = 0;
$thresh = 5;
$maxFitness = 0;
$bestResult = new State();
$pass = true;
$restart = false;
$numberMutations = 0;
$avgMutations = array();

// Start timer
$time_start = microtime(true);

// Getting command line arguements
if(isset($argv[0]) && isset($argv[1]) && isset($argv[2]) && isset($argv[3]) && isset($argv[4]))
{
    // Getting command line arguments
    $filepath = $argv[0];
    $queens = $argv[1];
    $popSize = $argv[2];
    $algorithm = $argv[3];
    $iterations = $argv[4];
    $foundSol = false;
    $fitness = array();
    $counter = 0;
    $logPath = "C:\\xampp\htdocs\ai-puzzles\Log\\log.txt";
    $chaos = $iterations;

    // For chart
    $json = array();

    $size = $queens * $queens;

    // Creating population array
    $population = array();

    // Creating text file
    $log = fopen($logPath, "a");
    fwrite($log, "\nStarting system at " . date("F d, Y h:i:s A", time()) . "\n");
    fwrite($log, "Initial values:\nFilepath: $filepath\nNumber of queens: $queens\nPopulation size:$popSize\nAlgorithm choice: $algorithm\nMax Iterations: $iterations\n");

    // Population is now initialized enter the while loop
    /*while($counter != $iterations)
    {
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

        foreach($population as $individual)
        {
            fwrite($log, "Indivdual " . $individual->getName() . " sequence is " . implode($individual->getOneArray()) . " fitness value " . $individual->getFitness() . "\n");
        }

        // Population
        $genetic = new GeneticAlgorithm($log, 1000);
        $genetic->setPopulation($population);

        // Selecting
        if($genetic->calculateProbability($fitness) == false)
        {
            $foundSol = true;
            echo "Error: The population was not initialized. Counter at: $counter<br>";
            for($i = 0; $i < count($population); $i++)
            {
                $population[$i]->showBoard();
            }
        }

        else
        {
            $fittest = max($fitness);

            // Recording best fit
            if($fittest > $maxFitness)
            {
                $maxFitness = $fittest;
                $bestResult = $population[array_search($maxFitness, $fitness)];
                $temp = $bestResult->getFitness();

                fwrite($log, "Best fitness found at " . date("F d, Y h:i:s A", time()) . "\nThe fitness value is $temp\n\n");
            }
            // Selecting adam and eve
            $genetic->selectParents($algorithm);

            // New population
            $genetic->newPopulation();
        }

        fwrite($log, "Iteration $counter completed at " . date("F d, Y h:i:s A", time()) . "\n");
        $counter++;
        unset($fitness);
        $fitness = array();

        if($foundSol == true)
        {
            break;
        }
    }*/
    $solved = array();
    $json[0] = count($solved);

    // Creating initial population
    for($i = 0; $i < $popSize; $i++)
    {
        array_push($population, new State());
        $population[$i]->setName($i);

        $population[$i]->setQueens($queens);

        // Creating random gene sequence
        $population[$i]->initialize($queens);

        // Setting the board based on the genes
        $population[$i]->genesToBoard();

        // Setting the value
        $population[$i]->setValue($queens);
    }

    // Entering the while loop, time to solve puzzle *cracks knuckles*
    while($counter != $iterations && $pass)
    {
        $fitness = array();

        // lets calculate the fitness first
        foreach($population as $individuals)
        {
            array_push($fitness, $individuals->calculateFitness());

            // Checking if puzzle is solved
            if($individuals->getFitness() == $individuals->getValue())
            {
                $temp = implode($individuals->getOneArray());

                // Checking if we already have it
                if(array_search($temp, $solved) === false)
                {
                    fwrite($log, "The puzzle has been solved with a sequence of " . implode($individuals->getOneArray()) . " " . date("F d, Y h:i:s A", time()) . "\n");
                    $individuals->showBoard();
                    array_push($solved, $temp);
                    $solved = array_unique($solved);
                    $restart = true;
                    $json[$counter] = count($solved);
                }

                if(count($solved) == 92)
                {
                    fwrite($log, "All solutions have been found " . date("F d, Y h:i:s A", time()) . "\n");
                    $pass = false;
                }
            }
            //fwrite($log, "Individual " . $individuals->getName() . " gene sequence is " . implode($individuals->getOneArray()) . " and fitness is " . $individuals->getFitness() . "\n");
        }

        // Starting all over
        if($restart && $pass != false)
        {
            $restart = false;

            // Creating initial population
            for($i = 0; $i < $popSize; $i++)
            {
                // Creating random gene sequence
                $population[$i]->initialize($queens);

                // Setting the board based on the genes
                $population[$i]->genesToBoard();

                // Setting the value
                $population[$i]->setValue($queens);
            }
            fwrite($log, "Reinitializing population " . date("F d, Y h:i:s A", time()) . "\n");

        }

        else
        {
            // Starting solver
            $solver = new GeneticAlgorithm($log, 1000);

            // Need to start selecting and reproducing next gen
            $solver->setPopulation($population);

            // If adam and eve
            if($algorithm == 0)
            {
                $solver->calculateProbability($fitness);
            }
            $solver->selectParents($algorithm,  $fitness);
            //$solver->logKids();
            $solver->newPopulation();
        }

        $numberMutations = $solver->getMutations();
        array_push($avgMutations, $numberMutations);
        $numberMutations = 0;

        unset($fitness);
        $counter++;

        if(mt_rand(0, $chaos) == 0)
        {
            fwrite($log, "Oh no! A natural disaster has occurred and the entire population has been wiped out! Restarting at " . date("F d, Y h:i:s A", time()) . "\n");
            $restart = true;
            $chaos = $iterations;
        }

        else
        {
            $chaos -= intval(mt_rand(1, sqrt($iterations)));

            if($chaos < 0)
            {
                $chaos = 1;
            }
        }

        fwrite($log, "Iteration $counter completed at " . date("F d, Y h:i:s A", time()) . "\n");
    }

    // labels
    $file = fopen("C:\\xampp\htdocs\ai-puzzles\Log\\labels.txt", "w");
    fwrite($file, serialize($json));
    fclose($file);

    fwrite($log, "Finished system run at " . date("F d, Y h:i:s A", time()) . "\n");
    fclose($log);

    // Average Mutations per generations
    $file = fopen("C:\\xampp\htdocs\ai-puzzles\Log\\mutation.txt", "w");
    $chunks = array_chunk($avgMutations, intval($iterations / 10));
    $temp = array();

    // Getting nice data for graph
    foreach ($chunks as $key => $value)
    {
        $temp[$key] = $value[0];
    }

    fwrite($file, serialize($temp));
    fclose($file);

    echo "<h1>Execution Time: " . (microtime(true) - $time_start) . " ms</h1>";
}

else
{
    echo "Not all arguments were set, here is the list: ";
    var_dump($argv);
}
?>