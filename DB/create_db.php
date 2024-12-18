<?php
 	include "create_tables.php";
 	include "create_procedures.php";

	function createDB($db) {
		try {
			$mysqli = mysqli_connect("localhost", "root","");

			try {
				$mysqli->select_db($db);
			} catch (Exception $e) {
				try{
					$mysqli->query("CREATE DATABASE $db");
					echo "Created my_db<br>";
					try {
						$mysqli->select_db($db);
						createTables($mysqli);
						createProcedures($mysqli);
					} catch (Exception $e) {
						die ("createDB:". $e->getMessage(). "<br>");
					}
				} catch (Exception $e) {
					echo "createDB:". $e->getMessage(). "<br>";
				}
			}
		} catch (Exception $e) {
			echo "createDB:". $e->getMessage(). "<br>";
		}

		return $mysqli;
	}
?>