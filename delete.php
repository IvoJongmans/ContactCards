<?php

require_once "login.php";

try {
    $conn = new PDO("mysql:host=$hn;dbname=$db", $un, $pw);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully <br/>"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

$delrec = $_POST["deleterecord"];


$stmt = $conn->prepare("DELETE FROM names WHERE id='$delrec'");
if ($stmt->execute()) { 
    echo "Item succesvol verwijderd:)";
 } else {
    echo "Item niet verwijderd:(";
 }

echo "<a href='index.php'>Terug naar index.</a>";

?>