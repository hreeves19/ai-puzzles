<?php
/**
 * Created by PhpStorm.
 * User: Courtland
 * Date: 11/24/2018
 * Time: 5:02 PM
 */

class State
{
    private $currentState;
    private $queens;
    private $board;
    private $value;
    private $oneArray;
    private $name;
    private $probability;
    private $fitness;

    /**
     * State constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getFitness()
    {
        if($this->fitness < 0)
        {
            var_dump($this->board);
        }
        return $this->fitness;
    }

    /**
     * @param mixed $fitness
     */
    public function setFitness($fitness)
    {
        $this->fitness = $fitness;
    }

    /**
     * @return mixed
     */
    public function getBoard()
    {
        return $this->board;
    }

    /**
     * @param mixed $board
     */
    public function setBoard($board)
    {
        $this->board = $board;
    }

    /**
     * @return mixed
     */
    public function getProbability()
    {
        return $this->probability;
    }

    /**
     * @param mixed $probability
     */
    public function setProbability($probability)
    {
        $this->probability = $probability;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    public function getOneArray()
    {
        return $this->oneArray;
    }

    /**
     * @param mixed $oneArray
     */
    public function setOneArray()
    {
        $this->oneArray = array();

        // Rows
        for($i = 0; $i < $this->queens; $i++)
        {
            // Columns
            for($x = 0; $x < $this->queens; $x++)
            {
                // checking to see if a queen occupies this space
                if($this->board[$i][$x] == 1)
                {
                    array_push($this->oneArray, $x);
                }
            }
        }
    }

    /**
     * @param mixed $value
     */
    public function setValue($queens)
    {
        $this->value = $this->combinations($queens, 2);
    }

    /**
     * @return mixed
     */
    public function getCurrentState()
    {
        return $this->currentState;
    }

    /**
     * @param mixed $currentState
     */
    public function setCurrentState($currentState)
    {
        $this->currentState = $currentState;
    }

    /**
     * @return mixed
     */
    public function getQueens()
    {
        return $this->queens;
    }

    /**
     * @param mixed $queens
     */
    public function setQueens($queens)
    {
        $this->queens = $queens;
    }

    public function randomizeChromosome()
    {
        // Checking to make sure queens was set
        if(!isset($this->queens) || $this->queens < 1 || $this->queens == null)
        {
            return false;
        }

        $this->board = array();

        // Looping through the rows
        for ($i = 0; $i < $this->queens; $i++)
        {
            array_push($this->board, array()); // Making a column

            // Looping through the columns
            for ($x = 0; $x < $this->queens; $x++)
            {
                array_push($this->board[$i], 0);
            }
            $random = mt_rand(0, $this->queens - 1);
            $this->board[$i][mt_rand(0, $this->queens - 1)] = 1;
        }

        return true;
    }

    public function showBoard()
    {
        echo "<table id='chessboard'>";
        echo "<tbody>";

        for ($i = 0; $i < $this->queens; $i++)
        {
            echo "<tr>";
            for ($x = 0; $x < $this->queens; $x++)
            {
                //echo $this->board[$i][$x] . " ";
                if($this->board[$i][$x] == 1)
                {
                    echo "<td data-pos='$x'><img src=\"queen.png\" class='img-thumbnail'></td>";
                }

                else
                {
                    echo "<td data-pos='$x'" . $this->board[$i][$x] . "</td>";
                }
            }
            echo "</tr>";
        }
        echo "</tbody></table>";
    }

    /****************************************************************************************/
    // The following functions were not written by us, they were found in this URL
    // https://thydzik.com/php-factorial-and-combination-functions/
    function factorial($n) {
        if ($n <= 1) {
            return 1;
        } else {
            return $this->factorial($n - 1) * $n;
        }
    }

    public function combinations($n, $k)
    {
        //note this defualts to 0 if $n < $k
        if ($n < $k) {
            return 0;
        } else {
            return $this->factorial($n) / ($this->factorial($k) * $this->factorial(($n - $k)));
        }
    }
    /****************************************************************************************/

    public function calculateFitness()
    {
        // Local variables
        $counterRow = 0;
        $counterCol = 0;
        $attackingQueens = 0;
        $drow = 0;
        $dcol = 0;
        $ypositions = array();
        $xpositions = array();

        for ($i = 0; $i < $this->queens; $i++)
        {
            for ($x = 0; $x < $this->queens; $x++)
            {
                // Otherwise, check the element for the rows
                if($this->board[$i][$x] == 1)
                {
                    $counterRow++;
                }

                // Otherwise, check the element for the columns
                if($this->board[$x][$i] == 1)
                {
                    $counterCol++;
                }

                // If equal too 1, we found a queen
                if($this->board[$i][$x] == 1)
                {
                    // Store it in a positions array
                    array_push($ypositions, $x);
                    array_push($xpositions, $i);
                }
            } // Inner Loop, row

            // We found more than one queen in the row
            if($counterRow > 1)
            {
                $attackingQueens += $this->combinations($counterRow, 2);
            }

            // We found more than one queen in the col
            if($counterCol > 1)
            {
                $attackingQueens += $this->combinations($counterCol, 2);
            }

            // Resetting all counters
            $counterRow = 0;
            $counterCol = 0;
        } // Outer loop, row

        $clashes = 0;

        // Getting diagonals
        for ($i = 0; $i < $this->queens; $i++)
        {
            for ($x = 0; $x < $this->queens; $x++)
            {
                if($i != $x)
                {
                    $drow = abs($xpositions[$i] - $xpositions[$x]);
                    $dcol = abs($ypositions[$i] - $ypositions[$x]);

                    if($drow == $dcol)
                    {
                        //echo "Diagonal at <br>";
                        //echo "(" . $xpositions[$i] . ", " . $ypositions[$i] . ")<br>";
                        //echo "(" . $xpositions[$x] . ", " . $ypositions[$x] . ")<br>";
                        $clashes += 1;
                    }
                }
            }
            //echo "(" . $xpositions[$i] . ", " . $ypositions[$i] . ")<br>";
            //echo "<br>";
        }
        $clashes = $clashes / 2;

        $this->fitness = $this->value - ($attackingQueens + $clashes);
        return $this->value - ($attackingQueens + $clashes);
    }

    public function subtract($a, $b) {
        return $a - $b;
    }

    public function overwrite($newSequence)
    {
        // Looping through the rows
        for($i = 0; $i < count($this->board); $i++)
        {
            $this->board[$i] = 0;
        }
    }
}