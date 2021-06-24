<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	include "../database/config.php";
	$student_username=$_POST["studentUsername"];
	$student_password=$_POST["studentPassword"];
	//$enc_password=hash('sha256',$password,false);
	$sql="SELECT * from student_data where username='$student_username' AND password='$student_password'";
	$res=mysqli_query($conn,$sql);

	if(mysqli_num_rows($res) == 1)
	{
		echo "success";		
		$row = mysqli_fetch_assoc($res);
		$_SESSION["player_id"] = $row["id"];	
		$_SESSION["player_id"] = $row["id"];	

//		echo "<script> window.location.assign('playerStart.php');</script>";

	
	}
	else
	{
		echo "fail";
		// $file=fopen("logs.txt","a") or die("Something went wrong");
        // fwrite($file,"[$date] - " . mysqli_error($conn)."\r\n");
        // fclose($file);
	}
}
?>