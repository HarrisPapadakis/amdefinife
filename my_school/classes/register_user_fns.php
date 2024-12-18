<?php
	//get database connection
	require_once 'database_fns.php';

	$type = $_POST['type'];
	$surname = $_POST['surname'];
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$username = $_POST['user'];
	$password = $_POST['password'];

	//To prodect MySQL injection
	$surname = stripslashes($surname);
	$name = stripslashes($name);
	$phone = stripslashes($phone);
	$username = stripslashes($username);
	$password = stripslashes($password);
	$surname =  mysqli_real_escape_string($msqli, $surname);
	$name =  mysqli_real_escape_string($msqli, $name);
	$phone =  mysqli_real_escape_string($msqli, $phone);
	$username = mysqli_real_escape_string($msqli, $username);
	$password = mysqli_real_escape_string($msqli, $password);
	$sql = "INSERT INTO $tbl_prosopiko(type,surname,name,phone,username,password) VALUES($type,'$surname','$name','$phone','$username','$password')";
	$result = mysqli_query($msqli, $sql);
	header("Location: ..\components\modules\login.php");
?>