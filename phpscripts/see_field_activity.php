<!DOCTYPE html>

<html lang="en">

<style>
    thead th {
        font-size: 1.4em;
		  background-color: #AA556D;
			color: white;
    }

    .navbar-nav li:hover>.dropdown-menu {
        display: block;
    }
	
	.column {
		float: left;
		width: 50%;
		padding: 5px;
	}
	.row::after {
		content: "";
		clear: both;
		display: table;
		}

</style>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title> Database Analysis </title>

</head>

<body style="background-color:powderblue;">
    <?php include('navbar.php');?>
    
	<?php
        $host = "127.0.0.1";
        $port = 3306;
        $socket = "";
        $user = "root";
        $password = "";
        $dbname = "project_team_6";
		
        $conn = new mysqli($host, $user, $password, $dbname, $port, $socket)
            or die('Could not connect to the database server' . mysqli_connect_error());

		if(!empty($_GET['varname1']) && !empty($_GET['varname2'])){
			$name_science_field = $_GET['varname1'];
			$code_anaforas = $_GET['varname2'];	
		} 
        $quer1 = 'SELECT ergo_epixorigisi.ID_Ergou, Title 
		FROM ergo_epixorigisi INNER JOIN epistimoniko_pedio_ergou 
		ON ergo_epixorigisi.ID_Ergou = epistimoniko_pedio_ergou.ID_Ergou 
		WHERE Name_Science_Field = "Flagship Projects" 
		AND DATEDIFF(ergo_epixorigisi.End_Date, NOW()) > 0;';
		
        $res = mysqli_query($conn, $quer1);

        $num = 0;
		
        if (mysqli_num_rows($res) == 0) {
            echo "<h4>There are no projects</h4>";
        } 
		else 
		{
			echo "<p style=\"text-align:center; margin-top:30px; margin-bottom:30px; font-size: 1.7em \">  ".$name_science_field." </p>";
			echo "<details style=\"font-size: 1.5em; margin-left:16px; margin-top:20px; margin-bottom:20px\">";
			echo "<summary style=\"font-size: 1.5em; margin-top:20px; margin-bottom:20px \"> Project names </summary>";
		
		
		
			while ($tuple = mysqli_fetch_assoc($res)) {
					$num++;	
					echo "<p style=\"margin-left:64px\">".$num .". ";
					echo "".$tuple['Title'] ."</p>";
			}
			echo "</details>";
		}
		$quer2 = "SELECT Researcher.ID_Ereuniti, CONCAT(Researcher.First_Name,' ',Researcher.Last_Name) 
		AS Full_Name, works_on.Enarxi_enasxolisis 
		FROM epistimoniko_pedio_ergou INNER JOIN ergo_epixorigisi 
		ON ergo_epixorigisi.ID_Ergou = epistimoniko_pedio_ergou.ID_Ergou 
		AND Name_Science_Field = 'Flagship Projects' 
		INNER JOIN works_on 
		ON ergo_epixorigisi.ID_Ergou = works_on.ID_Ergou 
		INNER JOIN researcher 
		ON works_on.ID_Ereuniti = researcher.ID_Ereuniti 
		WHERE DATEDIFF(NOW(), works_on.Enarxi_enasxolisis) > 365 
		GROUP BY researcher.ID_Ereuniti;";

        $res = mysqli_query($conn, $quer2);

        $num = 0;
		
        if (mysqli_num_rows($res) == 0) {
            echo "<h4>There are no researchers</h4>";
        } else {
			echo "<details style=\"font-size: 1.5em; margin-left:16px; margin-top:20px; margin-bottom:20px\">";
			echo "<summary style=\"font-size: 1.4em; margin-top:20px; margin-bottom:20px\"> Researcher names </summary>";
		   while ($tuple = mysqli_fetch_assoc($res)) {
                $num++;		
                echo "<p style=\"margin-left:64px\">".$num .". ";
                echo "".$tuple['Full_Name']." ";
		   }
        }
		
        $conn->close();
        ?>
    </table>
</body>

</html>