<?php

require_once "login.php";

$fname = $_REQUEST["name"];

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

$sql = "SELECT * FROM names WHERE name='$fname'";

// $run = $conn->prepare($sql);
// $run->execute();

// $fetch = array();

// while($row = $run->fetch(PDO::FETCH_ASSOC)) {
//     $fetch['names'][] = $row;
// }

// print_r(array_values($fetch));


$data = $conn->query($sql)->fetchAll();

foreach ($data as $row) {
    echo "Naam: ".$row['name']."<br />\n";
    echo "Achternaam: ".$row['lastname']."<br />\n";
    echo "ID: ".$row['id']."<br />\n";
    echo "E-mail: ".$row['email']."<br />\n";

}

?>