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

    <title> Database Analytsis </title>

</head>

<body>
    <?php include('navbar.php'); ?>
    <table class="table table-hover table-success table-striped table-borderless">
        <thead>
            <tr>
                <th>#</th>
                <th>Researcher name</th>
				 <th>Researcher surname</th>
                <th>Count of no deliver projects (>3) </th>
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


        $quer = "SELECT Ereunitis1.ID_Ereuniti , CONCAT(Ereunitis1.First_Name, ' ', Ereunitis1.Last_Name) AS Onomatepwnimo , COUNT(X.ID_Ergou) AS metritis_ergon 
        FROM 
        ( 
        SELECT ID_Ergou FROM ergo_epixorigisi 
        WHERE ID_Ergou NOT IN ( SELECT ID_Ergou FROM paradoteo ) 
        ) X 
        INNER JOIN Works_On Y ON X.ID_Ergou = Y.ID_Ergou 
        INNER JOIN Researcher Ereunitis1 ON Y.ID_Ereuniti = Ereunitis1.ID_Ereuniti 
        GROUP BY Ereunitis1.ID_Ereuniti 
        HAVING metritis_ergon >= 5;";

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
				echo "<td>" . $tuple['surname'] . "</td>";
				echo "<td>" . $tuple['total'] . "</td>";
				echo "</tr>";							
            }
        }

        $conn->close();
        ?>
    </table>
</body>

</html>