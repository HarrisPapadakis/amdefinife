<?php
	function createTables($mysqli) {
		try {
			$mysqli->query("
				CREATE TABLE PHONE_BOOK(
					ID INT PRIMARY KEY AUTO_INCREMENT,
					LASTNAME NVARCHAR(20) not null,
					FIRSTNAME NVARCHAR(50) not null,
					ADDRESS NVARCHAR(255),
					AGE TINYINT not null,
					PHONE CHAR(10) not null,
					UNIQUE INDEX IDX_PHONE_BOOK(
						LASTNAME,
						FIRSTNAME,
						PHONE
					))");
				echo "Created table PHONE_BOOK<br>";
		} catch (Exception $e) {
			echo "createTables:". $e->getMessage(). "<br>";
		}
	}
?>