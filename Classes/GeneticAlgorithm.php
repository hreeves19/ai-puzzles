<?php
/**
 * Created by PhpStorm.
 * User: Courtland
 * Date: 11/25/2018
 * Time: 5:21 PM
 */

class GeneticAlgorithm
{
    private $population = array();
    private $probability = array();
    private $parentOne;
    private $parentTwo;
    private $children = array();
    private $parents = array();
    private $k;
    private $log;
    private $switch;
    private $mutations = 0;
    private $mutationRate;

    /**
     * GeneticAlgorithm constructor.
     */
    public function __construct($log, $switch, $k, $mutate)
    {
        $this->log = $log;
        $this->switch = $switch;
        $this->k = $k;
        $this->mutationRate = $mutate;
    }

    /**
     * @return mixed
     */
    public function getMutations()
    {
        return $this->mutations;
    }

    /**
     * @param mixed $mutations
     */
    public function setMutations($mutations)
    {
        $this->mutations = $mutations;
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

    public function selectParents($algorithm, $fitness)
    {
        switch($algorithm)
        {
            // Adam and Eve
            case 0:
                $this->select($fitness);
                $this->parentSwap();
                $parentOne = $this->getParentOne();
                $parentTwo = $this->getParentTwo();
                $timeout = 0;

                // Checking if parents are the same
                while($parentOne->getOneArray() == $parentTwo->getOneArray())
                {
                    // Selecting random person
                    $parentTwo = $this->population[mt_rand(0, count($this->population) - 1)];

                    if($parentOne->getOneArray() == $parentTwo->getOneArray())
                    {
                        fwrite($this->log, "Error: Selected the same parents again. Trying to correct this.... (timeout " . $timeout . ")\n");
                        $timeout++;
                    }

                    if($timeout > 15)
                    {
                        fwrite($this->log, "Error: Trying to break out of the while loop....\n");
                        break;
                    }
                }

                // Setting parents once again
                $this->setParentOne($parentOne);
                $this->setParentTwo($parentTwo);

                // Making children
                while(count($this->children) != count($this->population))
                {
                    // Reproducing
                    $this->reproduce();
                }
                break;

            // K tournament
            case 1:
                {
                    // Continuing this till new population is created
                    foreach($this->population as $candidates)
                    {
                        $parentOne = $this->ktournament();
                        $parentTwo = $this->ktournament();
                        $timeout = 0; // Resetting time out
                        // Trying to swap parents out
                        $this->parentSwap();

                        // Checking if parents are the same
                        while($parentOne->getOneArray() == $parentTwo->getOneArray())
                        {
                            // Selecting random person
                            $parentTwo = $this->population[mt_rand(0, count($this->population) - 1)];

                            if($parentOne->getOneArray() == $parentTwo->getOneArray())
                            {
                                fwrite($this->log, "Error: Selected the same parents again. Trying to correct this.... (timeout " . $timeout . ")\n");
                                $timeout++;
                            }

                            if($timeout > 15)
                            {
                                fwrite($this->log, "Error: Trying to break out of the while loop....\n");
                                break;
                            }
                        }

                        $this->parentOne = $parentOne;
                        $this->parentTwo = $parentTwo;
                        $this->reproduce();
                    }
                }
                break;
        }
    }

    public function parentSwap()
    {
        // Random probability that a parent switches
        if(mt_rand(1, $this->switch) == 1)
        {
            fwrite($this->log, "Random parent 1 swap at " . date("F d, Y h:i:s A", time()) . "\n");
            $this->setParentOne($this->population[mt_rand(0, count($this->population) - 1)]);
        }

        if(mt_rand(1, $this->switch) == 1)
        {
            fwrite($this->log, "Random parent 2 at " . date("F d, Y h:i:s A", time()) . "\n");
            $this->setParentTwo($this->population[mt_rand(0, count($this->population) - 1)]);
        }
    }


    public function ktournament()
    {
        $arena = array();
        $fitness = array();

        // Select random individuals from pop and make them fight
        for($i = 0; $i < $this->k; $i++)
        {
            // Shoving individuals into the arena
            array_push($arena, $this->population[mt_rand(0, count($this->population) - 1)]);
            array_push($fitness, $arena[$i]->getFitness());
        }

        $winner = $this->population[array_search(max($fitness), $fitness)];
        return $winner;
    }

    public function select($fitness)
    {
        $temp = $fitness;
        asort($temp);
        $max_1 = max($temp);
        $max_2 = min($temp);

        for($i=0; $i<count($temp); $i++)
        {
            if($temp[$i] > $max_1)
            {
                $max_1 = $temp[$i];
            }

            if($temp[$i] > $max_2 && $max_1 != $temp[$i])
            {
                $max_2 = $temp[$i];
            }
        }

        $this->setParentOne($this->population[array_search($max_1, $fitness)]);
        $this->setParentTwo($this->population[array_search($max_2, $fitness)]);

        /*echo "<h3>State " . $this->getParentOne()->getName() . "</h3>" . $this->getParentOne()->showBoard() . "Fitness " . $this->parentOne->getFitness() . "<br>";
        echo "<h3>State " . $this->getParentTwo()->getName() . "</h3>" . $this->getParentTwo()->showBoard() . "Fitness " . $this->parentTwo->getFitness() . "<br>";*/

    }

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
        $method = 0;

        switch($method)
        {
            // One Point Crossover
            case 0:
            {
                // Generate a random position, - 2 so that we don't copy the entire thing by accident
                $position = mt_rand(1, count($adam) - 2);
                //fwrite($this->log, "Parent one " . implode($adam) . " and parent two " . implode($eve) . "\n");
                //fwrite($this->log, "Position for tail " . $position . "\n");

                // We cross over
                if(mt_rand(0, 1))
                {
                    // adam will be the first part of the parent
                    $firstTail = array_slice($adam, 0, $position);
                    $secondTail = array_slice($eve, $position); // To not overwrite adam
                    $geneSequence = array_merge($firstTail, $secondTail);
                    array_push($this->children, $geneSequence);
                }

                else
                {
                    // eve will be the first part of the parent
                    $firstTail = array_slice($eve, 0, $position);
                    $secondTail = array_slice($adam, $position); // To not overwrite adam
                    $geneSequence = array_merge($firstTail, $secondTail);
                    array_push($this->children, $geneSequence);
                }
                break;
            }

            // Multi Point Point Crossover
            case 1:
            {
                $bound1 = mt_rand(1, $size / 2);
                $bound2 = mt_rand($bound1, $size / 2);

                if(mt_rand(0, 1))
                {
                    // First child gets adam as first and then eves
                    array_push($this->children, array_merge(array_slice($adam, 0, $bound1), array_slice($eve, $bound1 + 1, $bound2), array_slice($adam, $bound2 + 1)));

                }

                else
                {
                    array_push($this->children, array_merge(array_slice($eve, 0, $bound1), array_slice($adam, $bound1 + 1, $bound2), array_slice($eve, $bound2 + 1)));

                }

                break;
            }

            // Uniform Crossover
            case 2:
            {
                $geneSequence = array();
                for($i = 0; $i < count($adam); $i++)
                {
                    if(mt_rand(0, 1))
                    {
                        array_push($geneSequence, $adam[$i]);
                    }

                    else
                    {
                        array_push($geneSequence, $eve[$i]);
                    }
                }
                array_push($this->children, $geneSequence);
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
        if(isset($this->children[$i]) && $this->children[$i] != null && count($this->children) > 0)
        {
            // Chances of mutating
            if (mt_rand(1, 10)  <= $this->mutationRate)
            {
                // Hulking out
                $geneSequence = $this->children[$i];
                $og = $geneSequence;

                $geneSequence[mt_rand(0, count($geneSequence) - 1)] = mt_rand(0, count($geneSequence) - 1);

                // Reset child
                $this->children[$i] = $geneSequence;

                //fwrite($this->log, "Mutation occurred. Original " . implode($og) . " changed to " . implode($geneSequence) . "\n");
                $this->mutations++;
            }
        }
    }


    public function calculateProbability($fitnessArray)
    {
        // Calculate sum
        $sum = array_sum($fitnessArray);

        // Checking to make sure population is set
        if(!isset($this->population) || $this->population == null || count($this->population) < 1 || $sum == 0)
        {
            echo $sum;
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
        $count = 0;
        foreach($this->children as $newIndividual)
        {
            $this->population[$count]->overwriteOneArray($newIndividual);
            $this->population[$count]->genesToBoard();
            $count++;
        }

    }

    public function logKids()
    {
        $count = 0;
        foreach($this->children as $child)
        {
            fwrite($this->log, "Child " . $count . " gene sequence is " . implode($child) . "\n");
            $count++;
        }
    }
}