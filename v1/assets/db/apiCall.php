<?php
include "apiClass.php";

$api = new Api();
$output = $api->selectCall($_GET)
echo json_encode($output)
?>