<?php
	session_start();
	//Unless they are an admin and logged in, don't let them see this page.
	if ($_SESSION["loggedIn"] != "yes" OR $_SESSION["isAdmin"] == "no") {
		header("location: https://experiencesampling.co.uk/LoginAndRegister/LoginAndRegister19_04_18/Login.php");
	}
	else {
		header("location: https://experiencesampling.co.uk/LoginAndRegister/LoginAndRegister19_04_18/AdminIndex.php");
	}

include("../Controller/qnrConnectorController.php");
$qnrConnectorController = new qnrConnectorController();

// Gets the data from the form
$qnrName = $_POST["qnrName"];
$userName = $_POST["userName"];
$filter = $_POST["filter"];

//var_dump($qnrConnectorController -> printSomeQnrUsers(4, true	));

?>
<html>
	<head>	
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="../../../css/style.css" type="text/css" rel="stylesheet">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
		<title>Connecting a questionnaire</title>
	</head>
	
	<body>
		<h1>Connecting users to a questionnaire</h1>
		<!-- Selectboxes -->
		<form method = "POST">
			
		</form>
		
		<!-- Filters -->
		<form method = "POST">
			
		</form>
		<br>
		<?php echo $qnrConnectorController -> printQnrUserTable();?>
	</body>
</html>

