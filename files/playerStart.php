<?php
session_start();


if(!isset($_SESSION["player_id"]) )
//$resultCode = $_POST["testCode"];
//$resultCode1 = $_REQUEST['test_code'];



?>

<?php
include '../database/config.php';

$resultCode = $_REQUEST['testCode'];

$_SESSION['code'] = $resultCode;
$student_id = $_SESSION['player_id'];

$testCode = "SELECT * FROM tbl_tests WHERE generatedCode = '$resultCode' ";
$resultTestId = mysqli_query($conn,$testCode);
$rowTest = mysqli_fetch_assoc($resultTestId);
$testId = (int) $rowTest['id'];

$_SESSION['test_id'] = $testId;


$studentScore = "INSERT INTO students (test_id, student_id, score) VALUES('$testId', '$student_id' ,'0') ";
$insertStudent= mysqli_query($conn, $studentScore);
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
	<source src="../assets/SOUNDS/start.mp3" type="audio/mpeg"/>
</audio>
<audio id="btnClick">
  <source src="../assets/SOUNDS/button.wav" type="audio/mpeg"/>
</audio>
<div class="gameWrapper" style="background-image:url('../assets/BACKGROUNDS/2.png');background-size:100% 100%;";">
    <div class="mainHolder">
		<div class="canvasHolder">
			<center>
        	<div class="gameCanvas" style=" display:contents;">
        		<div class="row" id="settingsRow" >
					<div class="col-lg-10 col-9">
                    <button id="backBtn" hidden ><i class="fa fa-chevron-left  fa-lg" hidden></i> Back</button>
					</div>

					<div class="col-lg-2 col-3">
                        <button id="musicBtn" onclick="pauseMusic()"><img src="../assets/BUTTONS 2/sound-on.png" alt="" style="width: 3vw;"  id="soundImg"> </button>
                        <a href="studentLogout.php"> <img src="../assets/BUTTONS 2/logout.png" alt="" style="width: 3vw;"> </i></a> 
					</div>

			 	</div>
				<div class="row justify-content-center" style="display: contents;">

					<div class="col-12" style="display:contents">
						<center><img src="../assets/TITLE/title-start	.png" alt="" style="width: 60vw"> </center>
					</div> <br>  	
					<div class="col-12"  style="display:contents">
                        <center> <a href="playerMap.php?quiz_code=<?php echo $resultCode;?>"> <button class="role-form-bn"> <img src="../assets/BUTTONS 2/start-btn.png" alt="" style="width: 20vw" id="startBtn"></button></a></center>
					</div>
				</div>

			</div> 
		</center>
		</div>

	</div>
</div>
		
		
	
<script>
    let btnClick  = document.getElementById("btnClick");

	function start(){
	btnClick.play();

	window.location.replace("playerMap.php");

	}
    function pauseMusic(){
        let bgMusic= document.getElementById("bgMusic");

        if(bgMusic.paused) {
            bgMusic.play();
			document.getElementById("soundImg").src="../assets/BUTTONS 2/sound-on.png";

			
        }
        else {
            bgMusic.pause();
			document.getElementById("soundImg").src="../assets/BUTTONS 2/sound-off.png";
        }
    }
</script>
</body>
</html>