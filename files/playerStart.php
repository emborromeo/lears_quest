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
				<div class="row justify-content-md-center">

					<div class="col-12" style="display:contents">
						<img src="../images/title-sample1.png" alt="" style="width: 50%">
					</div>

					<div class="col-12"  style="display:contents">
                        <a href="playerMap.php?quiz_code=<?php echo $resultCode;?>"> <button class="role-form-bn"> <img src="../images/btn-start.png" alt="" style="width: 20%;"></button></a>
					</div>
				</div>

			</div>
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
        }
        else {
            bgMusic.pause();
        }
    }
</script>
</body>
</html>