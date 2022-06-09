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
    <?php include('navbar.php'); ?>
    <table class="table table-hover table-success table-striped table-borderless">
        <thead>
            <tr>
                <th>#</th>
                <th>first_name</th>
				 <th>last_name</th>
                <th>metrima</th>
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

        $quer = "SELECT r.ID_Ereuniti, r.first_name, r.last_name, COUNT(*) `metrima` FROM researcher r INNER JOIN works_on w ON r.ID_Ereuniti = w.ID_Ereuniti inner join ergo_epixorigisi p ON w.ID_Ergou = p.ID_Ergou WHERE w.ID_Ereuniti NOT IN (SELECT ID_Ergou FROM ergo_epixorigisi) GROUP BY r.ID_Ereuniti HAVING COUNT(*) > 4 ORDER BY COUNT(*) DESC;";

        $res = mysqli_query($conn, $quer);

        $numup = 0;

        if (mysqli_num_rows($res) == 0) {
            echo "<h4>There are no programs</h4>";
        } else {

            while ($tuple = mysqli_fetch_assoc($res)) {
                $numup++;
				echo "<tr>";
				echo "<td>" . $numup . "</td>";
				echo "<td>" . $tuple['first_name'] . "</td>";
				echo "<td>" . $tuple['last_name'] . "</td>";
				echo "<td>" . $tuple['metrima'] . "</td>";
				echo "</tr>";							
            }
        }

        $conn->close();
        ?>
    </table>
</body>

</html>