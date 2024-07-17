<?php 
$host="localhost";
$user="root";
$pass="root";
$db="importexport";

$conn=new mysqli($host,$user,$pass,$db);

if($conn->error)
{
    die("Connection error! Please Try Again Later!");
}
?>