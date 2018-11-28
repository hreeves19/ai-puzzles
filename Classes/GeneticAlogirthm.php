<?php
/**
 * Created by PhpStorm.
 * User: Courtland
 * Date: 11/25/2018
 * Time: 5:21 PM
 */

class GeneticAlogirthm
{
    private $population = array();
    private $probability = array();
    private $parentOne;
    private $parentTwo;
    private $children = array();

    /**
     * GeneticAlogirthm constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getParentOne()
    {
        return $this->parentOne;
    }

    /**
     * @param mixed $parentOne
     */
    public function setParentOne($parentOne)
    {
        $this->parentOne = $parentOne;
    }

    /**
     * @return mixed
     */
    public function getParentTwo()
    {
        return $this->parentTwo;
    }

    /**
     * @param mixed $parentTwo
     */
    public function setParentTwo($parentTwo)
    {
        $this->parentTwo = $parentTwo;
    }

    /**
     * @return mixed
     */
    public function getChild()
    {
        return $this->children;
    }

    /**
     * @param mixed $child
     */
    public function setChild($child)
    {
        $this->children = $child;
    }

    /**
     * @return array
     */
    public function getPopulation()
    {
        return $this->population;
    }

    /**
     * @param array $population
     */
    public function setPopulation($population)
    {
        $this->population = $population;
    }

    public function select()
    {
        // Set the first parent
        $max_1 = max($this->probability);

        // If whole population is worse case scenario
        if($max_1 == 0)
        {
            $randOne = mt_rand(0, count($this->population) - 1);
            $randTwo = $randOne;

            $this->setParentOne($this->population[$randOne]);

            // Preventing same parent being chosen
            while($randOne == $randTwo)
            {
                $randTwo = mt_rand(0, count($this->population) - 1);
            }

            $this->setParentTwo($this->population[$randTwo]);
        }

        else
        {
            // Setting first parent by maximum probability
            $this->setParentOne($this->population[array_search($max_1, $this->probability)]);

            // Search array for other candidates that have the same max value
            $maxPop = array_keys($this->probability, $max_1);

            if(count($maxPop) >= 2)
            {
                $this->setParentTwo($this->population[$maxPop[1]]);
            }

            else
            {
                // Setting both to zero
                $max = $max_2 = 0;

                // Select parent by second best probability
                for($i=0; $i<count($this->probability); $i++)
                {
                    if($this->probability[$i] > $max)
                    {
                        $max_2 = $max;
                        $max = $this->probability[$i];
                    }
                    else if($this->probability[$i] > $max_2)
                    {
                        $max_2 = $this->probability[$i];
                    }
                    //echo "$max<br>$max_2<br>";
                }

                // Setting first parent by maximum probability
                $this->setParentTwo($this->population[array_search($max_2, $this->probability)]);
            }
            //var_dump($this->probability);
            echo "<h3>State " . $this->getParentOne()->getName() . "</h3>" . $this->getParentOne()->showBoard() . "Fitness " . $this->parentOne->getFitness() . "<br>";
            echo "<h3>State " . $this->getParentTwo()->getName() . "</h3>" . $this->getParentTwo()->showBoard() . "Fitness " . $this->parentTwo->getFitness() . "<br>";
        }
    }

    public function reproduce()
    {
        // Get adam and eve to create new population
        $adam = $this->getParentOne();
        $eve = $this->getParentTwo();

        // Creating new population from the 2 best fit individuals
        for($i = 0; $i < count($this->population); $i++)
        {
            // Coin flip for mutation and crossover
            $this->pmxcrossover($adam->getOneArray(), $eve->getOneArray(), $i);

            //echo "Child $i: " . print_r($this->children[$i]) . "<br>";
        }
    }

    public function pmxcrossover($adam, $eve, $i)
    {
        // Chunk size is queens / 2
        $queens = $this->parentOne->getQueens();
        $chunk_size = mt_rand(1, $queens / 2);

        // From front of parent
        if(mt_rand(0, 1))
        {
            // Mom goes first
            if(mt_rand(0, 1))
            {
                // Slicing array from beginning
                $eve = array_slice($eve, 0, $chunk_size);
                $adam = array_slice($adam, 0, $queens - $chunk_size);

                array_push($this->children, array_merge($eve, $adam));
            }

            else
            {
                // Slicing array from beginning
                $eve = array_slice($eve, 0,$queens - $chunk_size);
                $adam = array_slice($adam, 0, $chunk_size);

                array_push($this->children, array_merge($adam, $eve));
            }
        }

        // Back of parent
        else
        {
            // Mom goes first
            if(mt_rand(0, 1))
            {
                // Slicing array from beginning
                $eve = array_slice($eve, -($chunk_size), $chunk_size);
                $adam = array_slice($adam,-($queens - $chunk_size), $queens - $chunk_size);

                array_push($this->children, array_merge($eve, $adam));
                //shuffle($this->children[$i]);
            }

            else
            {
                // Slicing array from beginning
                $adam = array_slice($adam, -($chunk_size), $chunk_size);
                $eve = array_slice($eve,-($queens - $chunk_size), $queens - $chunk_size);

                array_push($this->children, array_merge($adam, $eve));
                //shuffle($this->children[$i]);
            }
        }

        // Attempting to mutate the child
        $this->mutation($i);
    }

    public function mutation($i)
    {
        // Chances of mutating
        if (mt_rand(1, 100) == 1)
        {
            echo "Mutation occured <br>";
            $position = mt_rand(0, (count($this->children[$i])) - 1);
            $swap = mt_rand(0, (count($this->children[$i])) - 1);

            // Making sure they are not the same
            while ($position == $swap)
            {
                $position = mt_rand(0, (count($this->children[$i])) - 1);
            }

            // Swapping mutated Alle
            $mutatedAllele = $this->children[$i][$position];
            $this->children[$i][$position] = $this->children[$i][$swap];
            $this->children[$i][$swap] = $mutatedAllele;
        }
    }


    public function calculateProbability($fitnessArray)
    {
        // Calculate sum
        $sum = array_sum($fitnessArray);

        // Checking to make sure population is set
        if(!isset($this->population) || $this->population == null || count($this->population) < 1)
        {
            return false;
        }

        for($i = 0; $i < count($this->population); $i++)
        {
            // Setting probability of being selected
            array_push($this->probability, $fitnessArray[$i] / $sum);
            $this->population[$i]->setProbability($this->probability[$i]);
        }

        return true;
    }

    public function newPopulation()
    {
        // Looping through population
        for($i = 0; $i < count($this->population); $i++)
        {
            // Getting the board
            $board = $this->population[0]->getBoard();

            // Resetting entire board and overwriting the previous state with the new one
            for($x = 0; $x < count($board); $x++)
            {
                for($y = 0; $y < count($board); $y++)
                {
                    $board[$x][$y] = 0;
                }
                // Overwriting
                $board[$x][$this->children[$i][$x]] = 1;
                //$temp = array_keys($board[$x], 1);
                //$counter += count($temp);
            }

            $this->population[$i]->setBoard($board);
        }
    }
}