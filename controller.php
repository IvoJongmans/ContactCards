<?php 


    $contacts_url = 'read.php';

    $contacts_json = file_get_contents($contacts_url);
    $contact_array = json_decode($contacts_json, true);
    echo $contact_array;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Controller</title>
</head>
<body>
    <form action="">
        <input type="text" name="name">
        <button type="submit">Search</button>
    </form>
</body>
</html>