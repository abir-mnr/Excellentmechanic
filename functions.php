<?php 
session_start();

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'multi_login');

// variable declaration
$username = "";
$address = "";
$phone = "";
$carnumber = "";
$carengineno = "";
$appointmentdate = "";
$mechanic = "";
$errors   = array(); 
$messages = array();
$read ="";

// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) {
	register();
}

if (isset($_POST['registerNew_btn'])) {
	registerNew();
}

// REGISTER USER
function register(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $username,$address,$phone,$carnumber,$carengineno,$appointmentdate,$mechanic;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$username    =  e($_POST['username']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);
	$address  =  e($_POST['address']);
	$phone  =  e($_POST['phone']);
	$carnumber  =  e($_POST['carnumber']);
	$carengineno  =  e($_POST['carengineno']);
	$appointmentdate  =  e($_POST['appointmentdate']);
	$mechanic  =  e($_POST['mechanic']);

	// form validation: ensure that the form is correctly filled
	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($password_1)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}
	if (usernameExists($username)){
		array_push($errors, "Username already exists");
	}if (mechanicEnrollment($mechanic,$appointmentdate)>=4){
		array_push($errors, "Mechanic has no empty slot for that day");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password_1);//encrypt the password before saving in the database

		if (isset($_POST['user_type'])) {
			$user_type = e($_POST['user_type']);
			$query = "INSERT INTO users (username, user_type, password,address,phone,carnumber,carengineno,appointmentdate,mechanic) 
					  VALUES('$username', '$user_type', '$password','$address','$phone','$carnumber','$carengineno','$appointmentdate','$mechanic')";
			mysqli_query($db, $query);
			$_SESSION['success']  = "New user successfully created!!";
			header('location: home.php');
		}else{
			$query = "INSERT INTO users (username,  user_type, password,address,phone,carnumber,carengineno,appointmentdate,mechanic) 
					  VALUES('$username', 'user', '$password','$address','$phone','$carnumber','$carengineno','$appointmentdate','$mechanic')";
			mysqli_query($db, $query);

			// get id of the created user
			$logged_in_user_id = mysqli_insert_id($db);

			$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			$_SESSION['success']  = "You are now logged in";
			header('location: index.php');				
		}
	}
}


function registerNew(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $username,$address,$phone,$carnumber,$carengineno,$appointmentdate,$mechanic;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$username    =  $_SESSION['user']['username'];
	$password_1  =  $_SESSION['user']['password'];
	$address  =  $_SESSION['user']['address'];
	$phone  =  $_SESSION['user']['phone'];
	$carnumber  =  e($_POST['carnumber']);
	$carengineno  =  e($_POST['carengineno']);
	$appointmentdate  =  e($_POST['appointmentdate']);
	$mechanic  =  e($_POST['mechanic']);

	// form validation: ensure that the form is correctly filled
	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}

	if (mechanicEnrollment($mechanic,$appointmentdate)>=4){
		array_push($errors, "Mechanic has no empty slot for that day");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {

		if (isset($_POST['user_type'])) {
			$user_type = e($_POST['user_type']);
			$query = "INSERT INTO users (username, user_type, password,address,phone,carnumber,carengineno,appointmentdate,mechanic) 
					  VALUES('$username', '$user_type', '$password','$address','$phone','$carnumber','$carengineno','$appointmentdate','$mechanic')";
			mysqli_query($db, $query);
			$_SESSION['success']  = "New user successfully created!!";
			header('location: home.php');
		}else{
			$query = "INSERT INTO users (username,  user_type, password,address,phone,carnumber,carengineno,appointmentdate,mechanic) 
					  VALUES('$username', 'user', '$password','$address','$phone','$carnumber','$carengineno','$appointmentdate','$mechanic')";
			mysqli_query($db, $query);

			// get id of the created user
			$logged_in_user_id = mysqli_insert_id($db);

			$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			$_SESSION['success']  = "You are now logged in";
			header('location: index.php');				
		}
	}
}

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
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}

function display_message() {
	global $messages;

	if (count($messages) > 0){
		echo '<div class="error success">';
			foreach ($messages as $message){
				echo $message .'<br>';
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

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}

if (isset($_POST['login_btn'])) {
	login();
}

// LOGIN USER
function login(){
	global $db, $username, $errors;

	// grap form values
	$username = e($_POST['username']);
	$password = e($_POST['password']);

	// make sure form is filled properly
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['user_type'] == 'admin') {

				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";
				header('location: admin/home.php');		  
			}else{
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";

				header('location: index.php');
			}
		}else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}



function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}


function select($query){
	global $db;
		$results = mysqli_query($db, $query);

	if($results->num_rows > 0){
		return $results;
	}else{
		return false;
	}
}

function update($query){
	global $db,$messages,$errors;
	$update_row = mysqli_query($db, $query);
	if($update_row){
		array_push($messages, "data updated successfully");
	}else{
		array_push($errors, "error updating data");
	}
}

function usernameExists($username){
	global $db;
	$query = "SELECT * FROM users WHERE username='$username'";
	$result = mysqli_query($db, $query);
	if (mysqli_num_rows($result) >= 1){
		return true;
	}else{
		return false;
	}
}


function mechanicEnrollment($mechanic,$appointmentdate){
	global $db;
	$query = "SELECT * FROM users WHERE mechanic='$mechanic' AND appointmentdate='$appointmentdate'";
	$result = mysqli_query($db,$query);
	return mysqli_num_rows($result);
}	