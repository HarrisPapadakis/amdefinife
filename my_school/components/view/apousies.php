<?php
  include_once '../../header.php';
  include_once '../../nav.php';
  include_once '../modules/apousies.php';
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  Καθηγητής
  <select name="teacher">
    <?php foreach ($arr_teacher as $value) {
        if (!empty($value)){
          $teacher = json_decode($value);
          echo "<option value=". $teacher->id. ">". $teacher->teacher. "</option>";
        }
      }
    ?>
  </select>
  <br><br>
  Μαθητής
  <select name="student">
    <?php foreach ($arr_student as $value) {
        if (!empty($value)){
          $student = json_decode($value);
          echo "<option value=". $student->id. ">". $student->student. "</option>";
        }
      }
    ?>
  </select>
  <br><br>
  Μάθημα
  <select name="lesson">
    <?php foreach ($arr_lesson as $value) {
        if (!empty($value)){
          $lesson = json_decode($value);
          echo "<option value=". $lesson->id. ">". $lesson->title. "</option>";
        }
      }
    ?>
  </select>
  <br><br>
  Ημερομηνία Απουσίας: <input type="date" name="apousia_date">
  <br><br>
  <input type="submit" name="submit" value="Εισαγωγή">
  <button onclick="">Διόρθωση</button>
  <button onclick="">Διαγραφή</button>
</form>

<hr/>
<table border="1">
  <tr>
    <th>Καθηγητής</th>
    <th>Μαθητής</th>
    <th>Μάθημα</th>
    <th>Ημερομηνία</th>
  </tr>
  <?php foreach ($arr_apousies as $value) {
    if (!empty($value)) {
        $apousies = json_decode($value);
        echo "<tr onclick='myFunction(". $apousies->id. ")'>";
        echo "<td id=teacher_". $apousies->id. ">". $apousies->teacher. "</td>";
        echo "<td id=student_". $apousies->id. ">". $apousies->student. "</td>";
        echo "<td id=mathima_". $apousies->id. ">". $apousies->mathima. "</td>";
        echo "<td id=trans_date_". $apousies->id. ">". $apousies->trans_date. "</td>";
        echo "</tr>";
      }
    }
  ?>
</table>
<?php
  include_once '../../footer.php';
?>