
<?php 
session_start();

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'my_db');

// variable declaration
$username = "";
$email    = "";
$errors   = array(); 

// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) {
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $username, $email,$user_type;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$username    =  e($_POST['username']);
	$email       =  e($_POST['email']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);

	// form validation: ensure that the form is correctly filled
	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($email)) { 
		array_push($errors, "Email is required"); 
	}
	if (empty($password_1)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = ($password_1);//encrypt the password before saving in the database

		if (isset($_POST['user_type'])) {
			$user_type = e($_POST['user_type']);
			$query = "INSERT INTO users (username, email, user_type, password) 
					  VALUES('$username', '$email', '$user_type', '$password')";
			mysqli_query($db, $query);
			$_SESSION['success']  = "New user successfully created!!";
			header('location: home.php');
		}else{
			$query = "INSERT INTO users (username, email, user_type, password) 
					  VALUES('$username', '$email', 'user', '$password')";
			mysqli_query($db, $query);

			// get id of the created user
			$logged_in_user_id = mysqli_insert_id($db);

			$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			$_SESSION['success']  = "You are now logged in";
			echo "<script>window.location.href='./login.php';
				  			alert('successfully register');</script>";			
		}
	}
}

if(isset($_POST['register_btn_mutawif'])){


	$email =($_POST['email']);
	$username = ($_POST['username']);
	$password_1= ($_POST['password_1']);
	$password_2= ($_POST['password_2']);

	// form validation: ensure that the form is correctly filled
	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($email)) { 
		array_push($errors, "Email is required"); 
	}

	if (empty($password_1)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}

	$sql="SELECT * FROM mutawif WHERE (username='$username' or email='$email');";

      $res=mysqli_query($db,$sql);

      if (mysqli_num_rows($res) > 0) {	
        
        $row = mysqli_fetch_assoc($res);
        if($email==isset($row['email']))
        {
            array_push($errors,"email already exists");
        }
		if($username==isset($row['username']))
		{
			array_push($errors,"username  already exists");
		}
		}
	
	if(count($errors)==0)
	{
		$password = ($password_1);
		if(!empty($_POST['user_type'])) {
			$selected = $_POST['user_type'];
			$query = "INSERT INTO mutawif (username, email, user_type, password) 
						  VALUES('$username', '$email', '$selected', '$password')";
			$sql2 = mysqli_query($db, $query);
			if($sql2)
                {
					echo "<script>window.location.href='./mutawiflogin.php';
				  			alert('successfully register');</script>";
                }
                else
                {
                    echo "<script>alert('Failed to update');</script>";
                }
	
			
			// echo 'Done upload ';
			// echo '<script>alert("Your Acoount has been registered")</script>';
			
		} 

		
	}

	// //if no error 
	// if(count($error)==0){

	// }

}




// call the login() function if register_btn is clicked
if (isset($_POST['mutawiflogin_btn'])) {
	global $db, $email, $errors;

	// grap form values
	$email = e($_POST['email']);
	$password = e($_POST['password']);

	// make sure form is filled properly
	if (empty($email)) {
		array_push($errors, "Username is mutawif required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = ($password);

		$query = "SELECT * FROM mutawif WHERE email='$email' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user mutawif
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['user_type'] == 'mutawif') {
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";
				echo "<script>window.location.href='./mutawifhome.php';
				  			alert('successfully login');</script>";
					  
			}
			
		}else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}





// call the login() function if register_btn is clicked
if (isset($_POST['login_btn'])) {
	global $db, $email, $errors;

	// grap form values
	$email = e($_POST['email']);
	$password = e($_POST['password']);

	// make sure form is filled properly
	if (empty($email)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = ($password);

		$query = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['user_type'] == 'admin') {

				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";
				header('location: admin.php');		  
			}if($logged_in_user['user_type'] == 'user' || $logged_in_user['user_type'] == 'user1' ||  $logged_in_user['user_type'] == 'user2'){
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";

				header('location: home.php');
			}
			
			else{
				array_push($errors, "Your not user and admin");
			}
		}else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}

	if (isset($_POST['chooseuser'])) {
	
		$query = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['user_type'] == 'user1') {

				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";
				header('location: ./map/index.php');		  
			}if($logged_in_user['user_type'] == 'user'){
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";
				header('location: home.php');
			}
			
			else{
				array_push($errors, "Your not user and admin");
			}
		}else {
			array_push($errors, "Wrong username/password combination");
		}
	}


    //if user click continue button in forgot password form
    if(isset($_POST['check-email'])){
		include('dbconnect.php');
		
		$password =($_POST['password']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $check_email = "SELECT * FROM users WHERE email='$email'";
        $run_sql = mysqli_query($conn, $check_email);

		// make sure form is filled properly
		if (empty($email)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}
		
        if(mysqli_num_rows($run_sql) > 0){
            $insert_code = "UPDATE users SET password='$password' WHERE email = '$email'";
            $run_query =  mysqli_query($conn, $insert_code);
			echo "<script>window.location.href='./login.php';
				  			alert('successfully Change');</script>";
        }else{
            $errors['email'] = "This email address does not exist!";
        }
    }

   //if login now button click
    if(isset($_POST['login-now'])){
        header('Location: login-user.php');
    }
	
                        //if user click continue button in forgot password form
                        if(isset($_POST['check-emailmutaw'])){
                            include('dbconnect.php');
                            
                            $password =($_POST['password']);
                            $email = mysqli_real_escape_string($conn, $_POST['email']);
                            $check_email = "SELECT * FROM mutawif WHERE email='$email'";
                            $run_sql = mysqli_query($conn, $check_email);

                            // make sure form is filled properly
                            if (empty($email)) {
                                array_push($errors, "Username is required");
                            }
                            if (empty($password)) {
                                array_push($errors, "Password is required");
                            }
                            
                            if(mysqli_num_rows($run_sql) > 0){
                                $insert_code = "UPDATE mutawif SET password='$password' WHERE email = '$email'";
                                $run_query =  mysqli_query($conn, $insert_code);
                                echo "<script>window.location.href='./mutawiflogin.php';
                                                alert('successfully Change');</script>";
                            }else{
                                $errors['email'] = "This email address does not exist!";
                            }
                        }


// log user out if logout button clicked
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}

// if(isset($_GET['user_delete'])){
// 	require('connect.db');

// 	// $id = $_POST['user_delete'];
// 	$id = $_GET['id'];
// 	$query = "DELETE FROM users WHERE id='$id'"; 
// 	$result = mysqli_query($con,$query);

// 	if($result)
// 	{
// 		$_SESSION['message'] = "User Successfully delete";
// 		header("Location : tables.php");
// 		exit(0);
// 	}
// 	else 
// 	{
// 		$_SESSION['message'] = "Something went wrong";
// 		header("Location : tables.php");
// 		exit(0);
// 	}
// }

// return user array from their id
function getUserById($id){
	global $db;
	$query = "SELECT * FROM users WHERE id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div >';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}

function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}

// ...
function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}

