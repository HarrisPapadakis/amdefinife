<?php
  include_once '../../header.php';
  include_once '../../nav.php';
  include_once '../modules/prosopiko.php';
?>

<form>
  <input type="text" id="id" name="id" style="display: none;">
  Είδος:
  <input type="radio" name="eidos" id="eidos__1" value="1">Γραμματεία
  <input type="radio" name="eidos" id="eidos__2" value="2">Καθηγητής
  <input type="radio" name="eidos" id="eidos__3" value="3">Μαθητής
  <br><br>
  Όνομα: <input type="text" name="name" id="name">
  <br><br>
  Επίθετο: <input type="text" name="surname" id="surname">
  <br><br>
  Τηλέφωνο: <input type="text" name="phone"  id="phone">
  <br><br>
  Χρήστης: <input type="text" name="username" id="username">
  <br><br>
  Κωδικός: <input type="Password" name="password" id="password">
  <br><br>
  Επανάληψη Κωδικού: <input type="Password" name="repeat_password" id="repeat_password">
  <br><br>
  <button onclick="return _insert();">Εισαγωγή</button>
  <button onclick="return _update();">Διόρθωση</button>
  <button onclick="return _delete();">Διαγραφή</button>
</form>

<hr/>
<table border="1">
  <tr>
    <th>Type</th>
    <th>Name</th>
    <th>Surname</th>
    <th>Phone</th>
  </tr>

  <?php
    $arr_prosopiko = Prosopiko::getData($msqli, $tbl_prosopiko);

    foreach ($arr_prosopiko as $value) {
      if (!empty($value)) {
        $prosopiko = json_decode($value);
        echo "<tr onclick='connectFormTable(". $prosopiko->id. ")'>";
        echo "<td id=eidos_". $prosopiko->id. ">". $prosopiko->eidos. "</td>";
        echo "<td id=surname_". $prosopiko->id. ">". $prosopiko->surname. "</td>";
        echo "<td id=name_". $prosopiko->id. ">". $prosopiko->name. "</td>";
        echo "<td id=phone_". $prosopiko->id. ">". $prosopiko->phone. "</td>";
        echo "</tr>";
      }
    }
  ?>
</table>
<script>
  function connectFormTable(id) {
    //Ανάκτηση δεδομενών από τις γραμμές του πίνακα
    var eidos = document.getElementById('eidos_' + id).innerText;
    var name = document.getElementById('name_' + id).innerText;
    var surname = document.getElementById('surname_' + id).innerText;
    var phone = document.getElementById('phone_' + id).innerText;

    //Φόρτωση των παραπάνω δεδομενών στην φόρμα
    document.getElementById('id').value = id;
    document.getElementById('name').value = name;
    document.getElementById('surname').value = surname;
    document.getElementById('phone').value = phone;
    if (eidos == 'Γραμματεία') document.getElementById('eidos__1').checked = true;
    if (eidos == 'Καθηγητής') document.getElementById('eidos__2').checked = true;
    if (eidos == 'Μαθητής') document.getElementById('eidos__3').checked = true;
  }

  function _insert() {
    //Ανάκτηση δεδομένων από την φόρμα
    var password = $('#password').val();
    var repeat_password = $('#repeat_password').val();

    if (password != repeat_password) {
      alert("The password is wrong");
      location.reload();
    }
    var eidos = $('#eidos__1').is(":checked") == true ? 1 : ($('#eidos__2').is(":checked") == true ? 2 : 3);
    var name = $('#name').val();
    var surname = $('#surname').val();
    var phone = $('#phone').val();
    var username = $('#username').val();

    //Αποστολή των δεδομένων για αποθήκευση
    $.ajax({
        type: "POST",
        url: "/my_school/components/modules/prosopiko_actions.php",
        data: {
          eidos:eidos,
          name:name,
          surname:surname,
          phone:phone,
          username:username,
          password:password,
          action:1
        },
        dataType: "json",
        success: function(data) {
          location.reload();
        },
        error: function(xhr, status, error) {
            alert(error);
        }
    });

    //Επιστροφή στην σελίδα χωρίς ανανέωση αυτής
    return false;
  }

  function _update() {
    //Ανάκτηση δεδομένων από την φόρμα
    var id = $('#id').val();
    var eidos = $('#eidos__1').is(":checked") == true ? 1 : ($('#eidos__2').is(":checked") == true ? 2 : 3);
    var name = $('#name').val();
    var surname = $('#surname').val();
    var phone = $('#phone').val();
    
    //Αποστολή των δεδομένων για αποθήκευση
    $.ajax({
        type: "POST",
        url: "/my_school/components/modules/prosopiko_actions.php",
        data: {
          id:id,
          eidos:eidos,
          name:name,
          surname:surname,
          phone:phone,
          action:2
        },
        dataType: "json",
        success: function(data) {
          location.reload();
        },
        error: function(xhr, status, error) {
            alert(error);
        }
    });

    //Επιστροφή στην σελίδα χωρίς ανανέωση αυτής
    return false;
  }
  function _delete(){
    var id = $('#id').val();
    
    $.ajax({
        type: "POST",
        url: "/my_school/components/modules/prosopiko_actions.php",
        data: {
          id:id,
          action:3
        },
        dataType: "json",
        success: function(data) {
          location.reload();
        },
        error: function(xhr, status, error) {
            alert(xhr);
        }
    });

    return false;
  }
</script>

<?php
  include_once '../../footer.php';
?>