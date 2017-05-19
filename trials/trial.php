<?php
if(isset($_POST['report']))
{
	echo "reached in the first if";
	$dates = $_POST['date1'];
	echo $dates;
	$datee = $_POST['date2'];
	echo "<br>".$datee;
	
	echo "<br>the difference bw the date is";
	echo $datee-$dates;

	
}
?>