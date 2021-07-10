<?php
session_start();
	include "../database/config.php";

$current_student_id = $_POST['currrent_student1'];
$current_student_test = $_POST['current_test1'];


$currentProgres="SELECT progress from students where student_id= $current_student_id AND test_id = $current_student_test";
$progressResult = mysqli_query($conn,$currentProgres);
$rowProgres = mysqli_fetch_assoc($progressResult);
$currentProgress = (int) $rowProgres['progress'];

$finalProgress= $currentProgress +1;

		//updating students score
		$studentNewScore = "UPDATE students SET progress ='$finalProgress' where student_id='$current_student_id' AND test_id = '$current_student_test'";
		$saveScore = mysqli_query($conn,$studentNewScore);


?>