<!DOCTYPE html>
<html lang="en">

<style>
    thead th {
        font-size: 1.6em;
		background-color: #A4A36D;
		color: yellow;
    }

    .navbar-nav li:hover>.dropdown-menu {
        display: block;
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
    <table class="table table-hover table-success table-striped table-borderless">     
        <?php
		
		echo "<thead>";
		echo "<tr>";
		echo "<th>#</th>";
		echo "<th>ID_Ergou</th>";
		echo "<th>Title</th>";
		$amount_en = "no";
		$timespan_en = "no";
		$duration_en = "no";
		$executive_en = "no";
		$organisation_en = "no";
		$all_en = "no";
		if(!empty($_GET['all'])){
			$all_en = $_GET['all'];
			echo "<th>Perilipsi</th>";
			echo "<th>Funding</th>";
			echo "<th>Start_Date</th>";
			echo "<th>End_Date</th>";
			echo "<th>ID_Stelexous</th>";
			echo "<th>ID_Ereuniti</th>";
			echo "<th>Program_Address</th>";
			echo "<th>ID_Axiologisis</th>";
			echo "<th>ID_Organismou</th>";
		}
		else {
			if(!empty($_GET['amount'])){
				$amount_en = $_GET['amount'];
				echo "<th>Funding</th>";
			}
			if(!empty($_GET['organisation'])){
				$organisation_en = $_GET['organisation'];
				echo "<th>Organisation</th>";
			}
			if(!empty($_GET['executive'])){
				$executive_en = $_GET['executive'];
				echo "<th>ID_Stelexous</th>";
			}
			if(!empty($_GET['timespan'])){
				$timespan_en = $_GET['timespan'];
				echo "<th>Start_Date</th>";
				echo "<th>End_Date</th>";
			}
		}
		echo "<th> </th>";
		
		echo "</tr>";
		echo "</thead>";
		
        $host = "127.0.0.1";
        $port = 3306;
        $socket = "";
        $user = "root";
        $password = "";
        $dbname = "project_team_6";

        $conn = new mysqli($host, $user, $password, $dbname, $port, $socket)
            or die('Could not connect to the database server' . mysqli_connect_error());

		$quer = 'SELECT * FROM ergo_epixorigisi';

        $res = mysqli_query($conn, $quer);

        $num = 0;

        if (mysqli_num_rows($res) == 0) {
            echo "<h4>There are no projects</h4>";
        } else {

            while ($tuple = mysqli_fetch_assoc($res)) {

                $num++;
                echo "<tr>";
				
                echo "<td>" . $num . "</td>";
                echo "<td>" . $tuple['ID_Ergou'] . "</td>";
                echo "<td>" . $tuple['Title'] . "</td>";
				if($all_en == "yes") {
					echo "<td>" . $tuple['Perilipsi'] . "</td>";
					echo "<td>" . $tuple['Start_Date'] . "</td>";
					echo "<td>" . $tuple['End_Date'] . "</td>";
					echo "<td>" . $tuple['Start_Date'] . "</td>";
					echo "<td>" . $tuple['End_Date'] . "</td>";
					echo "<td>" . $tuple['ID_Stelexous'] . "</td>";
					echo "<td>" . $tuple['ID_Ereuniti'] . "</td>";
					echo "<td>" . $tuple['Program_Address'] . "</td>";
					echo "<td>" . $tuple['ID_Axiologisis'] . "</td>";
					echo "<td>" . $tuple['ID_Organismou'] . "</td>";
				}
				else {
					if ($amount_en == "yes") {echo "<td>" . $tuple['Funding'] . "</td>";}
					if ($organisation_en == "yes") {echo "<td>" . $tuple['ID_Organismou'] . "</td>";}
					if ($executive_en == "yes") {echo "<td>" . $tuple['ID_Stelexous'] . "</td>";}
					if ($timespan_en == "yes") {echo "<td>" . $tuple['Start_Date'] . "</td>";
					echo "<td>" . $tuple['End_Date'] . "</td>";}
				}
                echo "</tr>";
				

		   }
        }

        $conn->close();
        ?>
    </table>
</body>

</html>