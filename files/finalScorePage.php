<?php
session_start();
if(isset($_SESSION["player_id"]) && ($_SESSION["code"]) ){
}

?>

<?php
include '../database/config.php';
$student_id = $_SESSION['player_id'];
$currentCode = $_SESSION['code'];

//$resultCode = $_POST["testCode"];
    $studentInfo = "SELECT * FROM students WHERE student_id = '$student_id'";
	$resultStudent = mysqli_query($conn,$studentInfo);
	$rowStudent = mysqli_fetch_assoc($resultStudent);

	$studentScore = (int) $rowStudent['score'];
?>
<html>
	<head>
		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title>Lear's Quest</title>
	    <link rel="icon" type="image/png" href="../admin/assets/img/favicon.png">
		<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/util.css">
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="../vendor/tilt/tilt.jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>

	</head>

<body>
<audio id="bgMusic" loop autoplay>
  <source src="../images/map2.mp3" type="audio/mpeg" />
</audio>
<div class="gameWrapper" >
    <div class="mainHolder">
		<div class="canvasHolder">
        	<div class="gameCanvas" style="width: 1024px; height:640px;">
        		<div class="row" id="settingsRow" >
					<div class="col-md-10">
                    <button id="backBtn" hidden ><i class="fa fa-chevron-left  fa-lg" hidden></i> Back</button>
					</div>

					<div class="col-md-2">
                        <button id="musicBtn" onclick="pauseMusic()"><i class="fa fa-music fa-2x"></i></button>
                        <a href="studentLogout.php"> <i class="fa fa-sign-out fa-2x" style="color:#679847"> </i></a> 
					</div>

			 	</div>
				<div class="row justify-content-md-center" style="display: contents; padding:40px">

					<div class="col-12" style="display:contents">
						<h1>Your Final Score is</h1>
                        <h1><?= $studentScore?></h1>

					</div>
                    <br>
					<div class="col-12"  style="display:contents">
                    <a href="#"><button class="role-form-bn" onclick="retryQuiz()">Retry</button></a>
					</div>
				</div>

			</div>
		</div>

	</div>
</div>
		
		
	
<script>
    function pauseMusic(){
        let bgMusic= document.getElementById("bgMusic");

        if(bgMusic.paused) {
            bgMusic.play();
        }
        else {
            bgMusic.pause();
        }
    }
      
   function retryQuiz(){
    let studentid = <?php echo (int) $student_id; ?>;
    let currentCode = <?php echo json_encode($currentCode) ; ?>;

    $.ajax({
      url: "retryQuiz.php",
      type: "POST",
      data:{"score":0,
      "currrent_student":studentid},
	  success: function(data){
		window.location = "playerMap.php?quiz_code=currentCode";

	}
    })

   }
 
</script>
</body>
</html>