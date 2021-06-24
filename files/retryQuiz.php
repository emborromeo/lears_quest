<?php
session_start();
	include "../database/config.php";

$current_student_id = $_POST['currrent_student'];

		//updating students score
		$studentNewScore = "UPDATE students SET score = 0, progress =0 where student_id='$current_student_id'";
		$saveScore = mysqli_query($conn,$studentNewScore);



?>