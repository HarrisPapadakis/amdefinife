<table border="1">
  <tr>
    <th>Last Name</th>
    <th>First Name</th>
    <th>Address</th>
    <th>Age</th>
    <th>Phone</th>
  </tr>
  <?php
    include "select.php";

    try {
      $mysqli = mysqli_connect("localhost", "root","","my_db");
      $arr_phone_books = getPhoneBook($mysqli);
      foreach ($arr_phone_books as $value) {
        if (!empty($value)) {
          $phone_book = new PhoneBook();
          $phone_book = json_decode($value);
          echo "<tr>";
          echo "<td id=lastname_". $phone_book->id. ">". $phone_book->lastname. "</td>";
          echo "<td id=firstname_". $phone_book->id. ">". $phone_book->firstname. "</td>";
          echo "<td id=address_". $phone_book->id. ">". $phone_book->address. "</td>";
          echo "<td id=age_". $phone_book->id. ">". $phone_book->age. "</td>";
          echo "<td id=phone_". $phone_book->id. ">". $phone_book->phone. "</td>";
          echo "</tr>";
        }
      }
      mysqli_close($mysqli);
    } catch (Exception $e) {
      echo "Select:". $e->getMessage(). "<br>";
    }
  ?>
</table>