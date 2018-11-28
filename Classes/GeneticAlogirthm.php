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
    private $parents = array();
    private $k = 2;

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

    public function selectParents($algorithm)
    {
        switch($algorithm)
        {
            case 0:
                $this->select();

                while(count($this->children) != count($this->population))
                {
                    // Reproducing
                    $this->reproduce();
                }
                break;

            case 1:
                while(count($this->children) != count($this->population))
                {
                    // Making individuals fight
                    array_push($this->parents, $this->ktournament());
                    array_push($this->parents, $this->ktournament());

                    // Setting parents
                    $this->setParentOne($this->parents[0]);
                    $this->setParentTwo($this->parents[1]);

                    // Reproducing
                    $this->reproduce();
                    unset($this->parents);
                    $this->parents = array();
                }
                break;
        }
    }

    public function ktournament()
    {
        $arena = array();

        // Select random individuals from pop and make them fight
        for($i = 0; $i < $this->k; $i++)
        {
            // Shoving individuals into the arena
            array_push($arena, $this->population[mt_rand(0, count($this->population) - 1)]);
        }

        $winner = $this->population[array_search(max($arena), $arena)];
        return $winner;
    }

    public function select()
    {
        $temp = $this->probability;
        asort($temp);
        $max_1 = max($temp);
        $max_2 = min($temp);

        for($i=0; $i<count($temp); $i++)
        {
            if($temp[$i] > $max_1)
            {
                $max_1 = $temp[$i];
            }
            else if($temp[$i] > $max_2 && $max_1 != $temp[$i])
            {
                $max_2 = $temp[$i];
            }
        }

        $this->setParentOne($this->population[array_search($max_1, $this->probability)]);
        $this->setParentTwo($this->population[array_search($max_2, $this->probability)]);

        echo "<h3>State " . $this->getParentOne()->getName() . "</h3>" . $this->getParentOne()->showBoard() . "Fitness " . $this->parentOne->getFitness() . "<br>";
        echo "<h3>State " . $this->getParentTwo()->getName() . "</h3>" . $this->getParentTwo()->showBoard() . "Fitness " . $this->parentTwo->getFitness() . "<br>";

    }

    /*public function reproduce()
    {
        // Get adam and eve to create new population
        $adam = $this->getParentOne();
        $eve = $this->getParentTwo();
        $count = 0;

        // Creating new population from the 2 best fit individuals
        for($i = 0; $i < count($this->population) / 2; $i++)
        {
            // Coin flip for mutation and crossover
            $this->pmxcrossover($adam->getOneArray(), $eve->getOneArray(), $i);

            //echo "Child $i: " . print_r($this->children[$i]) . "<br>";
        }

        for($i = 0; $i < count($this->population); $i++)
        {
            if($i == count($this->population) - 1)
            {
                continue;
            }

            else if($this->children[$i] == $this->children[$i + 1])
            {
                $count++;
            }
        }

        echo "Population that is the same: $count<br>";
    }*/

    public function reproduce()
    {
        // parents to reproduce
        $parent1 = $this->getParentOne();
        $parent2 = $this->getParentTwo();
        $count = count($this->children) - 1;

        $this->pmxcrossover($parent1->getOneArray(), $parent2->getOneArray(), $count);
    }

    public function pmxcrossover($adam, $eve, $i)
    {
        $method = mt_rand(0, 2);
        $size = count($adam) - 1;
        $next = $i + 1;

        switch($method)
        {
            // One Point Crossover
            case 0:
            {
                $cuttoff = mt_rand(1, $size);

                // First child gets adam as first and then eves
                array_push($this->children, array_merge(array_slice($adam, 0, $cuttoff), array_slice($eve, $cuttoff)));
                array_push($this->children, array_merge(array_slice($eve, 0, $cuttoff), array_slice($adam, $cuttoff)));

                break;
            }

            // Multi Point Point Crossover
            case 1:
            {
                $bound1 = mt_rand(1, $size / 2);
                $bound2 = mt_rand($bound1, $size / 2);

                // First child gets adam as first and then eves
                array_push($this->children, array_merge(array_slice($adam, 0, $bound1), array_slice($eve, $bound1 + 1, $bound2), array_slice($adam, $bound2 + 1)));
                array_push($this->children, array_merge(array_slice($eve, 0, $bound1), array_slice($adam, $bound1 + 1, $bound2), array_slice($eve, $bound2 + 1)));

                break;
            }

            // Uniform Crossover
            case 2:
            {
                $geneSequence1 = array();
                $geneSequence2 = array();

                for($i = 0; $i < count($adam); $i++)
                {
                    // Adam if 1
                    if(mt_rand(0, 1))
                    {
                        array_push($geneSequence1, $adam[$i]);
                        array_push($geneSequence2, $eve[$i]);
                    }

                    else
                    {
                        array_push($geneSequence2, $adam[$i]);
                        array_push($geneSequence1, $eve[$i]);
                    }
                }

                array_push($this->children, $geneSequence1);
                array_push($this->children, $geneSequence2);
                break;
            }

            // Invalid number
            default:
            {
                break;
            }
        }

        // Attempting to mutate the child
        $this->mutation($i, false, false);
    }

    public function mutation($i, $flag, $parent)
    {
        // Chances of mutating
        if (mt_rand(1, 1000) == 1)
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
        if(!isset($this->population) || $this->population == null || count($this->population) < 1 || $sum == 0)
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