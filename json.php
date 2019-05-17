<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JSON</title>
</head>
<body>

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

$sql = "SELECT * FROM names";

$run = $conn->prepare($sql);
$run->execute();

$fetch = array();

while($row = $run->fetch(PDO::FETCH_ASSOC)) {
    $fetch['names'][] = $row;
}



?>

<script type="text/javascript">
var ar = <?php echo json_encode($fetch) ?>;
console.log(ar);
</script>
    
</body>
</html>