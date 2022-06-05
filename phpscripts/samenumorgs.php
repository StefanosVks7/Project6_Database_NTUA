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
                <th>Organisations with same num of projects</th>
                <th>Number of Same Projects (>3)</th>
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

        $quer = "SELECT Organization.ID_Organismou , Organization.Name , Organization.Syntomografia, 
        X. Y AS Year, Projects_fetina 
        FROM ( 
             SELECT DISTINCT ID_Organismou AS O, YEAR(Start_Date) as Y,
              ( 
                 SELECT count(*) 
                 FROM ergo_epixorigisi 
                 WHERE YEAR(Start_Date) = Y 
                 AND ID_Organismou = O 
              ) AS Projects_fetina , 
              ( 
                 SELECT count(*) 
                 FROM ergo_epixorigisi 
                 WHERE YEAR(Start_Date) + 1 = Y 
                 AND ID_Organismou = O 
              ) AS Projects_persina 
              FROM ergo_epixorigisi 
              HAVING Projects_fetina = Projects_persina 
              AND Projects_fetina >= 10 
              ORDER BY O 
            ) X INNER JOIN Organization ON Organization.ID_Organismou = X.O;";

        $res = mysqli_query($conn, $quer);

        $num = 0;

        if (mysqli_num_rows($res) == 0) {
            echo "<h4>There are no programs</h4>";
        } else {
            while ($tuple = mysqli_fetch_assoc($res)) {
                $num++;
                echo "<tr>";
                echo "<td>" . $num . "</td>";
                echo "<td>" . $tuple['ID_Organismou'] . "</td>";
                echo "<td>" . $tuple['Projects_fetina'] . "</td>";
                echo "</tr>";
            }
        }

        $conn->close();
        ?>
    </table>
</body>

</html>