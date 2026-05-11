<?php
$hostname = 'localhost';
$user = 'mathew';
$pwd = 'mathew123';
$database = 'gigspace';

$conn = mysqli_connect($hostname,$user, $pwd, $database);
if(!$conn){
 echo "failed connection: Error:". mysqli_connect_error($conn);
}
