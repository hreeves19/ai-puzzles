<?php
/**
 * Created by PhpStorm.
 * User: Courtland
 * Date: 12/2/2018
 * Time: 10:24 PM
 */

$temp = file_get_contents("C:/xampp/htdocs/ai-puzzles/Log/log.txt");
$labels = file_get_contents("C:/xampp/htdocs/ai-puzzles/Log/labels.txt");
/*if($temp != false)
{
    echo "<p>$temp</p>";
}

else
{
    echo "<p>Cannot open log.</p>";
}*/

if($labels != false)
{
   $labels = unserialize($labels);
   echo json_encode($labels);
}