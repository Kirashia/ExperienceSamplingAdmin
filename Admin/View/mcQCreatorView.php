<?php
	session_start();
	//Unless they are an admin and logged in, don't let them see this page.
	if ($_SESSION["loggedIn"] != "yes" OR $_SESSION["isAdmin"] == "no") {
		header("location: https://experiencesampling.co.uk/LoginAndRegister/LoginAndRegister19_04_18/Login.php");
	}
	else {
		header("location: https://experiencesampling.co.uk/LoginAndRegister/LoginAndRegister19_04_18/AdminIndex.php");
	}

include("../Controller/qCreatorController.ini");
$qnrName = $_GET["qnrName"];
$qCreatorController = new qCreatorController($qnrName);

if (isset($_POST["responses"]) and count($_POST["responses"]) > 0){
	for($i = 0; $i < count($_POST["responses"]); $i++)
	{
		$r = $_POST["responses"][$i];
		$qCreatorController -> makeMCQResponse($r, $_GET["qType"], $_GET["qID"]);
	}
	header("Location: qCreatorView.php?name=".$qnrName);
	die();
}
?>
<html>
	<head>	
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="../../../css/style.css" type="text/css" rel="stylesheet">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
		<title> Create Questionnaire - MC Question</title>		
	</head>
	
	<body>
		<form method = "POST">
			
				<?php
					echo $qCreatorController -> makeResponseForm($_GET["noResponses"]);
				?>
				<input type = "submit" value = "Add responses">
			</form>
	</body>
</html>