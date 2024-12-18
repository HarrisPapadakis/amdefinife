<?php
include_once '../modules/vivliothiki.php';

$vivliothiki = new Vivliothiki($msqli);

echo json_encode($vivliothiki);
?>