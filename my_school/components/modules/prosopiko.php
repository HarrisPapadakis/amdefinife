<?php
require_once '../../classes/database_fns.php';

class Prosopiko {
  private $id;
  private $eidos;
  private $name;
  private $surname;
  private $phone;
  private $username;
  private $password;

  private function insert($msqli) {
    if (!empty($_POST["eidos"])) {
      $this->eidos = $_POST["eidos"];
      $this->name = $_POST["name"];
      $this->surname = $_POST["surname"];
      $this->phone = $_POST["phone"];
      $this->username = $_POST["username"];
      $this->password = $_POST["password"];
      $sql = "INSERT INTO prosopiko(type,surname,name,phone,username,password) VALUES($this->eidos,'$this->surname','$this->name','$this->phone','$this->username','$this->password')";

      mysqli_query($msqli, $sql);
    }
  }

  private function update($msqli) {
    $this->id = $_POST['id'];
    $this->eidos = $_POST['eidos'];
    $this->name = $_POST['name'];
    $this->surname = $_POST['surname'];
    $this->phone = $_POST['phone'];
    $sql = "UPDATE prosopiko SET type=$this->eidos, surname='$this->surname', name='$this->name', phone='$this->phone' WHERE id=$this->id";

    mysqli_query($msqli, $sql);
  }

  private function delete($msqli) {
    $this->id = $_POST['id'];
    $sql = "DELETE FROM prosopiko WHERE id=$this->id";

    mysqli_query($msqli, $sql);
  }

  function __construct($msqli){
    $action = $_POST["action"];
    if ($action == 1) $this->insert($msqli);
    if ($action == 2) $this->update($msqli);
    if ($action == 3) $this->delete($msqli);
  }

  function getID() {
    return $this->id;
  }

  function getEidos(){
    return $this->eidos;
  }

  function getName(){
    return $this->name;
  }

  function getSurname(){
    return $this->surname;
  }

  function getPhone(){
    return $this->phone;
  }

  function setID($id) {
    $this->id = $id;
  }

  function setEidos($eidos){
    $this->eidos = $eidos;
  }

  function setName($name){
    $this->name = $name;
  }

  function setSurname($surname){
    $this->surname = $surname;
  }

  function setPhone($phone){
    $this->phone = $phone;
  }

  public static function getData($msqli, $tbl_prosopiko) {
    $arr_prosopiko[] = array();

    $sql = "SELECT * FROM $tbl_prosopiko";
    $result = mysqli_query($msqli, $sql);
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $json = array(
        "id" => $row['ID'],
        "name" => $row['NAME'],
        "surname" => $row['SURNAME'],
        "phone" => $row['PHONE'],
        "eidos" => ($row['TYPE'] == 1) ? 'Γραμματεία' : (($row['TYPE'] == 2) ? 'Καθηγητής' : (($row['TYPE'] == 3) ? 'Μαθητής' : ""))
      );
      array_push($arr_prosopiko, json_encode($json));
    }
    mysqli_free_result($result);

    return $arr_prosopiko;
  }
}
?>
