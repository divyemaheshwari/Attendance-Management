<?php
require_once("includes/databaseconnect.php");
require_once("includes/php_script.php");


if(!isset($_SESSION['sid']))
{
	header("Location: http://localhost/PBL/dbms/");
}



if(isset($_POST['logout']))
{
	session_unset();
	session_destroy(); 
	header("Location: http://localhost/PBL/dbms/"); 
}
	//in_array(needle, haystack)
?>
<html>

<head>
	<title>Student</title>
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
		<h1 align="center">Registeration Number <font color="red"><?php echo (strtoupper($_SESSION['sid']));?></font> Logged In </h1>
		<form method="post" style="float:right;">
			<button type="submit" name="logout" value="logout" class="btn btn-info">Logout</button>
		</form><br><br><br><br><br>
		<h3>View Attendence From Courses</h3><br>

		<?php
		$regno = $_SESSION['sid'];
		$q = "SELECT  `course_id` FROM `stud_courses` WHERE regno = '$regno'";
		if($result = mysqli_query($connection,$q))
		{

			while($row = mysqli_fetch_assoc($result))
			{
				$cid = $row['course_id'];

				echo '<div class="panel-group"><div class="panel panel-default"><div class="panel-heading"><h4 class="panel-title">';
				echo "<a data-toggle='collapse' href='#collapse$cid'>$cid</a>";
				echo "</h4></div><div id='collapse$cid' class='panel-collapse collapse'><div class='panel-body'>";

				$tclass = $tpre = 0;
				$present = array();
				$absent = array();

				$quer = "SELECT * From attendence where course_id = '$cid' ORDER BY `date` DESC;";
				if($result1 = mysqli_query($connection,$quer))
				{
					echo("<table class=table table-striped table-hover table-condensed>");
					echo("<thead>");
					echo"<tr>";
					echo"<th>Date</th>";
					echo"<th>Status</th>";
					echo"</tr>";
					echo"</thead>";
					echo"<tbody>";
					while($row1 = mysqli_fetch_assoc($result1))
					{
						$found = $ispresent = 0;
						$present = explode(",", $row1['present']);
						$absent = explode(",", $row1['absent']);

						if(in_array($regno, $present))
						{
							$tpre ++;
							$tclass ++;
							$found = 1;
							$ispresent = 1;
						}
						elseif(in_array($regno,$absent))
						{
							$tclass ++;
							$found = 1;
						}
						if($found == 1)
						{
							echo("<tr>");
							$d = $row1['date'];
							print_r("<td>".$d."</td>");
							if($ispresent == 1)
								echo("<td><font color='green'><strong>Present</strong></font></td></tr>");
							else
								echo("<td><font color='red'><strong>Absent</strong></font></td></tr>");
						}	
					}
					echo"</tbody>";
					echo"</table>";
					echo ("Total Classes:&nbsp".$tclass."<br>");							
					echo ("Classes Preasent:&nbsp&nbsp".$tpre."<br><br><br>");
					if($tclass != 0)
					$centage = ($tpre/$tclass)*100;
					else
					$centage = 0;
					$centage = ceil($centage);
					echo'<div class="progress">';
					echo"	<div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='$centage'";
					echo"aria-valuemin='0' aria-valuemax='100' style='width:$centage%''>";
					echo "$centage'% Attendence";
					echo'</div>
				</div>'; 




			}
			echo"</div></div></div></div><br>";
		}
	}
	?>

	<hr><br>
	<?php

	if(isset($_POST['mail']))
	{

		if(!empty($_POST['mail']) && !empty($_POST['mmail']))
		{
			$to = $_POST['mail'];
			$message = $_POST['mmail'];
			$subject = "Attendence Dispute";

			mail($to,$subject,$message);
			print '<script type="text/javascript">'; 
			print 'alert("Your Mail Has Succefully Been Sent")'; 
			print '</script>';
		}
		else
		{
			print '<script type="text/javascript">'; 
			print 'alert("Email Or The Message Not Enterd")'; 
			print '</script>';
		}
	}

	?>

	<form method="post">
		<h3><font color="red">Make Direct Contact</font></h3><br>
		<strong>Send Email To</strong>
		<input type="email" name="mail" class="form-control" style = "width: 400px;" placeholder="Enter The Fculty Mail-ID "><br>
		<textarea name="mmail" class="form-control" placeholder="In Case Of Any Dispute In Attendence"></textarea><br>
		<button name="mail" value="submit" class="btn btn-info">Send Mail</button>

	</form>
</div>
</body>
</html>
