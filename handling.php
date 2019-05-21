<?php
header('Content-type: application/json; charset=utf-8');
require_once "login.php";

try {
    $conn = new PDO("mysql:host=$hn;dbname=$db", $un, $pw);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully <br/>"; 
    }
catch(PDOException $e)
    {
      echo "Connection failed: " . $e->getMessage();
    }

if(($_GET['id'] == "") && ($_GET['formmethod'] == "GET")) {
  $sql = "SELECT * FROM names";
  $run = $conn->prepare($sql);
  $run->execute();
  $fetch = array();
  while($row = $run->fetch(PDO::FETCH_ASSOC)) {
    $fetch[] = $row;
  }
  echo json_encode($fetch);
}
elseif ((isset($_GET['id'])) && ($_GET['formmethod'] == "GET")) {

  $id = $_GET['id'];
  $sql = "SELECT * FROM names WHERE id='$id'";
  $run = $conn->prepare($sql);
  $run->execute();
  $rowcount = $run->rowCount();
  $fetch = array();

  if($rowcount < 1) {
    echo "Dit ID bestaat niet.";
  }
  else {
    while($row = $run->fetch(PDO::FETCH_ASSOC)) {
      $fetch['names'] = $row;
    }
    echo json_encode($fetch);
  }
}

elseif ($_GET['formmethod'] == "CREATE") {
  $sql = "INSERT INTO names (name, lastname, email) VALUES ('', '', '')";
  $create = $conn->prepare($sql);
  $create->execute();
  $sqlcreateshow = "SELECT * FROM names ORDER BY id DESC LIMIT 1";
  $showcreate = $conn->prepare($sqlcreateshow);
  $showcreate->execute();
  while($row = $showcreate->fetch(PDO::FETCH_ASSOC)) {
    $fetch['names'] = $row;
  }
  echo json_encode($fetch);  
  }

  elseif ($_GET['formmethod'] == "UPDATE") {
    $updateid = $_GET["id"];
    $naam = $_GET["naam"];
    $achternaam = $_GET["achternaam"];
    $email = $_GET["email"];
    $sql = "UPDATE names SET name='$naam', lastname='$achternaam', email='$email' WHERE id='$updateid'";
    $update = $conn->prepare($sql);
    $update->execute();
    $sqlupdateshow = "SELECT * FROM names WHERE id='$updateid'";
    $showupdate = $conn->prepare($sqlupdateshow);
    $showupdate->execute();
    while($row = $showupdate->fetch(PDO::FETCH_ASSOC)) {
      $fetch['names'] = $row;
    }
    echo json_encode($fetch); 
    }

    elseif ($_GET['formmethod'] == "DELETE") {
      $delrec = $_GET['id'];
      $sql = "DELETE FROM names WHERE id='$delrec'";
      $create = $conn->prepare($sql);
      $result = $create->execute();
      echo $result;      
    }

?>