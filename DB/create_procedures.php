<?php
	function createProcedures($mysqli) {
		try {
			$mysqli->query("
				CREATE PROCEDURE insertPhoneBook(in _lastname varchar(255), in _firstname varchar(255), in _address varchar(255), in _age tinyint, in _phone char(10))
				BEGIN
					insert into phone_book(lastname, firstname, address, age, phone) VALUES(_lastname, _firstname, _address, _age, _phone);
				END");
				echo "Created procedure insertPhoneBook<br>";
			$mysqli->query("
				CREATE PROCEDURE getPhoneBooks()
				BEGIN
					select * from phone_book;
				END");
				echo "Created procedure insertPhoneBook<br>";
		} catch (Exception $e) {
			echo "createProcedures:". $e->getMessage(). "<br>";
		}
	}
?>