<h1>Test Connectie</h1>

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

    $data = $conn->query("SELECT * FROM names")->fetchAll();

    foreach ($data as $row) {
        echo $row['name']." ";
        echo $row['lastname']." ";
        echo $row['email']."<br />\n";
    }


?>

<a href="create.html">Voeg namen toe</a>