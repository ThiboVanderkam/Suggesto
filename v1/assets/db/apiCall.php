<?php
include "apiClass.php";

$api = new Api();
$output = $api->selectCall($_GET);
var_dump($output);
?>