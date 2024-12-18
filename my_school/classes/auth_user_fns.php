<?php
	//get database connection
	require_once 'database_fns.php';

	//Define $myusername and $mypassword
	$myusername = $_REQUEST['user'];
	$mypassword = $_REQUEST['password'];

	//To prodect MySQL injection
	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);
	$myusername = mysqli_real_escape_string($msqli, $myusername);
	$mypassword = mysqli_real_escape_string($msqli, $mypassword);
	$sql = "SELECT * FROM $tbl_prosopiko WHERE username='$myusername' and password='$mypassword'";
	$result = mysqli_query($msqli, $sql);

	//Mysql_num_rows is counting table row 
	$count = mysqli_num_rows($result);
	mysqli_free_result($result);

	//If result matched $myusername and $mypassword, table row must be 1 row
	if ($count == 1){
		session_start();
		$_SESSION['myusername'] = $myusername;
		$_SESSION['mypassword'] = $mypassword;
		$_SESSION['valid_user'] = $myusername;
		header("Location: ../index.php");
	}
	//Tell user do someting else cuase you're not logged in
	else{
		echo 'Wrong Username and Password<br/>';
		echo 'You could not be logged in.<br/>';
		echo "<a href=\'../components/modules/forgot.php'>Forgot your password?</a><br/>";
		echo "<a href=\'../components/modules/register.php'>Create new account?</a><br/>";
	}
?>