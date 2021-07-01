<?php
session_start();
if(!isset($_SESSION["player_id"]))

?>

<?php
include '../database/config.php';
$resultCode = $_POST["testCode"];

$_SESSION['code'] = $resultCode;

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
  <source src="../assets/map2.mp3" type="audio/mpeg" />
</audio>
<div class="gameWrapper" >
    <div class="mainHolder">
		<div class="canvasHolder">
			<center>
        	<div class="gameCanvas" style="background-image:url('../assets/BACKGROUNDS/2.png');">
        		<div class="row" id="settingsRow" >
					<div class="col-md-10">
                    <button id="backBtn" hidden ><i class="fa fa-chevron-left  fa-lg" hidden></i> Back</button>
					</div>

					<div class="col-md-2">
                        <button id="musicBtn" onclick="pauseMusic()"><img src="../assets/BUTTONS 2/sound-on.png" alt="" width="40px" id="soundImg"> </button>
                        <a href="studentLogout.php"> <img src="../assets/BUTTONS 2/logout.png" alt="" width="40px"> </i></a> 
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

	function start(){
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