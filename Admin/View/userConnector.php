<?php
	session_start();
	//Unless they are an admin and logged in, don't let them see this page.
	if ($_SESSION["loggedIn"] != "yes" OR $_SESSION["isAdmin"] == "no") {
		header("location: https://experiencesampling.co.uk/LoginAndRegister/LoginAndRegister19_04_18/Login.php");
	}
	
	include("../Controller/qnrConnectorController.ini");

$qcc = new qnrConnectorController($_SESSION["qnrID"]);


if($_POST["userC"] != null)
	$qcc -> connectUsers($_POST["userC"]);

if($_POST["userD"] != null)
	$qcc -> disconnectUsers($_POST["userD"]);

////var_dump($_SESSION);
?>
<html>
	<head>	
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="../../../css/style.css" type="text/css" rel="stylesheet">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
 		<!-- Required meta tags 
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="../../../css/style.css" type="text/css" rel="stylesheet">
		<!-- Bootstrap CSS 
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
	</head>

	<body>
		<?php
		echo "<h2>Connecting to questionnaire: ".$_SESSION["name"]." (ID: ".$_SESSION["qnrID"].")</h2>";

		echo $qcc -> printUsers();
		?>
		<br>
		<a href = "qCreatorView.php">Back</a>
	</body>
</html>

