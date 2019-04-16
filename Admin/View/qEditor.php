<?php
	session_start();
	//Unless they are an admin and logged in, don't let them see this page.
	if ($_SESSION["loggedIn"] != "yes" OR $_SESSION["isAdmin"] == "no") {
		header("location: https://experiencesampling.co.uk/LoginAndRegister/LoginAndRegister19_04_18/Login.php");
	}
	
	if($_SESSION["name"] == "" or $_SESSION["name"] == null)
	{
		//header("Location:index.php");
		echo '<script>alert("An unknown error occurred");location.href="index.php"</script>';
		die();
	}

include("../Controller/qCreatorController.ini");
////var_dump($_POST);
$qnrName = $_SESSION["name"];
////var_dump($qnrName);
$qCreatorController = new qCreatorController($qnrName);

//var_dump($_POST);

$qId = $_POST["edit"];
if($_SESSION["id"] == null or $_SESSION["id"] == "")
{
	$_SESSION["id"] = $qId;

}

else 
{	
	$qId = $_SESSION["id"];
} 
$toEdit = $qCreatorController -> getQ($qId);

if ($_POST["addResponse"] == "add")
{
	// Add an extra response box
	$_SESSION["extra"]++;
}
else if ($_SESSION["delete"] == "extra")
{
	// Remove an extra box that has been unsubmitted
	$_SESSION["extra"]--;
}

else if ($_SESSION["delete"] > 0)
{
	// Remove an existing mc answer
	$success = $qCreatorController -> deleteSingleMCAnswer($_SESSION["delete"]);
	if (!$success)
	{
		$_SESSION["extra"]--;
	}
}

if ($_POST["submitResponses"] == "submit")
{
	// Update the mc responses data
	$qCreatorController -> editResponses($qId, $_POST["responses"], $toEdit["type"]);
	$_SESSION["extra"] = 0;
}
if ($_POST["submitQuestion"] == "submit")
{
	// Update the question name and type
	$qCreatorController -> editQName($qId, $_POST["name"]);
	$qCreatorController -> editType($qId, $_POST["type"]);
	$_SESSION["extra"] = 0;
}

$toEdit = $qCreatorController -> getQ($qId);
$responses = $qCreatorController -> getMCAnswers($qId);
$responseForm = $qCreatorController -> makeEditResponseForm($responses, $_SESSION["extra"], $qnrName, $qId);

$qTitle = $toEdit["title"];

/* //var_dump($_SESSION);
echo '<br>';
//var_dump($_POST);
echo '<br>';
//var_dump($_SESSION); */

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
	
		<title> Edit Questionaire - EDIT Question</title>				
	</head>
	
	<body>
		<h1>Editing question: <?php echo $qTitle;?></h1>
		<a href = "https://experiencesampling.co.uk/MVC/Admin/View/qCreatorView.php"> Back </a>
			<form name = "add" method = "POST">
				<p>Edit: <b><?php echo $qTitle;?>: </b></p>
				Edit Name: <input type = "text" name = "name" placeholder = "New question name"> <br>
				Edit Type: 
				<?php
					echo $qCreatorController -> printOptions($toEdit["type"]);
					echo "<br>";
				?>
				<button value = "submit" name = "submitQuestion">Submit Question</button>
				<br>
				<br>
				</form>
				<?php
					if ($toEdit["type"] == "checkbox" or $toEdit["type"] == "radio")
					{
				?>
						<form method = "post">
							<button value = "add" name = "addResponse">Add Response</button>
							<button value = "submit" name = "submitResponses">Submit Changes to Responses</button>
							<?php
								echo $responseForm;
							?>
						</form>
				<?php }?>
				
	</body>
</html>