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
                <th>Pedio1</th>
                <th>Name1</th>
                <th>Pedio2</th>
                <th>Name2</th>
				<th>pair_count</th>
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



        $quer = "SELECT Pedio_1 , N1.Name_Science_Field AS Name_1, Pedio_2 , N2.Name_Science_Field AS Name_2 , pair_count FROM ( SELECT DISTINCT A.Code_anaforas AS Pedio_1 , B.Code_anaforas AS Pedio_2 , ( SELECT COUNT(*) FROM epistimoniko_pedio_ergou AA INNER JOIN epistimoniko_pedio_ergou BB ON AA.ID_Ergou = BB.ID_Ergou WHERE AA.Code_anaforas = A.Code_anaforas AND BB.Code_anaforas = B.Code_anaforas AND AA.Code_anaforas <> BB.Code_anaforas ) AS pair_count FROM epistimoniko_pedio_ergou A INNER JOIN epistimoniko_pedio_ergou B ON A.ID_Ergou = B.ID_Ergou WHERE A.Code_anaforas < B.Code_anaforas ORDER BY pair_count DESC LIMIT 3 ) AS top_pairs INNER JOIN epistimoniko_pedio N1 ON N1.Code_anaforas = top_pairs.Pedio_1 INNER JOIN epistimoniko_pedio N2 ON top_pairs.Pedio_2 = N2.Code_anaforas;";

        $res = mysqli_query($conn, $quer);

        $numup = 0;

        if (mysqli_num_rows($res) == 0) {
            echo "<h4>There are no programs</h4>";
        } else {

            while ($tuple = mysqli_fetch_assoc($res)) {

                $numup++;
					if ($numup < 7) {
						echo "<tr style = \"background-color: powderblue;\">";
						echo "<td>" . $numup . "</td>";
						echo "<td>" . $tuple['Pedio_1'] . "</td>";
						echo "<td>" . $tuple['Name_1'] . "</td>";
						echo "<td>" . $tuple['Pedio_2'] . "</td>";
                        echo "<td>" . $tuple['Name_2'] . "</td>";
                        echo "<td>" . $tuple['pair_count'] . "</td>";
						echo "</tr>";			
					}
					else {
						echo "<tr>";
						echo "<td>" . $numup . "</td>";
						echo "<td>" . $tuple['Pedio_1'] . "</td>";
						echo "<td>" . $tuple['Name_1'] . "</td>";
						echo "<td>" . $tuple['Pedio_2'] . "</td>";
                        echo "<td>" . $tuple['Name_2'] . "</td>";
                        echo "<td>" . $tuple['pair_count'] . "</td>";
						echo "</tr>";			
					}
					
            }
        }

        $conn->close();
        ?>
    </table>
</body>

</html>