<?php
	session_start();
	//Unless they are an admin and logged in, don't let them see this page.
	if ($_SESSION["loggedIn"] != "yes" OR $_SESSION["isAdmin"] == "no") {
		header("location: https://experiencesampling.co.uk/LoginAndRegister/LoginAndRegister19_04_18/Login.php");
	}
	else {
		header("location: https://experiencesampling.co.uk/LoginAndRegister/LoginAndRegister19_04_18/AdminIndex.php");
	}

/* session_start();
$_SESSION["c"]++; */
include("../Controller/qCreatorController.ini");

$qnrName = $_GET["qnrName"];
$qCreatorController = new qCreatorController($qnrName);

$qD = $qCreatorController -> removeMCAnswers($_GET["id"]);
$rD = $qCreatorController -> removeQ($_GET["id"]);

/* if ($_SESSION["c"] > 10){
	//echo $_SESSION["c"];
} */

if ($qD and $rD)
{
	echo "qCreatorView.php?name=".$qnrName;
	//header("Location: qCreatorView.php?name=".$qnrName);
	//die();
}
?>