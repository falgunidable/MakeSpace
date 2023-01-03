<?php
require 'connect.php';
header("Access-Control-Allow-Origin: http://localhost:3000");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$sql = "SELECT * FROM registerusers";
$result = mysqli_query($db,$sql);
$json_array = array();
while($row = mysqli_fetch_assoc($result)){
    $json_array[] = $row;
}     
echo json_encode($json_array);
?> 