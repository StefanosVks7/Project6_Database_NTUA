<!DOCTYPE html>
<html lang="en">

<style>
    thead th {
        font-size: 1.3em;
		  background-color: #AA7004;
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

    <title> Database Analysis </title>

</head>

<body>
    <?php include('navbar.php'); ?>
    <table class="table table-hover table-success table-striped table-borderless">
        <thead>
            <tr>
                <th>#</th>
                <th>ID_Stelexous</th>
                <th>Name</th>
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
			
        $quer = 'SELECT * FROM Stelexos';

        $res = mysqli_query($conn, $quer);

        $num = 1;
		$previous = "";
        if (mysqli_num_rows($res) == 0) {
            echo "<h4>There are no programs</h4>";
        } else {

            while ($tuple = mysqli_fetch_assoc($res)) {
               
			   echo "<tr>";
			
				if ($tuple['Name'] != $previous)	{
					echo "<td>" . $num . "</td>";
					echo "<td>" . $tuple['ID_Stelexous'] . "</td>";				
					echo "<td>" . $tuple['Name'] . "</td>";		
					$num++;
				}
				else {
					echo "<td>    </td>";
					echo "<td>    </td>";
					echo "<td>    </td>";

				}

				$previous = $tuple['Name'];
                echo "</tr>";
            }
        }

        $conn->close();
        ?>
    </table>
</body>

</html>