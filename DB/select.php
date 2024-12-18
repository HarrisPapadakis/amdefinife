<?php
	class PhoneBook {
      private $id;
      private $lastname;
      private $firstname;
      private $address;
      private $age;
      private $phone;

      function getID() {
      	return $this->id;
      }

      function getLastname() {
      	return $this->lastname;
      }

      function getFirstname() {
      	return $this->firstname;
      }

      function getAddress() {
      	return $this->address;
      }

      function getAge() {
      	return $this->age;
      }

      function getPhone() {
      	return $this->phone;
      }
    }

	function getPhoneBook($mysqli){
		$results = $mysqli->query("SELECT * FROM phone_book");

		$arr_phone_books = array();
		while ($row = $results->fetch_array(MYSQLI_ASSOC)) {
			$json = array(
				"id" => $row['ID'],
				"lastname" => $row['LASTNAME'],
				"firstname" => $row['FIRSTNAME'],
				"address" => $row['ADDRESS'],
				"age" => $row['AGE'],
				"phone" => $row['PHONE']);
			array_push($arr_phone_books, json_encode($json));
		}
		mysqli_free_result($results);

		return $arr_phone_books;
	}
?>