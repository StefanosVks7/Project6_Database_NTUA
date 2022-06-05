<!DOCTYPE html>
<html lang="en">

<style>
    thead th {
        font-size: 1.3em;
		  background-color: #04AA6D;
			color: white;
	}
    .navbar-nav li:hover>.dropdown-menu {
        display: block;
	}	
	form {
		
		position:relative;
		margin-top:30px;
		margin-bottom:90px;
		margin-left:12%;
	}
	button{
		margin-top:50px;
		margin-left:50px;
	}  
</style>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title> Data Analysis </title>

</head>

<body>
	<?php include('navbar.php'); ?>
    <form action="organization_database.php">
		  <p>Please select fields:</p>
		  <input type="checkbox" id="address" name="address" value="yes">
		  <label for="address">address</label><br>
		  <input type="checkbox" id="timespan" name="timespan" value="yes">
		  <label for="org type">org type</label><br>
		  <input type="checkbox" id="all" name="all" value="yes">
		  <label for="all">all</label><br> 
		  <input type="submit" value="See projects">
		  
		</form>

</body>

</html>