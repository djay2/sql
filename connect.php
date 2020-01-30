<?php
/**
 * Created by PhpStorm.
 * User: Aravinth
 * Date: 10-09-2017
 * Time: 12:34 PM
 */

$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname = 'test';
$port=3308;
//$con = mysqli_connect($hostname,$username,$password,$port);
//mysqli_select_db($con,$dbname);

$con = new mysqli('127.0.0.1', $username, $password, $dbname, $port);
?>
