<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <button class="btn" name="test_button"><a
                                                class="btn btn-primary btn-user btn-block">
                                                Login
                                            </a>
                                        </button>

    <?php
        session_start();
        include 'dbconnect.php';
         if (isset($_SESSION['test_button']))
            $user_type =['user_type'];
            $result=mysqli_query($conn,"SELECT * FROM users ");
                    
                    if ($user_type ='user1') {
                        header('Location: /fyp//fyp/home.php');
                    }
                    else
                    {
                        header('Location: /fyp//fyp/login.php');
                    }
                                                            
        $conn->close();

    ?>
</head>