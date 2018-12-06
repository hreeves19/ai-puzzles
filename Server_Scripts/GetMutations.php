<?php
/**
 * Created by PhpStorm.
 * User: Courtland
 * Date: 12/5/2018
 * Time: 7:21 PM
 */

$mutations = file_get_contents("C:\\xampp\htdocs\ai-puzzles\Log\mutation.txt");

if($mutations != false)
{
    $mutations = unserialize($mutations);
    echo json_encode($mutations);
}