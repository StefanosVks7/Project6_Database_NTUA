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

    <title> Project Analytics </title>

</head>

<body>
    <?php include('navbar.php'); ?>
    <table class="table table-hover table-success table-striped table-borderless">
        <thead>
            <tr>
                <th>#</th>
                <th>Name_Science_Field</th>
				<th> </th>
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

        $quer = 'SELECT Code_anaforas, Name_Science_Field FROM Epistimoniko_Pedio';

        $res = mysqli_query($conn, $quer);

        $num = 0;

        if (mysqli_num_rows($res) == 0) {
            echo "<h4>There are no projects</h4>";
        } else {

            while ($tuple = mysqli_fetch_assoc($res)) {

                $num++;
                echo "<tr>";
				
                echo "<td>" . $num . "</td>";
                echo "<td>" . $tuple['Name_Science_Field'] . "</td>";
				
				echo "<td>" . "<a class=\"button button1\" href=\"see_field_activity.php?varname1=".$tuple['Code_anaforas']." & varname2=".$tuple['Name_Science_Field']." \" role=\"button\">
					see activity
					
						</a>". "</td>";
                echo "</tr>";

		   }
        }

        $conn->close();
        ?>
    </table>
</body>

</html>