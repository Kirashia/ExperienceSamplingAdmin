<!DOCTYPE html>
<html>
<head>	
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="../../../css/style.css" type="text/css" rel="stylesheet">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script><script type="text/javascript">
$(document).ready(function(){
    $("#mybutton").click(function(){
        $("#divTestArea1").load("redirect.php");
    });
});
</script>
</head>
<body>

<button id="mybutton">Get the time in seconds since 1/1/1970!!!</button>
<div id="divTestArea1"></div>
</body>
</html>