<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="post" action="trial.php">
		<H1>Report</H1>
		<strong>Start Date:</strong> 
		<input type="date" name="date1" class="form-control" placeholder="The Date For Which You Want To Change"><br>

		<strong>End Date:</strong> 
		<input type="date" name="date2" class="form-control" placeholder="The Date For Which You Want To Change"><br>
		<input type="hidden" name="fid" value=<?php echo($fac) ?>>

		<button name="report" value="submit" class="btn btn-danger">Generate Report</button>
	</form>
</body>
</html>