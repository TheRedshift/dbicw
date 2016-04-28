<?php
/**
 * Created by PhpStorm.
 * User: Rahul Soni
 * Date: 28/04/2016
 * Time: 10:46
 */

$user = 'root';
$pass = '';
$db = 'DBICW';

$db = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect- check connectScript.php");

echo "Great work";
