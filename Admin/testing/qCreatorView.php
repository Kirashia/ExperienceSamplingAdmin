<?php
	session_start();
	//Unless they are an admin and logged in, don't let them see this page.
	/* if ($_SESSION["loggedIn"] != "yes" OR $_SESSION["isAdmin"] == "no") {
		header("location: https://www.itecdigital.org.uk/sussexuni2017/LoginAndRegister/LoginAndRegister19_04_18/Login.php");
	}
	if($_SESSION["name"] == "" or $_SESSION["name"] == null)
	{
		//header("Location:index.php");
		echo '<script>alert("An unknown error occurred");location.href="index.php"</script>';
		die();
	} */

include("qCreatorController.ini");

$qnrName = "Six";
$qCreatorController = new qCreatorController($qnrName);

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
$_SESSION["c"]++;
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
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
		<script type="text/javascript">
		
		function loadTable(){
			$('#table').load("qTable.php", { "qnr":"<?php echo $qnrName;?>" });
		}
		
		$(document).ready(function(){
			
			loadTable();
			
		});
		
		
		$(document).on("click", ".edit#R", function(){
			$("#qResponses").load("responses.php", { "id":$(this).val(), "qnr":"<?php echo $qnrName ?>", "count":"<?php echo $_SESSION["c"] ?>"});
		});
		
		$(document).on("click", '.edit#T', function(){
			// edit type
			var id = $(this).val();
			
			if(!$('#T'+id).is(":hidden")){
				$('#tContainer'+id).show();
				$('#tContainer'+id).load("type.php", { "id":id, "qnr":"<?php echo $qnrName ?>", "type":$(this).val(), "count":"<?php echo $_SESSION["c"] ?>"});
			}else{
				$('#tContainer'+id).hide();
			}
			
			$('#T'+id).toggle();
		});
			
		$(document).on("click", '.edit#N', function(){
			// edit name
			var id = $(this).val();
			var btn = this;
			
			if(!$('#N'+id).is(":hidden")){
				$('#nContainer'+id).show();
				$('#nContainer'+id).load("name.php", { "id":$(this).val(), "qnr":"<?php echo $qnrName ?>", "count":"<?php echo $_SESSION["c"] ?>"});
			}else{
				$('#nContainer'+id).hide();
			}
			
			$('#N'+id).toggle();
		});
		
			
		
		$(document).on("click", '[id^="subN"]', function(){
				$('#table table').remove();
				loadTable();
				//$('#N'+$(this).val()).show();
		});
		
		$.ajax({
		  cache: false
		})
		</script>		
	</head>
	
	<body>
		<h1><?php echo "Editing: $qnrName";?></h1>	
		<a href = "https://www.itecdigital.org.uk/sussexuni2017/MVC/Admin/View/qnrNameEditor.php">Edit name</a>
		<br>
		<a href = "https://www.itecdigital.org.uk/sussexuni2017/MVC/Admin/View/qnrCreatorView.php">Back</a>
		<br>
		<br>
		<div id = "table"></div>
		<form name = "add" method = "POST">
			<button name = "add" value = "true">Add Question</button>
		</form>

		<div id = "qNameChange"></div>
		<div id = "qTypeChange"></div>
		<div id = "qResponses"></div>
		
	</body>
</html>