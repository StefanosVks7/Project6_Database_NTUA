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
		margin-bottom:120px;
		margin-left:12%;
	}
	button{
		margin-top:50px;
		margin-left:12%;
	}   
</style>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title> Project Analytics </title>

</head>

<body>
	<?php include('navbar.php'); ?>
    <form action="organisation_database.php">
		  <p>Please select fields:</p>
		  <input type="checkbox" id="address" name="address" value="yes">
		  <label for="address">address</label><br>
		  <input type="checkbox" id="all" name="all" value="yes">
		  <label for="all">all</label><br> 
		  <input type="submit" value="See database">
		  
		</form>

</body>

</html>