<?php
	session_start();
	//Unless they are an admin and logged in, don't let them see this page.
	if ($_SESSION["loggedIn"] != "yes" OR $_SESSION["isAdmin"] == "no") {
		header("location: https://experiencesampling.co.uk/LoginAndRegister/LoginAndRegister19_04_18/Login.php");
	}
	else {
		header("location: https://experiencesampling.co.uk/LoginAndRegister/LoginAndRegister19_04_18/AdminIndex.php");
	}
?>