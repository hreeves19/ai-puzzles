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

    public function __construct()
    {

    }

    public function initialize($numQueens)
    {
        // Creating random sequence
        $this->setQueens($numQueens);

        $genes = array();

        for($i = 0; $i < $numQueens; $i++)
        {
            $genes[$i] = mt_rand(0, $numQueens - 1);
        }

        $this->overwriteOneArray($genes);
    }

    public function genesToBoard()
    {
        // Getting genes and resetting board
        $genes = $this->oneArray;
        $board = array_fill(0, $this->queens, array_fill(0, $this->queens, 0));
        $count = 0;
        foreach ($board as $keys => $rows)
        {
            $board[$genes[$count]][$keys] = 1;
            $count++;
        }

        $this->setBoard($board);
    }


    /**
     * @return mixed
     */
    public function getFitness()
    {
        if($this->fitness < 0)
        {
            echo "Individual has a fitness value lower than 0, which is impossible.<br>";
            $this->showBoard();
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

    public function setOneArray()
    {
        $this->oneArray = array();

        // Rows
        /*for($i = 0; $i < $this->queens; $i++)
        {
            // Columns
            // Columns
            for($x = 0; $x < $this->queens; $x++)
            {
                // checking to see if a queen occupies this space
                if($this->board[$i][$x] == 1)
                {
                    array_push($this->oneArray, "($i, $x)");
                }
            }
        }*/
        $col = 0;

        for($x = 0; $x < $this->queens; $x++)
        {
            for($i = 0; $i < $this->queens; $i++)
            {
                if($this->board[$i][$col] == 1)
                {
                    array_push($this->oneArray, $i);
                    $col++;
                    break;
                }
            }
        }
    }

    public function overwriteOneArray($array)
    {
        $this->oneArray = $array;
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
        $counter = 0;
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

            $this->board[mt_rand(0, $i)][$i] = 1;
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
                        $clashes += 1;
                    }
                }
            }
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