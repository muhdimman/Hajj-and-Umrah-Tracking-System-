<?php 

if(isset($_GET['user_delete'])){
	require('connect.db');

	// $id = $_POST['user_delete'];
	$id = $_GET['id'];
	$query = "DELETE FROM users WHERE id='$id'"; 
	$result = mysqli_query($con,$query);

	if($result)
	{
		$_SESSION['message'] = "User Successfully delete";
		header("Location : tables.php");
		exit(0);
	}
	else 
	{
		$_SESSION['message'] = "Something went wrong";
		header("Location : tables.php");
		exit(0);
	}
} 

?>
<script>
    window.location="tables.php";
</script>
