<?php
require("includes/databaseconnect.php");
require("includes/php_script.php");

?>


<html>

<head>
	<title>Attendence</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="bootstrap/js/jquery.js"></script>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="bootstrap/js/jquery.js"></script>
	<script src="includes/java_script.js"></script>
</head>


<body style="padding:20px;">
	<h1 align="center"><font color=red>Attendence Management System</font></h1>

	<div class="container" style="border-radius: 10px; padding: 50px;">

		<ul class="nav nav-tabs">
			<li><a data-toggle="tab" href="#menu1">Student Sign-Up</a></li>
			<li><a data-toggle="tab" href="#menu2">Faculty Sign-Up</a></li>
			<li><a data-toggle="tab" href="#menu3">Student Login</a></li>
			<li><a data-toggle="tab" href="#menu4">Faculty Login</a></li>
		</ul>

		<div class="tab-content">

			<div id="home" class="tab-pane fade in active">
				<br><br>
				<p style="font-size: 18px;">Attendance management is the act of managing attendance or presence in a work setting to minimize loss due to employee downtime.Attendance control has traditionally been approached using time clocks, timesheets, and time tracking software, but attendance management goes beyond this to provide a working environment which maximises and motivates employee attendance.Recently it has become possible to collect attendance data automatically through using Real-time location systems, which also allow for cross-linking between attendance data and performance.</p>
			</div>

			<div id="menu1" class="tab-pane fade">
				<br>
				<form method="post">
					<br><br>
					<strong>Name</strong><br>
					<input type="text" name="name" class="form-control" placeholder="Student Name"><br><br>
					<strong>Registration Number</strong><br>
					<input type="text" name="regno" class="form-control" placeholder="Registration Number"><br><br>
					<strong>Password</strong><br>
					<input type="password" name="pass" class="form-control" placeholder="Password"><br><br>
					
					<div style="padding:30px;border: 2px solid black;height: 500px;overflow-y: scroll;border-radius: 10px;">	
						<h1>Course Selection</h1>				
						<?php

						$q = "SELECT DISTINCT course_id FROM fac_courses;";
						if($result = mysqli_query($connection,$q))
						{
							while($row = mysqli_fetch_assoc($result))
							{
								$c = $row['course_id'];
								echo "<h3><font color=red>".$c."</font></h3>";
								$q1 = "SELECT fac_name,faculty.fac_id FROM faculty INNER JOIN fac_courses ON fac_courses.fac_id=faculty.fac_id WHERE course_id = '$c'";

								if($result1 = mysqli_query($connection,$q1))
								{
									echo("<table class=table table-striped table-hover table-condensed>");
									echo("<thead>");
									echo"<tr>";
									echo"<th>Faculty</th>";
									echo"<th>Please Select</th>";
									echo"</tr>";
									echo"</thead>";
									echo"<tbody>";
									while($row1 = mysqli_fetch_assoc($result1))
									{
										$f = $row1['fac_name'];
										$fi = $row1['fac_id'];
										$ch = "<input type='checkbox' value = '$c,$fi' name = faculty[]>" ;
										echo"<tr>";
										print_r("<td>".$f."</td>");
										print_r("<td>".$ch."</td>");
										echo"</tr>";
									}
									echo"</tbody>";
									echo"</table>";
								}
							}
						}

						?>
					</div><br><br>


					<input type="submit" name="ssignup" class="btn btn-danger">
				</form>
			</div>
			
			<div id="menu2" class="tab-pane fade">
				
				<form method="post">
					<br><br>
					<strong>Name</strong><br>
					<input type="text" name="name" class="form-control" placeholder="Faculty Name"><br><br>
					<strong>Faculty Id</strong><br>
					<input type="text" name="facid" class="form-control" placeholder="Faculty Id"><br><br>
					<strong>Password</strong><br>
					<input type="password" name="pass" class="form-control" placeholder="Password"><br><br>
					<strong>Select Course To Teach</strong>
					<?php
					$q = "SELECT * from courses";
					
					echo("<select name='subject' class = 'form-control'");
					echo "<option value = '#'>Choose A Subject</option>";

					if($result = mysqli_query($connection,$q))
						while($row = mysqli_fetch_assoc($result))
						{
							$o = $row['course_title'];
							$id = $row['course_id'];
							echo "<option value='$id'>$o</option>";	
						}
						echo("</select><br><br>");
						?>


						<input type="submit" name="facsignup" class="btn btn-danger">
					</form>
				</div>

				<div id="menu3" class="tab-pane fade" >
					<form method="post">
						<br><br>
						<strong>Registration No.</strong><br>
						<input type="text" name="reg" class="form-control" placeholder="Registration Number"><br><br>
						<strong>Password</strong><br>
						<input type="password" name="pass" class="form-control" placeholder="Password"><br><br>
						<input type="submit" name="slogin" class="btn btn-danger">
					</form>
				</div>

				<div id="menu4" class="tab-pane fade">
					<form method="post">
						<br><br>
						<strong>Faculty Id</strong><br>
						<input type="text" name="reg" class="form-control" placeholder="Faculty Id"><br><br>
						<strong>Password</strong><br>
						<input type="password" name="pass" class="form-control" placeholder="Password"><br><br>
						<input type="submit" name="flogin" class="btn btn-danger">
					</form>
				</div>

			</div>
		</div>
	</body>
	</html>



























