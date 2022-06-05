<!DOCTYPE html>

<html lang="en">

<style>
    thead th {
        font-size: 1.3em;
		  background-color: #E2AA6D;
			color: yellow;
    }
	background: yellow
    .navbar-nav li:hover>.dropdown-menu {
        display: block;
		color: #011111
    }
</style>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title> Project Analytics </title>

</head>

<body style="background-color:powderblue;">
    <?php include('navbar.php');?>
    
        <?php
        $host = "127.0.0.1";
		$port = 3306;
		$socket = "";
		$user = "root";
		$password = "";
		$dbname = "project_team_6";
        
		$conn = new mysqli($host, $user, $password, $dbname, $port, $socket)
            or die('Could not connect to the database server' . mysqli_connect_error());

		if(!empty($_GET['varname1'])){
			$researcher_id = $_GET['varname1'];
		} 
		
		$quer = 'SELECT * FROM Researcher';
		# apo afta tha parw mono osa thelw kai oxi parapanw
        $res = mysqli_query($conn, $quer);

        $num = 0;
		
        if (mysqli_num_rows($res) == 0) {
            echo "<h4>There are no projects</h4>";
        } else {
			while ($tuple = mysqli_fetch_assoc($res)) {
				echo "<p style=\"text-align:left; margin-top:60px; margin-bottom:60px; font-weight: bold; font-size: 1.8em \">  ".$tuple['First_Name']." ".$tuple['Last_Name']." </p>";
				echo "<p style=\"text-align:left; margin-top:45px; margin-bottom:45px; font-size: 1.2em \">  Emploee of organization with ID: ".$tuple['ID_Organismou']." </p>";
			}
		}

		$quer = 'SELECT title FROM project inner join works_on on workson_project_id = project_id inner join researcher on researcher_id = workson_researcher_id where researcher_id = '.$researcher_id.';';
		$res = mysqli_query($conn, $quer);
		if (mysqli_num_rows($res) > 0) {
			echo "<p style=\"text-align:center; margin-top:70px; margin-bottom:20px; font-size: 1.8em \"> Works on project(s): </p>";	
			while ($tuple = mysqli_fetch_assoc($res)) {
				echo "<p style=\"text-align:center; margin-top:20px; margin-bottom:20px; font-size: 1.6em \"> ".$tuple['title']." </p>";
		   }
		}
		$quer = 'SELECT title FROM project inner join science_director on dir_project_id = project_id inner join researcher on researcher_id = dir_researcher_id where researcher_id = '.$researcher_id.';';
		$res = mysqli_query($conn, $quer);
		if (mysqli_num_rows($res) > 0) {
			echo "<p style=\"text-align:center; margin-top:70px; margin-bottom:20px; font-size: 1.8em \"> Science director of: </p>";	
			while ($tuple = mysqli_fetch_assoc($res)) {
				echo "<p style=\"text-align:center; margin-top:20px; margin-bottom:20px; font-size: 1.6em \"> ".$tuple['title']." </p>";
		   }
		}
		
		$quer = 'SELECT title FROM project inner join evaluation on eval_project_id = project_id inner join researcher on researcher_id = eval_researcher_id where researcher_id = '.$researcher_id.';';
		$res = mysqli_query($conn, $quer);
		if (mysqli_num_rows($res) > 0) {
			echo "<p style=\"text-align:center; margin-top:70px; margin-bottom:20px; font-size: 1.8em \"> Evaluator of: </p>";	
			while ($tuple = mysqli_fetch_assoc($res)) {
				echo "<p style=\"text-align:center; margin-top:20px; margin-bottom:20px; font-size: 1.6em \"> ".$tuple['title']." </p>";
		   }
		}
		   
        $conn->close();
        ?>
    
</body>

</html>