<?php
	session_start();
	//Unless they are an admin and logged in, don't let them see this page.
	if ($_SESSION["loggedIn"] != "yes" OR $_SESSION["isAdmin"] == "no") {
		header("location: https://experiencesampling.co.uk/LoginAndRegister/LoginAndRegister19_04_18/Login.php");
	}

// This page contains code to view qnr results for many qnrs but needs qnrResultsIndex.php to initialise it with the correct id

include("../Controller/qnrResultsController.ini");
//session_start();
$qnrResultsController = new qnrResultsController();

$id = $_SESSION["id"];
$name = $_SESSION["name"];
$table = $qnrResultsController -> makeResultsTable($qnrResultsController -> getScores($id));

?>
<html>
	<head>	
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="../../../css/style.css" type="text/css" rel="stylesheet">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
		<title>Results for <?php echo $name;?></title>
	</head>
	
	<body>
		<h1>Results for <?php echo $name;?></h1>
		<br>
		<a href = "https://experiencesampling.co.uk/MVC/Admin/View/">Home</a><br>
		<a href = "https://experiencesampling.co.uk/MVC/Admin/View/qnrResultsIndex.php">Back to Index</a>
		<br>
		<?php
			echo $table;
		?>
	</body>
</html>