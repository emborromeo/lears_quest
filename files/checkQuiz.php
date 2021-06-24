<?php
session_start();
	include "../database/config.php";

$current_student_id = $_POST['currrent_student'];


$currentScore="SELECT score, progress from students where student_id= $current_student_id";
$scoreResult = mysqli_query($conn,$currentScore);
$rowScore = mysqli_fetch_assoc($scoreResult);
$finalCurrentScore = (int) $rowScore['score'];
$currentProgress = (int) $rowScore['progress'];

$finalscore=  $finalCurrentScore +1;
$finalProgress=  $currentProgress +1;

		//updating students score
		$studentNewScore = "UPDATE students SET score = '$finalscore', progress ='$finalProgress' where student_id='$current_student_id'";
		$saveScore = mysqli_query($conn,$studentNewScore);



?>