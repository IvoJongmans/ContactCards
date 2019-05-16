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

$naam = $_POST["newname"];
$achternaam = $_POST["newlname"];
$email = $_POST["newemail"];

$stmt = $conn->prepare("INSERT INTO names (name, lastname, email) VALUES (:name, :lname, :email)");
$stmt->bindParam(':name', $naam);
$stmt->bindParam(':lname', $achternaam);
$stmt->bindParam(':email', $email);

$stmt->execute();

echo "<a href='index.php'>Terug naar index.</a>";

?>