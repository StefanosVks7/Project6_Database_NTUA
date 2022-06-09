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

    <title> Database Analysis </title>

</head>

<body>
    <?php include('navbar.php');?>
    <table class="table table-hover table-success table-striped table-borderless">
        <thead>
            <tr>
                <th>ID_Ergou</th>	
                <th>Title</th>
                <th>ID_Ereuniti</th>
				<th>First_Name</th>
				<th>Last_Name</th>
            </tr>
        </thead>
		
		<?php
        $host = "127.0.0.1";
        $port = 3306;
        $socket = "";
        $user = "root";
        $password = "";
        $dbname = "project_team_6";
		
        $conn = new mysqli($host, $user, $password, $dbname, $port, $socket)
            or die('Could not connect to the database server' . mysqli_connect_error());
		
        $quer = "SELECT * FROM projects_per_researcher";

        $res = mysqli_query($conn, $quer);

		$previous = 0;
        if (mysqli_num_rows($res) == 0) {
            echo "<h4>There are no projects</h4>";
        } else {
			
		   while ($tuple = mysqli_fetch_assoc($res)) {
                echo "<tr>";
				if ($tuple['ID_Ergou'] != $previous)	{		
					echo "<td>" . $tuple['ID_Ergou'] . "</td>";
                    echo "<td>" . $tuple['Title'] . "</td>";
					echo "<td>" . $tuple['ID_Ereuniti'] . "</td>";
                    echo "<td>" . $tuple['First_Name'] . "</td>";
                    echo "<td>" . $tuple['Last_Name'] . "</td>";
				}
				else {
					echo "<td>    </td>";
					echo "<td>    </td>";
					echo "<td>    </td>";
				}
                echo "</tr>";
		   }
        }

        $conn->close();
        ?>
    </table>
</body>

</html>