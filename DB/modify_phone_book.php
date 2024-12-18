<?php
	function insertPhoneBook($mysqli, $phone_book) {
		try {
			$mysqli->query("CALL insertPhoneBook('$phone_book[0]','$phone_book[1]','$phone_book[2]',$phone_book[3],'$phone_book[4]')");
		} catch (Exception $e) {
			session_start();
			$_SESSION['error'] = "insertPhoneBook:". $e->getMessage(). "<br>";
		}
	}

	try {
		$phone_book = array($_POST["lname"],$_POST["fname"],$_POST["address"],(int)$_POST["age"],$_POST["phone"]);
		$mysqli = mysqli_connect("localhost", "root","","my_db");
		insertPhoneBook($mysqli, $phone_book);
		mysqli_close($mysqli);

		include "main.php";
	} catch (Exception $e) {
		session_start();
		$_SESSION['error'] = "insertPhoneBook:". $e->getMessage(). "<br>";
	}
?>