<?php
	session_start();
	//Unless they are an admin and logged in, don't let them see this page.
	if ($_SESSION["loggedIn"] != "yes" OR $_SESSION["isAdmin"] == "no") {
		header("location: https://experiencesampling.co.uk/LoginAndRegister/LoginAndRegister19_04_18/Login.php");
	}

include("../Controller/qnrCreatorController.ini");
//session_start();
$qnrCreatorController = new qnrCreatorController();
$qnrName = $_SESSION["name"];
$newName = $_POST["name"];

if ($newName != null and $newName != $qnrName)
{
	$test = $qnrCreatorController -> editQnrName($qnrName, $newName);
	if ($test)
	{
		$_SESSION["name"] = $newName;		
		header("Location: qCreatorView.php");
	die();
	}
	else 
	{
		echo "<b>This name is already taken. Please use a different name</b>";
	}
}
$_SESSION["name"] = $qnrName;
?>
<html>
	<head>	
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="../../../css/style.css" type="text/css" rel="stylesheet">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
		<title> Edit Questionaire - EDIT Questionnaire Name</title>		
	</head>
	
	<body>
		<h1><?php echo "Editing: $qnrName";?></h1>	
		<a href = "https://experiencesampling.co.uk/MVC/Admin/View/qCreatorView.php"> Back </a>
			<form name = "add" method = "POST">
				<p>Edit: <b><?php echo $qnrName;?>: </b></p>
				
				<!-- Prints out the normal question form with all the boxes already filled in -->
				<!-- Form should update all the data to the question based on the final form submission -->
				Questionnaire Name: <input type = "text" name = "name" value = '<?php echo $qnrName; ?>'><br>
				<input type = "submit" value = "Change name">
			</form>
	</body>
</html>