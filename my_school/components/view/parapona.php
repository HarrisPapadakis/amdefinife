<?php
  include_once '../../header.php';
  include_once '../../nav.php';
  include_once '../modules/parapona.php';
?>
<form>
  <input type="text" id="id" name="id" style="display: none;">
  Προσωπικό
  <select name="prosopiko" id="prosopiko">
    <?php
      $arr_prosopiko = Parapona::getProsopiko($msqli);

      foreach ($arr_prosopiko as $value) {
        if (!empty($value)){
          $prosopiko = json_decode($value);
          echo "<option value=". $prosopiko->id. ">". $prosopiko->full_name. "</option>";
        }
      }
    ?>
  </select>
  <br><br>
  Τίτλος: <input type="text" name="title" id="title">
  <br><br>
  Ημερομηνία Παραπόνων: <input type="date" name="parapona_date" id="parapona_date">
  <br><br>
  Περιγραφή:<br>
  <textarea rows="4" cols="50" name="message" id="message"></textarea>
  <br><br>
  <button onclick="return _insert();">Εισαγωγή</button>
  <button onclick="return _update();">Διόρθωση</button>
  <button onclick="return _delete();">Διαγραφή</button>
</form>

<hr/>
<table border="1">
  <tr>
    <th>Προσωπικό</th>
    <th>Τίτλος</th>
    <th>Μήνυμα</th>
    <th>Ημερομηνία</th>
  </tr>
  <?php
    $arr_parapona = Parapona::getData($msqli);

    foreach ($arr_parapona as $value) {
      if (!empty($value)) {
          $parapona = json_decode($value);
          echo "<tr onclick='myFunction(". $parapona->id. ")'>";
          echo "<td id=prosopiko_". $parapona->id. ">". $parapona->full_name. "</td>";
          echo "<td id=title_". $parapona->id. ">". $parapona->title. "</td>";
          echo "<td id=message_". $parapona->id. ">". $parapona->message. "</td>";
          echo "<td id=trans_date_". $parapona->id. ">". $parapona->date. "</td>";
          echo "</tr>";
        }
    }
  ?>
</table>
<script>
  function myFunction(id) {
    //Ανάκτηση δεδομενών από τις γραμμές του πίνακα
    var prosopiko = document.getElementById('prosopiko_' + id).innerText;
    var title = document.getElementById('title_' + id).innerText;
    var message = document.getElementById('message_' + id).innerText;
    var date_trans = document.getElementById('date_trans' + id).innerText;

    //Φόρτωση των παραπάνω δεδομενών στην φόρμα
    document.getElementById('id').value = id;
    document.getElementById('prosopiko').value = prosopiko;
    document.getElementById('title').value = title;
    document.getElementById('message').value = message;
    document.getElementById('parapona_date').value = date_trans;
  }

  function _insert() {
    //Ανάκτηση δεδομένων από την φόρμα
    var prosopiko = $('#prosopiko').val();
    var title = $('#title').val();
    var message = $('#message').val();
    var date_trans = $('#parapona_date').val();

    //Αποστολή των δεδομένων για αποθήκευση
    $.ajax({
        type: "POST",
        url: "/my_school/components/modules/parapona_actions.php",
        data: {
          prosopiko:prosopiko,
          title:title,
          message:message,
          date_trans:date_trans,
          action:1
        },
        //dataType: "json",
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
    var prosopiko = $('#prosopiko');;
    var title = $('#title').val();
    var message = $('#message').val();
    var date_trans = $('#parapona_date').val();
    
    //Αποστολή των δεδομένων για αποθήκευση
    $.ajax({
        type: "POST",
        url: "/my_school/components/modules/parapona_actions.php",
        data: {
          id:id,
          prosopiko:prosopiko,
          title:title,
          message:message,
          date_trans:date_trans,
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
        url: "/my_school/components/modules/parapona_actions.php",
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