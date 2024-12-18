<?php
require_once '../../classes/database_fns.php';

class Parapona {
  private $id;
  private $full_name;
  private $title;
  private $message;
  private $date;

  private function insert($msqli) {
    if (!empty($_POST["prosopiko"])) {
      $this->title = $_POST["title"];
      $this->prosopiko = $_POST["prosopiko"];
      $this->message = $_POST["message"];
      $this->date = $_POST["date_trans"];
      $sql = "call insertParapona($this->prosopiko,$this->title,$this->message,$this->date)";

      mysqli_query($msqli, $sql);
    }
  }

  private function update($msqli) {
    $this->id = $_POST['id'];
    $this->title = $_POST["title"];
    $this->prosopiko = $_POST["prosopiko"];
    $this->message = $_POST["message"];
    $this->date = $_POST["date"];
    $sql = "call updateParapona($this->prosopiko,$this->title,$this->message,$this->date,$this->id)";

    mysqli_query($msqli, $sql);
  }

  private function delete($msqli) {
    $this->id = $_POST['id'];
    $sql = "call deleteParapona($this->id)";

    mysqli_query($msqli, $sql);
  }

  function __construct($msqli){
    $action = $_POST["action"];
    if ($action == 1) $this->insert($msqli);
    if ($action == 2) $this->update($msqli);
    if ($action == 3) $this->delete($msqli);
  }

  public static function getData($msqli) {
    $arr_parapona[] = array();

    $sql = "call getParapona()";
    $result = mysqli_query($msqli, $sql);
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $json = array(
        "id" => $row['id'],
        "full_name" => $row['full_name'],
        "title" => $row['title'],
        "message" => $row['message'],
        "date" => $row['date_trans']
      );
      array_push($arr_parapona, json_encode($json));
    }
    mysqli_free_result($result);

    return $arr_parapona;
  }

  public static function getProsopiko($msqli){
    $arr_prosopiko[] = array();

    $sql = "SELECT id,surname,name FROM prosopiko";
    $result = mysqli_query($msqli, $sql);
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $json = array(
        "id" => $row['id'],
        "full_name" => $row['surname']. " ". $row['name']
      );
      array_push($arr_prosopiko, json_encode($json));
    }
    mysqli_free_result($result);

    return $arr_prosopiko;
  }
}
?>
