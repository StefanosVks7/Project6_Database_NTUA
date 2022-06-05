<!DOCTYPE html>
<html lang="en">

<style>
    thead th {
        font-size: 1.6em;
		color: white;
        background-color: #A4A36D;
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
                <th>ID_Ereuniti</th>
                <th>ID_Organismou</th>
                <th>First_Name</th>
                <th>Last_Name</th>
				<th>Gender</th>
				<th>Date_Work_Relationship</th>
				<th>Birth_Date</th>
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
			
        $quer = 'SELECT ID_Ereuniti,ID_Organismou,First_Name,Last_Name,Gender,Date_Work_Relationship,Birth_Date FROM researcher';

        $res = mysqli_query($conn, $quer);

        $num = 0;

        if (mysqli_num_rows($res) == 0) {
            echo "<h4>There are no researchers</h4>";
        } else {

            while ($tuple = mysqli_fetch_assoc($res)) {

                $num++;
				echo "<tr>";
				echo "<td>" . $num . "</td>";
                echo "<td>" . $tuple['ID_Ereuniti'] . "</td>";
                echo "<td>" . $tuple['ID_Organismou'] . "</td>";
                echo "<td>" . $tuple['First_Name'] . "</td>";
                echo "<td>" . $tuple['Last_Name'] . "</td>";
				echo "<td>" . $tuple['Gender'] . "</td>";
                echo "<td>" . $tuple['Date_Work_Relationship'] . "</td>";
				echo "<td>" . $tuple['Birth_Date'] . "</td>";
				echo "<td>" . "<a class=\"button button1\"  href=\"see_researcher.php?varname1=".$tuple['ID_Ereuniti']." \"role=\"button\">
					works					
						</a>". "</td>";
                echo "</tr>";
				echo "</details>";
            }
        }

        $conn->close();
        ?>
    </table>
</body>

</html>