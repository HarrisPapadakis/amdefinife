<?php
require_once '../../classes/database_fns.php';

class Vivliothiki {
	private $id;
	private $category;
	private $title;
	private $isbn;
	private $rent;
	private $back;

	private function insert($msqli) {
	    if (!empty($_POST["category"])) {
	      $this->category = $_POST["category"];
	      $this->title = $_POST["title"];
	      $this->isbn = $_POST["isbn"];
	      $this->rent = $_POST["rent"];
	      $this->back = $_POST["back"];
	      $sql = "INSERT INTO vivliothiki(category,title,isbn,rent,back) VALUES($this->category,'$this->title','$this->isbn','$this->rent','$this->back')";

	      mysqli_query($msqli, $sql);
	  	}
	}

	private function update($msqli) {
		$this->id = $_POST['id'];
		$this->category = $_POST['category'];
		$this->title = $_POST['title'];
		$this->isbn = $_POST['isbn'];
		$this->rent = $_POST['rent'];
		$this->back = $_POST['back'];
		$sql = "UPDATE vivliothiki SET category=$this->category, title='$this->title', isbn='$this->isbn', rent='$this->rent', back='$this->back' WHERE id=$this->id";

		mysqli_query($msqli, $sql);
	}

	private function delete($msqli) {
		$this->id = $_POST['id'];
		$sql = "DELETE FROM vivliothiki WHERE id=$this->id";

		mysqli_query($msqli, $sql);
	}

	function __construct($msqli){
		$action = $_POST["action"];
		if ($action == 1) $this->insert($msqli);
		if ($action == 2) $this->update($msqli);
		if ($action == 3) $this->delete($msqli);
	}

	public function getInfo(){
		$json = array(
				"title" => $this->title,
				"isbn" => $this->isbn,
				"rent" => $this->rent,
				"back" => $this->back,
				"category" => ($this->category == 1) ? 'Ψυχολογία' : (($this->category == 2) ? 'Μαθηματικά' : (($this->category == 3) ? 'Φυσικές Επιστήμες' : ""))
			);
		return json_encode($json);
	}

	public static function getData($msqli, $tbl_vivliothiki) {
		$arr[] = array();

		$sql = "SELECT * FROM $tbl_vivliothiki";
		$result = mysqli_query($msqli, $sql);
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			$json = array(
				"id" => $row['id'],
				"title" => $row['title'],
				"isbn" => $row['isbn'],
				"rent" => $row['rent'],
				"back" => $row['back'],
				"category" => ($row['category'] == 1) ? 'Ψυχολογία' : (($row['category'] == 2) ? 'Μαθηματικά' : (($row['category'] == 3) ? 'Φυσικές Επιστήμες' : ""))
			);
			array_push($arr, json_encode($json));
		}
		mysqli_free_result($result);

		return $arr;
	}
}
?>