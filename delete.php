<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        session_start();
        
        $user_id =  $_GET["user_id"];

        echo $user_id;
        $mutawwif = $_SESSION['user']['id'];
        include 'dbconnect.php';
        $sql = "UPDATE users SET mutawif_id=0  WHERE id=$user_id";

        if ($conn->query($sql) === TRUE) {
        header('Location: /fyp/fyp/addpilgrims.php');;
        } else {
        echo "Error updating record: " . $conn->error;
        }

        $conn->close();
            
    ?>
</head>