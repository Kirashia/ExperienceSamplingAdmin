<?php
	session_start();
	//Unless they are an admin and logged in, don't let them see this page.
	if ($_SESSION["loggedIn"] != "yes" OR $_SESSION["isAdmin"] == "no") {
		header("location: https://experiencesampling.co.uk/LoginAndRegister/LoginAndRegister19_04_18/Login.php");
	}
	
//session_start();
include("../Controller/qnrCreatorController.ini");
$qnrCreatorController = new qnrCreatorController();

$_SESSION["name"] = null;

// Gets the data from the form
$qnrName = $_POST["name"];

if($_POST["cancelDelete"] != 1)
	$confirmDelete = false;

if($_POST["name"] != null and $_POST["name"] != "null")
{
	$success = $qnrCreatorController -> makeQnr($qnrName);
	if(!$success)
	{
		echo "<script>alert('Questionaire with that name already exists');</script>";
		
	}
	else
	{
		$_SESSION["name"] = $qnrName;
		header("Location: qCreatorView.php");
		die();
	}
}
else if ($_POST["edit"] != null and $_POST["edit"] != "null")
{
	// Redirects the user if the questionnaire is created successfully
	$_SESSION["name"] = $_POST["edit"];
	header("Location: qCreatorView.php");
	die();
} 
else if ($_POST["copy"] != null and $_POST["copy"] != "null")
{
	// Copy the qnr with new name
	
	$qnrName = $_POST["copy"];
	
	$c = 1;
	$name = $qnrName." - Copy ($c)";
	$success = $qnrCreatorController -> makeQnr($name);
	
	while (!$success)
	{
		$c++;
		$name = $qnrName." - Copy ($c)";
		$success = $qnrCreatorController -> makeQnr($name);
	}
	
	
	$copySuccess = $qnrCreatorController -> copyQnr($qnrName, $name);
	
	if ($copySuccess)
	{
		// Redirects the user if the questionnaire is created successfully
		$_SESSION["name"] = $name;
		header("Location: qCreatorView.php");
		die();
	}
	else 
	{
		////var_dump($copySuccess);
	}
}
else if ($_POST["delete"] != null and $_POST["delete"] != "null" and $_POST["cancelDelete"] != 1)
{
	$confirmDelete = true;
}
else if ($_POST["confirmDelete"] != null)
{
	$qnrCreatorController -> deleteQnr($_POST["confirmDelete"]);
}
else if ($success)
{
	// Redirects the user if the questionnaire is created successfully
	$_SESSION["name"] = $qnrName;
	header("Location: qCreatorView.php");
	die();
}

$temp = $qnrCreatorController -> getUpdatedNames();
?>


<html>
	<head>	
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="../../../css/style.css" type="text/css" rel="stylesheet">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
		<title> Create Questionaire</title>
	</head>
	
	<body>
	<a href = "https://experiencesampling.co.uk/MVC/Admin/View/">Home</a>
		<form method = "POST">
			<h1>Make a new questionnaire: </h1>
			Name: <input type = "text" name = "name">
			<input type = "submit">
		</form>
		<br>
		<form method = "POST">
			<h1>Copy a questionnaire: </h1>
			<select name = "copy">
			<option value = "null">-
				<?php
					// Prints a thing with all the current questionnaires in it
					foreach($temp as $t){
						echo "<option value = '$t'>$t";
					}
				?>
			</select>
			<input type = "submit">
		</form>
		<br>
		<form method = "POST">
			<h1>Edit a questionnaire: </h1>
			<select name = "edit">
			<option value = "null">-
				<?php
					// Prints a thing with all the current questionnaires in it
					foreach($temp as $t){
						echo "<option value = '$t'>$t";
					}
				?>
			</select>
			<input type = "submit">
		</form>
		<br>
		<form method = "POST">
			<h1>Delete a questionnaire: </h1>
			<select name = "delete">
			<option value = "null">-
				<?php
					// Prints a thing with all the current questionnaires in it
					foreach($temp as $t){
						echo "<option value = '$t'>$t";
					}
				?>
				
			</select>
			<input type = "submit">
		</form>
		<?php
			if ($confirmDelete):						
		?>
		<h3>Deleting this questionnaire will remove all the questions associated with it, users will no longer be able to answer this questionnaire,<br>
		and all the responses that might already exist for this questionnaire:</h3>
		<form method = "POST">
			<button name = "confirmDelete" value = "<?php echo $_POST["delete"]; ?>">Confirm delete</button>
			<button name = "cancelDelete" value = 1>Cancel delete</button>
		</form>
		<?php endif; ?>
	</body>
</html>