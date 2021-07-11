<?php
session_start();
if(!isset($_SESSION["player_id"]) && ($_SESSION["code"]) ){
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

	
	$testCode = "SELECT * FROM tbl_tests WHERE generatedCode = '$currentCode'";
	$resultTest = mysqli_query($conn,$testCode);
	$rowTest = mysqli_fetch_assoc($resultTest);
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
<audio id="btnClick">
  <source src="../assets/SOUNDS/button.wav" type="audio/mpeg"/>
</audio>
<div class="gameWrapper" style="background-image:url('../assets/BACKGROUNDS/1.png');background-size:100% 100%;">
    <div class="mainHolder">
		<div class="canvasHolder">
			<center>

		
        	<div class="gameCanvas" style="display: contents;">
			
        	<div class="row" id="settingsRow" >
					<div class="col-lg-10 col-9">
                    <button id="backBtn" hidden ><i class="fa fa-chevron-left  fa-lg" hidden></i> Back</button>
					</div>

					<div class="col-lg-2 col-3">
                        <button id="musicBtn" onclick="pauseMusic()"><img src="../assets/BUTTONS 2/sound-on.png" alt="" style="width: 3vw;"  id="soundImg"> </button>
                        <a href="studentLogout.php"> <img src="../assets/BUTTONS 2/logout.png" alt="" style="width: 3vw;"> </i></a> 
					</div>

			 	</div>
				 <div class="row justify-content-center" id="finalBoard" style="display: contents; padding:40px">
					<center>				 
						<div class="container-final" style="background-image: url('../assets/BOARDS/final-board.png'); ">
                     <div class="container" style="padding-top:16vw;    height: 50vh;">
					<div class="col-12" style="display:contents">
                        <h1 id="finalScoreNum"><?= $studentScore?></h1>
						<div id="collectedStars">
						
						</div>
						<div id="collectedBadges">
						<img src="../assets/BADGES/50.png" id="badge50"  alt="" style="width:7vw" >
						<img src="../assets/BADGES/Finish.png" id="badgeFinish"  alt=""  style="width:7vw" >
						<img src="../assets/BADGES/Pass.png" id="badgePass"  alt="" style="width:7vw" >				
						<img src="../assets/BADGES/100.png" id="badge100"  alt=""  style="width:7vw" >
						<img src="../assets/BADGES/Low Score.png" id="badgeLow"  alt=""  style="width:7vw" >
						</div>
					</div>
                    <br>
					<div class="col-12"  style="display:contents">
                    	<a href="#"><button class="role-form-bn" onclick="retryQuiz()" id="retryBtn"><img src="../assets/BUTTONS 2/retry-btn.png" alt="" style="width: 8vw;"></button></a> 
					</div>					
				</center>

				</div>

				 </div>
				 </div>
			</div>	
		</center>
		</div>

	</div>
</div>
		
		
	
<script>
		let btnClick  = document.getElementById("btnClick");

	    let finalScore = <?php echo (int) ($studentScore) ; ?>;
		document.getElementById("badge100").style.display="none";

		let testTotal  = <?php echo (int) ($rowTest['total_questions']); ?>; 


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
                            
	for(let x=0; x<finalScore;x++){
									  
	let starsDiv = document.getElementById("collectedStars"); 

	let star = document.createElement("img"); 
    star.src="../assets/BUTTONS 2/Stars.png";
	star.style.width="5vw";

	starsDiv.appendChild(star);  

	//Print out the newly created content document.body.insertBefore(newDiv, currentDiv); 	   
			   
	 }

	 let passingScore= testTotal * .75;

	 if(finalScore>=passingScore){
		 document.getElementById("badgeLow").style.display="none";
	 }
	 else if(finalScore<passingScore){
		 document.getElementById("badgePass").style.display="none";
	 }


if(finalScore==testTotal){
		document.getElementById("badge100").style.display="inline";
	 }
							
   function retryQuiz(){
    let studentid = <?php echo (int) $student_id; ?>;
    let currentCode = <?php echo json_encode($currentCode) ; ?>;
	btnClick.play();

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
   
    //loop create element heres

	//show badges

</script>
</body>
</html>