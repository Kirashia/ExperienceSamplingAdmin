<?php
	session_start();
	//Unless they are an admin and logged in, don't let them see this page.
	if ($_SESSION["loggedIn"] != "yes" OR $_SESSION["isAdmin"] == "no") {
		header("location: https://experiencesampling.co.uk/LoginAndRegister/LoginAndRegister19_04_18/Login.php");
	}


include("../Controller/qCreatorController.ini");
session_start();
$qnrName = $_SESSION["name"];
$qCreatorController = new qCreatorController($qnrName);
$_SESSION["id"] =  "";

if($_POST["delete"] != '' and $_POST["delete"] != null)
{
	$deleteId = $_POST["delete"];
	$qD = $qCreatorController -> removeMCAnswers($deleteId);
	$rD = $qCreatorController -> removeQ($deleteId);
}

$qName = $_POST["name"];
$qType = $_POST["question_type"];

$addQ = $_POST["add"] == "true";
if ($addQ)
{
	$qA = $qCreatorController -> makeQ("new question", "text");
}

$qCreatorController -> qsTable = $qCreatorController -> printQs();

$_SESSION["name"] = $qnrName;
$_SESSION["qnrID"] = $qCreatorController -> fkey;
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
	
		<title> Create Questionaire - Question</title>		
	</head>
	
	<body>
		<h1><?php echo "Editing: $qnrName";?></h1>	
		<a href = "https://experiencesampling.co.uk/MVC/Admin/View/qnrNameEditor.php">Edit name</a>
		<br>
		<a href = "https://experiencesampling.co.uk/MVC/Admin/View/qnrCreatorView.php">Back</a>
		<br>
		<a href = "userConnector.php">Connect Users</a>
		<br>
		<br>
		<form name = "add" method = "POST">
			<button name = "add" value = "true">Add Question</button>
		</form>
		
		
		<?php 
			echo $qCreatorController -> qsTable;
		?>
		
		
	</body>
</html>