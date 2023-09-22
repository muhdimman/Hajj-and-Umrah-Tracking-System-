<?php
    include("dbconnect.php");
    $query = "SELECT * FROM users WHERE user_type='user'";
    $result = mysqli_query($conn,$query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <table>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Name</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include('dbconnect.php');
                        if(mysqli_num_rows($result)>0){
                            $sn=1;
                            while($data = mysqli_fetch_assoc($result))
                    ?>
                    <tr>
                        <td><?php echo $data['id']?></td>
                        <td>Hello</td>
                        <th><button data-id="<?php echo $data['id'];?>"></button></th>
                    </tr>
                    <?php
                                                                            $sn++;}?>

                </tbody>
            </table>
        </div>
    </table>
</head>
<body>
    
</body>
</html>