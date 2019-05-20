<?php

require_once "login.php";

$fname = $_GET["getmethod"];

try {
    $conn = new PDO("mysql:host=$hn;dbname=$db", $un, $pw);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully <br/>"; 
    }
catch(PDOException $e)
    {
      echo "Connection failed: " . $e->getMessage();
    }

if($_SERVER["REQUEST_METHOD"] == "GET") {

$sql = "SELECT * FROM names WHERE name='$fname'";

$data = $conn->query($sql)->fetchAll();

foreach ($data as $row) {
    echo "Naam: ".$row['name']."<br />\n";
    echo "Achternaam: ".$row['lastname']."<br />\n";
    echo "ID: ".$row['id']."<br />\n";
    echo "E-mail: ".$row['email']."<br />\n";
    }
}
?>