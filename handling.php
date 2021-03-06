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

if(($_GET['formmethod'] == "GET")) {
  if(($_GET['name'] == "") && ($_GET['lastname'] == "") && ((!isset($_GET['id'])))) {
  $sql = "SELECT * FROM names";
  $run = $conn->prepare($sql);
  $run->execute();
  $fetch = array();
  while($row = $run->fetch(PDO::FETCH_ASSOC)) {
    $fetch[] = $row;
  }
  echo json_encode($fetch);
  }


  elseif ((isset($_GET['name'])) && ($_GET['formmethod'] == "GET")) {

  $name = $_GET['name'];
  $name = "%".$name."%";
  $lastname = $_GET['lastname'];
  $lastname = "%".$lastname."%";
  $sql = "SELECT * FROM names WHERE name LIKE :myname OR lastname LIKE :mylastname "; //OR lastname LIKE '%$lastname%'
  $search = $conn->prepare($sql);
  $search->bindParam(':myname', $name);
  $search->bindParam(':mylastname', $lastname);
  $search->execute(); 
  $rowcount = $search->rowCount();
  $fetch = array();
  while($row = $search->fetch(PDO::FETCH_ASSOC)) {
  $fetch[] = $row;
  }
  echo json_encode($fetch);
  }
}

elseif ($_GET['formmethod'] == "EDIT") {
  $editid = $_GET['id'];
  $sql = "SELECT * FROM names WHERE id=:id";
  $run = $conn->prepare($sql);
  $run->bindParam(':id', $editid);
  $run->execute();
  $fetch = array();
  while($row = $run->fetch(PDO::FETCH_ASSOC)) {
    $fetch = $row;
  }
  echo json_encode($fetch);
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
    $sql = "UPDATE names SET name=:uname, lastname=:ulastname, email=:uemail WHERE id=:upid";
    $update = $conn->prepare($sql);
    $update->bindParam(':upid', $updateid);
    $update->bindParam(':uemail', $email);
    $update->bindParam(':ulastname', $achternaam);
    $update->bindParam(':uname', $naam);
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
      $sql = "DELETE FROM names WHERE id=:delid";
      $delete = $conn->prepare($sql);
      $delete->bindParam(':delid', $delrec);
      $delete->execute(); 
      $rc = $delete->rowCount();
      if($rc == 1) {
        $result = 1;
        echo $result;
      }   
      else {
        $result = $rc;
        echo $rc;
      }
    }

?>