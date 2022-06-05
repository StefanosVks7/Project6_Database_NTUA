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
    <table class="table table-hover table-success table-striped table-borderless">
        <?php
        $host = "127.0.0.1";
        $port = 3308;
        $socket = "";
        $user = "root";
        $password = "Account_attempt56!";
        $dbname = "mydb";
		
        $conn = new mysqli($host, $user, $password, $dbname, $port, $socket)
            or die('Could not connect to the database server' . mysqli_connect_error());

		if(!empty($_GET['varname1'])){
			$project_id = $_GET['varname1'];
		} 
		
        $quer = 'SELECT title, prog_name FROM project inner join licensing on project_id = licensing_project_id inner join program on licensing_program_id = program_id where project_id = '.$project_id.';';

        $res = mysqli_query($conn, $quer);

        if (mysqli_num_rows($res) == 0) {
            echo "<h4>There are no projects</h4>";
        } else {
			while ($tuple = mysqli_fetch_assoc($res)) {
				echo "<p style=\"text-align:center; margin-top:30px; margin-bottom:50px; font-weight: bold; font-size: 1.8em \">  ".$tuple['title']." </p>";
				echo "<p style=\"text-align:center; margin-top:40px; margin-bottom:40px; font-size: 1.6em \">  In program: ".$tuple['prog_name']." </p>";
			}
		}

		$quer = 'SELECT exec_name FROM project inner join administration_ex on project_id = administrationex_project_id inner join executive on administrationex_executive_id = executive_id where project_id = '.$project_id.';';
		$res = mysqli_query($conn, $quer);
		if (mysqli_num_rows($res) > 0) {
			while ($tuple = mysqli_fetch_assoc($res)) {
				echo "<p style=\"text-align:center; margin-top:40px; margin-bottom:40px; font-size: 1.6em \"> Executive: ".$tuple['exec_name']." </p>";
		   }
		}
		
		$quer = 'SELECT org_name FROM project inner join administration on project_id = administration_project_id inner join organisation on administration_organisation_id = organisation_id where project_id = '.$project_id.';';
		$res = mysqli_query($conn, $quer);
		if (mysqli_num_rows($res) > 0) {
			while ($tuple = mysqli_fetch_assoc($res)) {
				echo "<p style=\"text-align:center; margin-top:40px; margin-bottom:40px; font-size: 1.6em \"> Suggested: ".$tuple['org_name']." </p>";
		   }
		}
		
		$quer = 'SELECT first_name,surname FROM project inner join science_director on project_id = dir_project_id inner join researcher on dir_researcher_id = researcher_id where project_id = '.$project_id.';';
		$res = mysqli_query($conn, $quer);
		if (mysqli_num_rows($res) > 0) {	
			while ($tuple = mysqli_fetch_assoc($res)) {
				echo "<p style=\"text-align:center; margin-top:40px; margin-bottom:40px; font-size: 1.6em \"> Science Director: ".$tuple['surname'].", " .$tuple['first_name'] . "</p>";
		   }
		}
		
		$quer = 'SELECT first_name,surname, date_of_eval, score FROM project inner join evaluation on eval_project_id = project_id inner join researcher on researcher_id = eval_researcher_id where project_id = '.$project_id.';';
		$res = mysqli_query($conn, $quer);
		if (mysqli_num_rows($res) > 0) {	
			while ($tuple = mysqli_fetch_assoc($res)) {
				echo "<p style=\"text-align:center; margin-top:40px; margin-bottom:40px; font-size: 1.6em \"> Evaluated: ".$tuple['surname'].", " .$tuple['first_name'] . " on " .$tuple['date_of_eval'] .", score: " .$tuple['score']. "</p>";
		   }
		}
		
		$quer = 'SELECT first_name,surname FROM project inner join works_on on project_id = workson_project_id inner join researcher on workson_researcher_id = researcher_id where project_id = '.$project_id.';';
		$res = mysqli_query($conn, $quer);
		if (mysqli_num_rows($res) > 0) {
			echo "<p style=\"text-align:center; margin-top:70px; margin-bottom:50px; font-size: 1.8em \"> Researchers: </p>";	
			while ($tuple = mysqli_fetch_assoc($res)) {
				echo "<p style=\"text-align:center; margin-top:40px; margin-bottom:40px; font-size: 1.6em \"> ".$tuple['surname'].", " .$tuple['first_name']. "</p>";
		   }
		}
		
		$quer = 'SELECT del.title as titel, date_of_deliver FROM project as p  inner join deliverable as del on del.project_id = p.project_id where p.project_id = '.$project_id.';';
		$res = mysqli_query($conn, $quer);
		if (mysqli_num_rows($res) > 0) {
			echo "<p style=\"text-align:center; margin-top:70px; margin-bottom:50px; font-size: 1.8em \"> Deliverable: </p>";	
			while ($tuple = mysqli_fetch_assoc($res)) {
				echo "<p style=\"text-align:center; margin-top:20px; margin-bottom:20px; font-size: 1.6em \"> ".$tuple['titel'].", " .$tuple['date_of_deliver']. "</p>";
		   }
		}
		
        $conn->close();
        ?>
    </table>
</body>

</html>