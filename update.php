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

$oldnaam = $_POST["oldname"];

$naam = $_POST["newname"];
$achternaam = $_POST["newlname"];
$email = $_POST["newemail"];

$stmt = $conn->prepare("UPDATE names SET name='$naam', lastname='$achternaam', email='$email' WHERE name='$oldnaam'");
if ($stmt->execute()) { 
    echo "succes";
 } else {
    echo "no succes";
 }

echo "<a href='index.php'>Terug naar index.</a>";

?>