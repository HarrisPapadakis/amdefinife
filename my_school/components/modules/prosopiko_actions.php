<?php
include_once '../modules/prosopiko.php';

$prosopiko = new Prosopiko($msqli);

echo json_encode($prosopiko);
?>