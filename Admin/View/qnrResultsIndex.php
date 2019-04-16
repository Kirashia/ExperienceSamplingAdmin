<?php
	session_start();
	//Unless they are an admin and logged in, don't let them see this page.
	if ($_SESSION["loggedIn"] != "yes" OR $_SESSION["isAdmin"] == "no") {
		header("location: https://experiencesampling.co.uk/LoginAndRegister/LoginAndRegister19_04_18/Login.php");
	}

// This page is a hub page - it redirects the user to the page where the results can be viewed for a selected qnr

include("../Controller/qnrResultsController.ini");
//session_start();
$qnrResultsController = new qnrResultsController();

$name = $_POST["qnrName"];

if ($name != "" and $name != "null" )
{
	$id = $qnrResultsController -> getQnrID($name);
	// Redirects the user if the questionnaire is selected successfully
	$_SESSION["id"] = $id;
	$_SESSION["name"] = $name;
	header("Location: qnrResultsView.php");
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
	
		<title>View Results</title>
	</head>
	
	<body>
		<h1>View Results for a questionnaire</h1>
		<br>
		<a href = "https://experiencesampling.co.uk/MVC/Admin/View/">Home</a>
		<br>
		
		<!-- Form to show a selectbox with all the questionnaires in -->
		<form method = "POST">
			<select name = "qnrName">
			<option value = "null">-
				<?php
					// Prints a thing with all the current questionnaires in it
					$temp = $qnrResultsController -> qnrNames;
					foreach($temp as $t){
						if (strstr($t, $filter) or $filter == "")
						{
							echo "<option value = '$t'>$t";
						}
					}
				?>
			</select>
			<input type = "submit">
		</form>
	</body>
</html>



