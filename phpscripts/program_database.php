<!DOCTYPE html>
<html lang="en">

<style>
    thead th {
        font-size: 1.4em;
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

    <title> Program Analysis </title>

</head>

<body>
    <?php include('navbar.php'); ?>
    <table class="table table-hover table-success table-striped table-borderless">
        <thead>
            <tr>
                <th>#</th>
                <th>Program_Address</th>
                <th>Names</th>
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
			
        $quer = 'SELECT * FROM program';

        $res = mysqli_query($conn, $quer);

        $num = 0;

        if (mysqli_num_rows($res) == 0) {
            echo "<h4>There are no programs</h4>";
        } else {

            while ($tuple = mysqli_fetch_assoc($res)) {

                $num++;
				echo "<tr>";
				echo "<td>" . $num . "</td>";
                echo "<td>" . $tuple['Program_Address'] . "</td>";
                echo "<td>" . $tuple['Names'] . "</td>";
                echo "</tr>";
				echo "</details>";
            }
        }

        $conn->close();
        ?>
    </table>
</body>

</html>