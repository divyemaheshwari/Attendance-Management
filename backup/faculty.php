<?php
require("includes/databaseconnect.php");
require("includes/php_script.php");


if(empty($_SESSION['fid']))
{
	header("Location: http://localhost/PBL/dbms/");	
}
require("includes/php_script.php");
if(isset($_POST['logout']))
{
	session_unset();
	session_destroy(); 
	header("Location: http://localhost/PBL/dbms/"); 
}
?>

<html>

<head>
	<title>Faculty</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="bootstrap/js/jquery.js"></script>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="bootstrap/js/jquery.js"></script>
	<script src="includes/java_script.js"></script>
</head>

<body>
	<div class="container" style="padding: 50px;"> 
		<h1 align="center">Faculty With The ID <font color="red"><?php echo $_SESSION['fid'];?></font> Logged In </h1>

		<form method="post" style="float: right;">
			<button type="submit" name="logout" value="logout" class="btn btn-info">Logout</button>
		</form><br><br><br><br><br><br>

		<div class="panel-group">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" href="#collapse1">Take Attendence</a>
					</h4>
				</div>
				<div id="collapse1" class="panel-collapse collapse">
					<div class="panel-body">
						<form method="post">
							<?php
							$fac = $_SESSION['fid'];
							$q = "SELECT * FROM student_teacher WHERE fac_id = '$fac'";
							if($result = mysqli_query($connection,$q))
							{
								echo("<table class=table table-striped table-hover table-condensed>");
								echo("<thead>");
								echo"<tr>";
								echo"<th>Student Name</th>";
								echo"<th>Registration Number</th>";
								echo"<th>Present</th>";
								echo"<th>Absent</th>";
								echo"</tr>";
								echo"</thead>";
								echo"<tbody>";
								while($row = mysqli_fetch_assoc($result))
								{
									$regid = $row['regno'];

									$q1 = "SELECT stud_name FROM student WHERE regno = '$regid';";
									$result1 = mysqli_query($connection,$q1);
									$row1 = mysqli_fetch_assoc($result1);
									$na = $row1['stud_name'];
									$present = "<input type = 'checkbox' value = '$regid' name = present[]";
									$absent = "<input type = 'checkbox' value = '$regid' name = absent[]";
									echo"<tr>";
									print_r("<td>".$na."</td>");
									print_r("<td>".$regid."</td>");
									print_r("<td>".$present."</td>");
									print_r("<td>".$absent."</td>");
									echo"</tr>";
								}
								echo"</tbody>";
								echo"</table>";
								echo "<input type='hidden' name='hidden' value='$fac'>";
								echo "<input type='date' name='date' class='form-control'><br><br>";
							}
							?>
							<button type="submit" name="mark" value="submit" class="btn btn-warning">Mark</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
