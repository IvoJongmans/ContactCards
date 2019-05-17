<?php
header('Content-type: application/json; charset=utf-8');
require_once "login.php";

try {
    $conn = new PDO("mysql:host=$hn;dbname=$db", $un, $pw);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully <br/>"; 
    }
catch(PDOException $e)
    {
    // echo "Connection failed: " . $e->getMessage();
    }

$sql = "SELECT * FROM names";

$run = $conn->prepare($sql);
$run->execute();

$fetch = array();

while($row = $run->fetch(PDO::FETCH_ASSOC)) {
    $fetch['names'][] = $row;
}

echo json_encode($fetch);
?>