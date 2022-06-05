<!DOCTYPE html>
<html lang="en">

<style>
    thead th {
          font-size: 1.6em;
		  background-color: #04AA6D;
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
		echo "<th>Id Organismou</th>";
		$address_en = "no";
		$type_en = "no";
		$all_en = "no";
		if(!empty($_GET['all'])){
			$all_en = $_GET['all'];
			echo "<th>Syntomografia</th>";
			echo "<th>Name</th>";
			echo "<th style=\"width: 180px;\">Odos</th>";
			echo "<th>City</th>";
			echo "<th>Postal_Code</th>";
		}
		else {
				$address_en = $_GET['address'];
				echo "<th style=\"width: 180px;\">Odos</th>";
				echo "<th>City</th>";
				echo "<th>Postal code</th>";
		}	
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
			
        $quer = 'SELECT * FROM organization';

        $res = mysqli_query($conn, $quer);
        $num = 0;
		
        if (mysqli_num_rows($res) == 0) {
            echo "<h4>There are no projects</h4>";
        } else {
            while ($tuple = mysqli_fetch_assoc($res)) {
                $num++;
                echo "<tr>";
				
                echo "<td>" . $num . "</td>";
                echo "<td>" . $tuple['ID_Organismou'] . "</td>";
				if($all_en == "yes") {
					echo "<td>" . $tuple['Syntomografia'] . "</td>";
					echo "<td>" . $tuple['Name'] . "</td>";
					echo "<td>" . $tuple['Odos'] . "</td>";
					echo "<td>" . $tuple['City'] . "</td>";
					echo "<td>" . $tuple['Postal_Code'] . "</td>";
				}
				else {
					if ($address_en == "yes") {
						echo "<td>" . $tuple['Odos'] . "</td>";
						echo "<td>" . $tuple['City'] . "</td>";
						echo "<td>" . $tuple['Postal_Code'] . "</td>";
					}
				}
                echo "</tr>";
		   }
        }
        $conn->close();
        ?>
    </table>
</body>

</html>