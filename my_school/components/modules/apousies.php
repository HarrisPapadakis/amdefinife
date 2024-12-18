<?php
require_once '../../classes/database_fns.php';

class Teacher {
  private $id;
  private $name;
  private $surname;

  function getID() {
    return $this->id;
  }

  function getName(){
    return $this->name;
  }

  function getSurname(){
    return $this->surname;
  }

  function setID($id) {
    $this->id = $id;
  }

  function setName($name){
    $this->name = $name;
  }

  function setSurname($surname){
    $this->surname = $surname;
  }

  public function toJSON(){
    $json = array(
        "id" => $this->getID(),
        "teacher" => $this->getSurname(). " ". $this->getName()
    );

    return json_encode($json);
  }
}

class Student {
  private $id;
  private $name;
  private $surname;

  function getID() {
    return $this->id;
  }

  function getName(){
    return $this->name;
  }

  function getSurname(){
    return $this->surname;
  }

  function setID($id) {
    $this->id = $id;
  }

  function setName($name){
    $this->name = $name;
  }

  function setSurname($surname){
    $this->surname = $surname;
  }

  public function toJSON(){
    $json = array(
        "id" => $this->getID(),
        "student" => $this->getSurname(). " ". $this->getName()
    );

    return json_encode($json);
  }
}

class Lesson {
  private $id;
  private $title;

  function getID() {
    return $this->id;
  }

  function getTitle(){
    return $this->title;
  }

  function setID($id) {
    $this->id = $id;
  }

  function setTitle($title){
    $this->title = $title;
  }

  public function toJSON(){
    $json = array(
        "id" => $this->getID(),
        "title" => $this->getTitle()
    );

    return json_encode($json);
  }
}

class Apousies{
  private $id;
  private $teacher;
  private $student;
  private $mathima;
  private $trans_date;

  private function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
  }

  function __construct($msqli){
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["apousia_date"])) {
      $this->mathima = $this->test_input($_POST["lesson"]);
      $this->teacher = $this->test_input($_POST["teacher"]);
      $this->student = $this->test_input($_POST["student"]);
      $this->trans_date = $this->test_input($_POST["apousia_date"]);

      $sql = "INSERT INTO dioik_apousies(math_id,pro_reg_id,pro_res_id,trans_date) VALUES($this->mathima,$this->teacher,$this->student,'$this->trans_date')";
      mysqli_query($msqli, $sql);
    }
  }

  function getID(){
    return $this->id;
  }

  function getMathima(){
    return $this->mathima;
  }

  function getTeacher(){
    return $this->teacher;
  }

  function getStudent(){
    return $this->student;
  }

  function getTransDate(){
    return $this->trans_date;
  }

  function setID($id){
    $this->id = $id;
  }
  
  function setMathima($mathima){
    $this->mathima = $mathima;
  }

  function setTeacher($teacher){
    $this->teacher = $teacher;
  }

  function setStudent($student){
    $this->student = $student;
  }

  function setTransDate($trans_date){
    $this->trans_date = $trans_date;
  }

  public function toJSON(){
    $json = array(
        "id" => $this->getID(),
        "mathima" => $this->getMathima(),
        "teacher" => $this->getTeacher(),
        "student" => $this->getStudent(),
        "trans_date" => $this->getTransDate()
    );

    return json_encode($json);
  }
}

$teacher = new Teacher();
$arr_teacher[] = array();
$student = new Student();
$arr_student[] = array();
$lesson = new Lesson();
$arr_lesson[] = array();
$apousies = new Apousies($msqli);
$arr_apousies[] = array();

$sql = "SELECT * FROM $tbl_prosopiko WHERE type=2";
$result = mysqli_query($msqli, $sql);
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
  $teacher->setName($row['NAME']);
  $teacher->setSurname($row['SURNAME']);
  $teacher->setID($row['ID']);
  array_push($arr_teacher, $teacher->toJSON());
}
$sql = "SELECT * FROM $tbl_prosopiko where type=3";
$result = mysqli_query($msqli, $sql);
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
  $student->setName($row['NAME']);
  $student->setSurname($row['SURNAME']);
  $student->setID($row['ID']);
  array_push($arr_student, $student->toJSON());
}
$sql = "SELECT * FROM $tbl_mathima";
$result = mysqli_query($msqli, $sql);
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
  $lesson->setTitle($row['TITLE']);
  $lesson->setID($row['ID']);
  array_push($arr_lesson, $lesson->toJSON());
}
$sql = "call getApousies()";
$result = mysqli_query($msqli, $sql);
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
  $apousies->setID($row['id']);
  $apousies->setTeacher($row['Teacher']);
  $apousies->setStudent($row['Student']);
  $apousies->setMathima($row['Lesson']);
  $apousies->setTransDate($row['TRANS_DATE']);
  array_push($arr_apousies, $apousies->toJSON());
}

mysqli_free_result($result);
?>