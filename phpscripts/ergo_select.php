<!DOCTYPE html>
<html lang="en">

<style>
    thead th {
        font-size: 1.6em;
		color: yellow;
		background-color: #04AA6D;
    }


    .navbar-nav li:hover>.dropdown-menu {
        display: block;
	}	
	form {
		
		position:relative;
		margin-top:50px;
		margin-bottom:50px;
		margin-left:12%;
	}
	button{
		margin-top:40px;
		margin-left:80px;
	}   
</style>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title> Erga-Epixorigiseis Analysis </title>

</head>

<body>
	<?php include('navbar.php'); ?>
    <form action="ergo_database.php">
		  <p>Please select fields:</p>
		  <input type="checkbox" id="timespan" name="timespan" value="yes">
		  <label for="timespan">timespan</label><br>
		  <input type="checkbox" id="executive" name="executive" value="yes">
		  <label for="executive">executive</label><br> 
		  <input type="checkbox" id="organisation" name="organisation" value="yes">
		  <label for="organisation">organisation</label><br> 
		  <input type="checkbox" id="all" name="all" value="yes">
		  <label for="all">all</label><br> 
		  <input type="submit" value="See erga-epixorigiseis">
		</form>

</body>

</html>