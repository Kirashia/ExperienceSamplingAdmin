<?php
include("../Controller/qCreatorController.ini");
$id = $_POST["id"];
$qnr = $_POST["qnr"];

$qcc = new qCreatorController($qnr);


?>