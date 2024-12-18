<?php
include_once '../modules/parapona.php';

$parapona = new Parapona($msqli);

echo json_encode($parapona);
?>