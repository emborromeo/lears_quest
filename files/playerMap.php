<?php
session_start();
if(isset($_SESSION["player_id"]) && ($_SESSION["code"]) ){

//	$test_code = $_REQUEST['quiz_code'];
  //  $_SESSION['codeQuiz'] = $test_code;

	  //if question is answegray 2

	//$var_value = $_SESSION['varname'];
}

?>
<?php
	include '../database/config.php';
	$student_id = $_SESSION['player_id'];
	$ccode = $_SESSION['code'];
	$testId = $_SESSION['test_id'];
 
	$testCode = "SELECT * FROM tbl_tests WHERE generatedCode = '$ccode'";
	$resultTest = mysqli_query($conn,$testCode);
	$rowTest = mysqli_fetch_assoc($resultTest);
	$testId = (int) $rowTest['id'];


    $sql = "SELECT question_id FROM question_test_mapping WHERE test_id = $testId";
    $result = mysqli_query($conn,$sql);

    $row1;                     
        while($row = mysqli_fetch_assoc($result)) {
            $question_id = $row["question_id"];
            $sql1 = "SELECT * FROM tbl_questions WHERE id = $question_id" ;
            $result1 = mysqli_query($conn,$sql1);
            $row1 = mysqli_fetch_assoc($result1);
		}
	//total questions
	$totalQuests="SELECT COUNT(*) FROM question_test_mapping WHERE test_id=$testId";
	$resultQuest = mysqli_query($conn,$totalQuests);
	$rowQuest = mysqli_fetch_assoc($resultQuest);

	//	getting students score and progress
	$studentInfo = "SELECT * FROM students WHERE student_id = '$student_id' AND test_id = '$testId'";
	$resultStudent = mysqli_query($conn,$studentInfo);
	$rowStudent = mysqli_fetch_assoc($resultStudent);

	$studentScore = (int) $rowStudent['score'];
	$studentProgress = (int) $rowStudent['progress'];

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
		<link href="//db.onlinewebfonts.com/c/d03165bd677535fe8da7479e26b13180?family=AzoSansUberW01-Regular" rel="stylesheet" type="text/css"/>
		<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="../vendor/tilt/tilt.jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>
 
		<style>
			#feedbackBg{
background-size: 100% 100%;
width: 30vw;
    height: 50vh;
    margin: auto;
    margin-top: -110px;

}

#gameMap{
  height: 60vh;
  
}
#star1:hover{
	width: 4vw;
}
		</style>
	</head>

<body style="display: flex;">
<audio id="bgMusic" loop autoplay>
  <source src="../assets/SOUNDS/question.mp3" type="audio/mpeg"/>
</audio>
<audio id="badgeSound">
  <source src="../assets/SOUNDS/badge.mp3" type="audio/mpeg"/>
</audio>
<audio id="btnClick">
  <source src="../assets/SOUNDS/button.wav" type="audio/mpeg"/>
</audio>
<div class="gameWrapper" style="background-image:url('../assets/BACKGROUNDS/MAP\ 1.png'); background-size:100% 100%;"">
    <div class="mainHolder">
		<div class="canvasHolder">
			<center>	
			<div class="gameCanvas" style="display:contents; ">
				<!-- ROW FOR SETTINGS-->
				<div class="row" id="settingsRow" >
					<div class="col-1 col-sm-1">
                    	<button id="backBtn"><img src="../assets/BUTTONS 2/back.png" alt="" style="width: 3vw;" disabled> </button>
					</div>
					<div class="col-6 col-sm-5">
						<img src="../assets/BUTTONS 2/Stars.png" id="star1" alt="" style="width: 3vw;" > 
						<img src="../assets/BUTTONS 2/Stars.png"" id="star2" alt=""style="width: 3vw;" >
						<img src="../assets/BUTTONS 2/Stars.png" id="star3" alt="" style="width: 3vw;" >
						<img src="../assets/BUTTONS 2/Stars.png" id="star4"  alt="" style="width: 3vw;">
						<img src="../assets/BUTTONS 2/Stars.png" id="star5"  alt="" style="width: 3vw;">
						<img src="../assets/BUTTONS 2/Stars.png" id="star6"  alt="" style="width: 3vw;">
						<img src="../assets/BUTTONS 2/Stars.png" id="star7"  alt="" style="width: 3vw;">
						<img src="../assets/BUTTONS 2/Stars.png" id="star8"  alt="" style="width: 3vw;">
						<img src="../assets/BUTTONS 2/Stars.png" id="star9"  alt="" style="width: 3vw;">
						<img src="../assets/BUTTONS 2/Stars.png" id="star10"  alt="" style="width: 3vw;">	

					</div>		
					<div class="col-3 col-sm-3">
						<img src="../assets/BADGES/3X.png" id="badge3x"  alt=""  style="width: 4vw;">
						<img src="../assets/BADGES/Faster.png" id="badgeFast"  alt=""  style="width: 4vw;">
						<img src="../assets/BADGES/50.png" id="badge50"  alt=""  style="width: 4vw;">
						<img src="../assets/BADGES/Finish.png" id="badgeFinish"  alt=""  style="width: 4vw;">
						<img src="../assets/BADGES/Pass.png" id="badgePass"  alt=""  style="width: 4vw;">						
						<img src="../assets/BADGES/100.png" id="badge100"  alt="" style="width: 4vw;">
						<img src="../assets/BADGES/Low Score.png" id="badgeLow"  alt=""  style="width: 4vw;">


					</div>	
					<div class="col-2 col-sm-3">
                        <button id="musicBtn" onclick="pauseMusic()"><img src="../assets/BUTTONS 2/sound-on.png" alt=""style="width: 3vw;" id="soundImg"> </button>
                        <a href="studentLogout.php"> <img src="../assets/BUTTONS 2/logout.png" alt="" style="width: 3vw;"> </i></a> 
					</div>

			 	</div>
				

				<!-- ROW FOR MAP-->
                            		
				<div class="row justify-content-center" id="gameMap" style="margin-left:0px">
					<div class="container-quests">
					<div class="row" style="margin: 0px;">
							<div class="col-2">

							</div>
							<div class="col-2">

							</div>
							<div class="col-2" >
								<a href="#"  id="quest9"> 	<img src="../assets/BOARDS/locatio1.png" alt="" style="width: 5vw;" id="quest9Btn"  class="circle-quests"></a>				

							</div>
							<div class="col-2" >

							</div>
							<div class="col-2" >
								<a href="#"  id="quest10"> 	<img src="../assets/BOARDS/locatio1.png" alt="" style="width: 5vw;" id="quest10Btn"  class="circle-quests"></a>				

							</div>
							<div class="col-2" >

							</div>
					
						</div>
					
					<div class="row" style="margin: 10px;">
							<div class="col-2">

							</div>
							<div class="col-2">
								<a href="#"  id="quest8"> 	<img src="../assets/BOARDS/locatio1.png" alt="" style="width: 5vw;" id="quest8Btn"  class="circle-quests"></a>				

							</div>
							<div class="col-2" >

							</div><div class="col-2" >
								
							</div>
							<div class="col-2" >

							</div>
							<div class="col-2" >

							</div>
					
						</div>
					<div class="row" style="margin: 10px;">
							<div class="col-1">

							</div>
							<div class="col-2">

							</div>
							<div class="col-2" >

							</div><div class="col-2" >

							</div>
							<div class="col-2" >

							</div>
							<div class="col-4" >
								<a href="#"  id="quest7"> 	<img src="../assets/BOARDS/locatio1.png" alt="" style="width: 5vw;" id="quest7Btn"  class="circle-quests"></a>				

							</div>
					
						</div>
						<div class="row" style="margin: 0px;">
							<div class="col-4"> 
								<a href="#"  id="quest6">	<img src="../assets/BOARDS/locatio1.png" alt="" style="width: 5vw;" id="quest6Btn"  class="circle-quests"></a>					

							</div>
							<div class="col-7"> 

							</div>
							<div class="col-1">

							</div>
						</div>
						<div class="row" style="margin: 30px;">
							<div class="col-3">
								<a href="#" id="quest5" style="margin-right:100px 50px;">	<img src="../assets/BOARDS/locatio1.png" alt="" style="width: 5vw;" id="quest5Btn"  class="circle-quests"></a>					

							</div>
							<div class="col-6">
							<a href="#"  id="quest4"  style="margin-right:100px 50px;">	<img src="../assets/BOARDS/locatio1.png" alt="" style="width: 5vw;" id="quest4Btn"  class="circle-quests"></a>					

							</div>	
							<div class="col-3">
								<a href="#"  id="quest3"  style="margin-right:100px 50px;">	<img src="../assets/BOARDS/locatio1.png" alt="" style="width: 5vw;" id="quest3Btn"  class="circle-quests"></a>					

							</div>	
						</div>
						<div class="row" style="margin: 10px;">
							<div class="col-4">

							</div>
							<div class="col-4">
								
							</div>	
							<div class="col-4">
								<a href="#"  id="quest2" style="margin-bottom: -50px;margin-left: 110px;" >	<img src="../assets/BOARDS/locatio1.png" alt="" style="width: 5vw;" id="quest2Btn" ></a>	

							</div>	
							<div class="col-4">

							</div>		
						</div>
						<div class="row" style="margin: 10px;">
							<div class="col-2">

							</div>
							<div class="col-3">

							</div>	
							<div class="col-2">

							</div>
							<div class="col-3">

							</div>	
							<div class="col-2">	
								<a href="questStory.php?id=<?php echo $row1["id"]; ?>"  id="quest1"  style="margin:30px ;"> 	<img src="../assets/BOARDS/locatio1.png" alt="" style="width: 5vw;" id="quest1Btn"  class="circle-quests"> </a>	
							</div>
						</div>
	

					</div>

				</div>
				<!-- ROW FOR INSTRUCTION-->	
				<div class="row  justify-content-center" id="gameInstructions" >	
					<div class="instructionHolder">
						<!--<img src="../assets/CHARACTER/LEAR.png" alt="" width="120px" id="lear">-->
						<img src="../assets/BOARDS/instruction-box.png" alt="" style="margin-top: -25px; width:33vw;">							

						<div class="instructionText">						
						<p class="story" id="welcomeText"> Welcome, young adventurer! </p> 
                            <div class="container"  style="width: 30vw;">
							<p class="gameStory" id="story1" ></p>
							<p class="gameStory" id="story1a"></p>
							<p class="gameStory" id="story2"></p>
							<p class="gameStory" id="story2a"></p>
							<p class="gameStory" id="story3"></p>
							<p class="gameStory" id="story3a"></p>		
							
							
							</div>
											
	                       <p id="dialogue"></p>					
							<p class="story" id="dialogue1"></p>
						<button id="continueBtn" onclick="continueText()" style="display: inline;"><img src="../assets/BUTTONS 2/next-btn.png" alt="" style=" width:8vw;"></button>
						<a href="#"  id="viewBadge"><button id="nextBtn" onclick="nextBtn()" style="display: none;"><img src="../assets/BUTTONS 2/next-btn.png" alt="" style=" width:8vw;"></button></a> 
						<a href="#"  id="finishBtn"><button id="finishBtn" onclick="finishBtn()" ><img src="../assets/BUTTONS 2/next-btn.png" alt="" style=" width:8vw;"></button></a> 
						<a href="#"  id="remarksBtn"><button id="remarksBtn" onclick="remarksBtn()" ><img src="../assets/BUTTONS 2/next-btn.png" alt="" style=" width:8vw;"></button></a> 
						<a href="#"  id="finalBtn"><button id="finalBtn" onclick="finalBtn()" ><img src="../assets/BUTTONS 2/next-btn.png" alt="" style=" width:8vw;"></button></a> 

						<a href="questStory.php?id=<?php echo $row1["id"];?>"  id="toQuest1" style="display:none"><img src="../assets/BUTTONS 2/go-to-quest.png"style=" width:8vw;" alt=""> </a>
						<a href="finalScorePage.php?code=<?php echo $ccode;?>"  id="finalScorePage" style="display:none"><img src="../assets/BUTTONS 2/view-score.png" style=" width:8vw;" alt=""></a>
					</div>
						</div>				
	

				</div>
				
			</div>	
			</center>

				<!--FEEDBACK MODAL-->
				<div id="popup1" class="overlay">

					<div id="feedbackBg">
						<div class="popup" style="margin: 160px auto;">
						<div class="content" >		
							<center><span id="feedbackTitle"></span> </center>

							<center><p id="feedbackText">
							</p> </center>

							<div id="starPoints">
						<!--	<center><img src="../assets/BUTTONS 2/Stars.png" id="star1" alt="" width="40px">  </center>-->

							</div>

							<div id="badgeAchievement">

							</div>
							<center><button onclick="nextBadge()" id="nextBadge" style="margin-top:40vh;"><img src="../assets/BUTTONS 2/next-btn.png" alt=""  style="width:8vw" > </button></center>

							<center><button onclick="hideBadge()" id="hideBadge" style="margin-top: 40vh;"><img src="../assets/BUTTONS 2/next-btn.png" alt=""  style="width:8vw"> </button></center>
							<center><button onclick="finalBadge()" id="finalBadge" style="margin-top: 40vh; "><img src="../assets/BUTTONS 2/next-btn.png" alt=""  style="width:8vw"  > </button></center>

							<center><a href="finalScorePage.php?code=<?php echo $ccode;?>"  id="finalPageBtn"><button  style="margin-top:40vh;"><img src="../assets/BUTTONS 2/view-score.png" alt="" style="width:8vw"></button></a>	</center>

						</div>
					</div>
					</div> 
					
				</div>

		</div>

	</div>
</div>
		
		
	
<script>
        let badgeSound  = document.getElementById("badgeSound");

		let btnClick  = document.getElementById("btnClick");

		document.getElementById("badge3x").style.display="none";
		document.getElementById("badge50").style.display="none";
		document.getElementById("badgeFast").style.display="none";
		document.getElementById("badgeFinish").style.display="none";
		document.getElementById("badgePass").style.display="none";
		document.getElementById("badge100").style.display="none";
		document.getElementById("badgeLow").style.display="none";
		document.getElementById("nextBtn").style.display="none";
		document.getElementById("finishBtn").style.display="none";
		document.getElementById("nextBadge").style.display="none";
		document.getElementById("remarksBtn").style.display="none";
		document.getElementById("finalBadge").style.display="none";
		document.getElementById("finalBtn").style.display="none";
		document.getElementById("finalPageBtn").style.display="none";



	/*let testTotal = <?php echo (int) ($testRow['total_questions']); ?>; 
   */
 // let passTestCode  = <?php echo json_encode ($ccode); ?>; 

	let testTotal  = <?php echo (int) ($rowTest['total_questions']); ?>; 
	console.log(testTotal);
	let currentScore  = <?php echo (int) ($rowStudent['score']); ?>; 
	let currentProgress  = <?php echo (int) ($rowStudent['progress']); ?>; 

    
	function backBtn1(){
		window.location.href="playerStart.php";
		btnClick.play();

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
	let continueBtn= document.getElementById("continueBtn");
	let firstParagraph = document.getElementById("welcomeText");
	let pStory1 = document.getElementById("story1");
	let pStory1a = document.getElementById("story1a");
	let pStory2 = document.getElementById("story2");
	let pStory2a = document.getElementById("story2a");
	let pStory3 = document.getElementById("story3");
	let pStory3a = document.getElementById("story3a");


	let story1 = 'I am Lear, I have some great quests prepared for young backpackers like you...';
	let story1a= 'to train you as you take the journey of becoming the next generation of adventurers!';
	let story2 ='As you explore and conquer the quests, you will gain valuable knowledge & skills...';
	let story2a='that will help you overcome more challenges you\'ll face as you go on your journey...';
	let story3 = 'Now, are you ready to go on an adventure ???';
	let story3a=' If you are, then LET\'S GO !!!';
	
	let speed =65;
	let click=0;
	let i = 0;

	let toQuest1= document.getElementById('toQuest1');

	function continueText() {
		if(click==0){
		btnClick.play();

		firstPar();
			click=1;

		}
		else if(click==1){
			btnClick.play();

			secondPar();
			click=2;
		}
		else if(click==2){
			btnClick.play();

			thirdPar();			
			
			click=3;
		}
		else if(click==3){
			btnClick.play();

			fourthPar();			
			click=4;
		}

		else if(click==4){
			btnClick.play();

			fifthPar();			
			click=5;
		}
		
		else if(click==5){
			btnClick.play();

			sixthPar();			
			continueBtn.style.display="none";
			toQuest1.style.display="inline";
			click=6;
		}
		
		
	}	
	function firstPar(){
		firstParagraph.style.display="none";
	  	if (i < story1.length) {
		
		pStory1.innerHTML += story1.charAt(i);
		i++;
		setTimeout(firstPar, speed);
		
		  }
	}	
	let i1 = 0;

	function secondPar(){
		firstParagraph.style.display="none";
		pStory1.style.display="none";

	  	if (i1 < story1a.length) {
		
		pStory1a.innerHTML += story1a.charAt(i1);
		i1++;
		setTimeout(secondPar, speed);
		}

	}
	let i2 = 0;

	function thirdPar(){
		firstParagraph.style.display="none";
		pStory1.style.display="none";
		pStory1a.style.display="none";

	  	if (i2 < story2.length) {
		
		pStory2.innerHTML += story2.charAt(i2);
		i2++;
		setTimeout(thirdPar, speed);
		}

	}
	let i3 = 0;

	function fourthPar(){
		firstParagraph.style.display="none";
		pStory1.style.display="none";
		pStory1a.style.display="none";

		pStory2.style.display="none";

	  	if (i3 < story2a.length) {
		
		pStory2a.innerHTML += story2a.charAt(i3);
		i3++;
		setTimeout(fourthPar, speed);
		}

	}	
	let i4 = 0;

	function fifthPar(){
		firstParagraph.style.display="none";
		pStory1.style.display="none";
		pStory1a.style.display="none";
		pStory2.style.display="none";
		pStory2a.style.display="none";

	  	if (i4 < story3.length) {
		
		pStory3.innerHTML += story3.charAt(i4);
		i4++;
		setTimeout(fifthPar, speed);
		}

	}	
	let i5 = 0;

	function sixthPar(){
		firstParagraph.style.display="none";
		pStory1.style.display="none";
		pStory1a.style.display="none";
		pStory2.style.display="none";
		pStory2a.style.display="none";
		pStory3.style.display="none";
		
	  	if (i5 < story3a.length) {
		
		pStory3a.innerHTML += story3a.charAt(i5);
		i5++;
		setTimeout(sixthPar, speed);
		}

	}
    if(currentScore==1){
		document.getElementById("star2").style.visibility = "hidden"; 
		document.getElementById("star3").style.visibility = "hidden";
		document.getElementById("star4").style.visibility = "hidden";
		document.getElementById("star5").style.visibility = "hidden"; 
		document.getElementById("star6").style.visibility = "hidden"; 
		document.getElementById("star7").style.visibility = "hidden"; 
		document.getElementById("star8").style.visibility = "hidden"; 
		document.getElementById("star9").style.visibility = "hidden"; 
		document.getElementById("star10").style.visibility = "hidden";
		
	}
	else if(currentScore==2){
		document.getElementById("star3").style.visibility = "hidden";
		document.getElementById("star4").style.visibility = "hidden";
		document.getElementById("star5").style.visibility = "hidden"; 
		document.getElementById("star6").style.visibility = "hidden"; 
		document.getElementById("star7").style.visibility = "hidden"; 
		document.getElementById("star8").style.visibility = "hidden"; 
		document.getElementById("star9").style.visibility = "hidden"; 
		document.getElementById("star10").style.visibility = "hidden"; 
	}
	else if(currentScore==3){
		document.getElementById("star4").style.visibility = "hidden";
		document.getElementById("star5").style.visibility = "hidden"; 
		document.getElementById("star6").style.visibility = "hidden"; 
		document.getElementById("star7").style.visibility = "hidden"; 
		document.getElementById("star8").style.visibility = "hidden"; 
		document.getElementById("star9").style.visibility = "hidden"; 
		document.getElementById("star10").style.visibility = "hidden";
	}
	else if(currentScore==4){
		document.getElementById("star5").style.visibility = "hidden"; 
		document.getElementById("star6").style.visibility = "hidden"; 
		document.getElementById("star7").style.visibility = "hidden"; 
		document.getElementById("star8").style.visibility = "hidden"; 
		document.getElementById("star9").style.visibility = "hidden"; 
		document.getElementById("star10").style.visibility = "hidden";
	}
	else if(currentScore==5){
		document.getElementById("star6").style.visibility = "hidden";
		document.getElementById("star7").style.visibility = "hidden"; 
		document.getElementById("star8").style.visibility = "hidden"; 
		document.getElementById("star9").style.visibility = "hidden"; 
		document.getElementById("star10").style.visibility = "hidden"; 
	}
	else if(currentScore==6){
		document.getElementById("star7").style.visibility = "hidden"; 
		document.getElementById("star8").style.visibility = "hidden"; 
		document.getElementById("star9").style.visibility = "hidden"; 
		document.getElementById("star10").style.visibility = "hidden"; 
	}
	else if(currentScore==7){
		document.getElementById("star8").style.visibility = "hidden"; 
		document.getElementById("star9").style.visibility = "hidden"; 
		document.getElementById("star10").style.visibility = "hidden"; 
	}
	else if(currentScore==8){
		document.getElementById("star9").style.visibility = "hidden"; 
		document.getElementById("star10").style.visibility = "hidden"; 

	}
	else if(currentScore==9){
		document.getElementById("star10").style.visibility = "hidden"; 
	}
	else{
		document.getElementById("star1").style.visibility = "hidden";
		document.getElementById("star2").style.visibility = "hidden"; 
		document.getElementById("star3").style.visibility = "hidden"; 
		document.getElementById("star4").style.visibility = "hidden"; 
		document.getElementById("star5").style.visibility = "hidden"; 
		document.getElementById("star6").style.visibility = "hidden"; 
		document.getElementById("star7").style.visibility = "hidden"; 
		document.getElementById("star8").style.visibility = "hidden"; 
		document.getElementById("star9").style.visibility = "hidden"; 
		document.getElementById("star10").style.visibility = "hidden"; 
 
	}



	if(testTotal==1){
		document.getElementById("quest2").style.visibility = "hidden"; 
		document.getElementById("quest3").style.visibility = "hidden";
		document.getElementById("quest4").style.visibility = "hidden";
		document.getElementById("quest5").style.visibility = "hidden";
		document.getElementById("quest6").style.visibility = "hidden"; 
		document.getElementById("quest7").style.visibility = "hidden"; 
		document.getElementById("quest8").style.visibility = "hidden";
		document.getElementById("quest9").style.visibility = "hidden";
		document.getElementById("quest10").style.visibility = "hidden";
	}
	else if(testTotal==2){
		document.getElementById("quest3").style.visibility = "hidden";
		document.getElementById("quest4").style.visibility = "hidden";
		document.getElementById("quest5").style.visibility = "hidden";
		document.getElementById("quest6").style.visibility = "hidden"; 
		document.getElementById("quest7").style.visibility = "hidden"; 
		document.getElementById("quest8").style.visibility = "hidden";
		document.getElementById("quest9").style.visibility = "hidden";
		document.getElementById("quest10").style.visibility = "hidden";  
	}
	else if(testTotal==3){
		document.getElementById("quest4").style.visibility = "hidden";
		document.getElementById("quest5").style.visibility = "hidden";
		document.getElementById("quest6").style.visibility = "hidden"; 
		document.getElementById("quest7").style.visibility = "hidden"; 
		document.getElementById("quest8").style.visibility = "hidden";
		document.getElementById("quest9").style.visibility = "hidden";
		document.getElementById("quest10").style.visibility = "hidden"; 
	}
	else if(testTotal==4){
		document.getElementById("quest5").style.visibility = "hidden";
		document.getElementById("quest6").style.visibility = "hidden"; 
		document.getElementById("quest7").style.visibility = "hidden"; 
		document.getElementById("quest8").style.visibility = "hidden";
		document.getElementById("quest9").style.visibility = "hidden";
		document.getElementById("quest10").style.visibility = "hidden"; 
	}
	else if(testTotal==5){
		document.getElementById("quest6").style.visibility = "hidden"; 
		document.getElementById("quest7").style.visibility = "hidden"; 
		document.getElementById("quest8").style.visibility = "hidden";
		document.getElementById("quest9").style.visibility = "hidden";
		document.getElementById("quest10").style.visibility = "hidden"; 
	}
	else if(testTotal==6){
		document.getElementById("quest7").style.visibility = "hidden"; 
		document.getElementById("quest8").style.visibility = "hidden";
		document.getElementById("quest9").style.visibility = "hidden";
		document.getElementById("quest10").style.visibility = "hidden"; 
	}
	else if(testTotal==7){
		document.getElementById("quest8").style.visibility = "hidden";
		document.getElementById("quest9").style.visibility = "hidden";
		document.getElementById("quest10").style.visibility = "hidden"; 
	}
	else if(testTotal==8){
		document.getElementById("quest9").style.visibility = "hidden";
		document.getElementById("quest10").style.visibility = "hidden"; 
 
	}
	else if(testTotal==9){
		document.getElementById("quest10").style.visibility = "hidden"; 
		
	}
	else if(testTotal==10){
		document.getElementById("quest10").style.visibility = "visible"; 
		
	}
	else{
		console.log("no quests"); 
	}

	let passingScore= testTotal * .75;
	console.log(passingScore);

//MAP PROGRESS

	if(currentProgress==1){
		document.getElementById("quest1Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest1").href = "#"; 
		document.getElementById("quest2Btn").src='../assets/BOARDS/location2.png';

		document.getElementById("quest2").href = "questStory.php?id=<?php echo $row1["id"]-1; ?>"; 

		document.getElementById("dialogue1").innerHTML="This is just the beginning, you can do this!";


	}
	else if(currentProgress==2){
		document.getElementById("quest1Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest2Btn").src='../assets/BOARDS/locationfailed.png';

		document.getElementById("quest1").href = "#"; 
		document.getElementById("quest3Btn").src='../assets/BOARDS/location2.png';

		document.getElementById("quest3").href = "questStory.php?id=<?php echo $row1["id"]-2; ?>"; 
		document.getElementById("dialogue1").innerHTML="Wow, you’re doing great adventurer! ";
	}
	else if(currentProgress==3){
		document.getElementById("quest1Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest2Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest3Btn").src='../assets/BOARDS/locationfailed.png';
		
		document.getElementById("quest4Btn").src='../assets/BOARDS/location2.png';

		document.getElementById("quest4").href = "questStory.php?id=<?php echo $row1["id"]-3; ?>"; 
		document.getElementById("dialogue1").innerHTML="There's so many obstacles! But it’s okay!";

	}
	else if(currentProgress==4){
		document.getElementById("quest1Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest2Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest3Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest4Btn").src='../assets/BOARDS/locationfailed.png';

		document.getElementById("quest1").href = "#"; 
		document.getElementById("quest5Btn").src='../assets/BOARDS/location2.png';

		document.getElementById("quest5").href = "questStory.php?id=<?php echo $row1["id"]-4; ?>"; 

		document.getElementById("dialogue1").innerHTML="Quests becomes harder, but keep going!";

	}
	else if(currentProgress==5){
		document.getElementById("quest1Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest2Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest3Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest4Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest5Btn").src='../assets/BOARDS/locationfailed.png';

		document.getElementById("quest6Btn").src='../assets/BOARDS/location2.png';

		document.getElementById("quest6").href = "questStory.php?id=<?php echo $row1["id"]-5; ?>"; 

		document.getElementById("dialogue1").innerHTML="Collect more star points adventurer.";

		
	}
	else if(currentProgress==6){
		document.getElementById("quest1Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest2Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest3Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest4Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest5Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest6Btn").src='../assets/BOARDS/locationfailed.png';

		document.getElementById("quest7Btn").src='../assets/BOARDS/location2.png';

		document.getElementById("quest7").href = "questStory.php?id=<?php echo $row1["id"]-6; ?>"; 

		document.getElementById("dialogue1").innerHTML="Learn and keep moving forward!";

	}
	else if(currentProgress==7){
		document.getElementById("quest1Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest2Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest3Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest4Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest5Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest6Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest7Btn").src='../assets/BOARDS/locationfailed.png';

		document.getElementById("quest8Btn").src='../assets/BOARDS/location2.png';

		document.getElementById("quest8").href = "questStory.php?id=<?php echo $row1["id"]-7; ?>"; 

		document.getElementById("dialogue1").innerHTML="You have conquered many quests! ";

	}
	else if(currentProgress==8){
		document.getElementById("quest1Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest2Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest3Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest4Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest5Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest6Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest7Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest8Btn").src='../assets/BOARDS/locationfailed.png';

		document.getElementById("quest9Btn").src='../assets/BOARDS/location2.png';

		document.getElementById("quest9").href = "questStory.php?id=<?php echo $row1["id"]-8; ?>"; 

		document.getElementById("dialogue1").innerHTML="Yay! You’re almost on your destination!";

	}
	else if(currentProgress==9){
		document.getElementById("quest1Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest2Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest3Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest4Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest5Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest6Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest7Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest8Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest9Btn").src='../assets/BOARDS/locationfailed.png';

		document.getElementById("quest10Btn").src='../assets/BOARDS/location2.png';

		document.getElementById("quest10").href = "questStory.php?id=<?php echo $row1["id"]-9; ?>"; 

		document.getElementById("dialogue1").innerHTML="Awesome! You did your best adventurer!";


	}
	else if(currentProgress==10){
		document.getElementById("quest1Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest2Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest3Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest4Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest5Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest6Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest7Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest8Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest9Btn").src='../assets/BOARDS/locationfailed.png';
		document.getElementById("quest10Btn").src='../assets/BOARDS/locationfailed.png';


	}
	else{
		document.getElementById("quest1Btn").src='../assets/BOARDS/location2.png';

		document.getElementById("quest2").href = "#"; 
		document.getElementById("quest3").href = "#"; 
		document.getElementById("quest4").href = "#"; 
		document.getElementById("quest5").href = "#"; 
		document.getElementById("quest6").href = "#"; 
		document.getElementById("quest7").href = "#"; 
		document.getElementById("quest8").href = "#"; 
		document.getElementById("quest9").href = "#"; 
		document.getElementById("quest10").href = "#"; 

	}


	if(currentProgress>=1){
		document.getElementById("welcomeText").style.display="none";
		document.getElementById("continueBtn").style.display="none";

	}
	if(currentProgress==testTotal){
	//	document.getElementById("finalScorePage").style.display="inline";

	}

   

	let halfWay = testTotal /2;
	console.log(halfWay);

	if(currentProgress==halfWay){
		document.getElementById("feedbackBg").style.backgroundImage="url('../assets/BOARDS/fb50.png')";

		document.getElementById("dialogue").innerHTML="Congratulations! ";
		document.getElementById("dialogue1").innerHTML=" You're halfway through all the quest !";
		document.getElementById("nextBtn").style.display="inline"
		console.log("Halfway to complete the quests")

	}
	
	
	function nextBtn(){		
		btnClick.play();

		document.getElementById("viewBadge").href="#popup1";
		document.getElementById("gameInstructions").style.display="none";
		document.getElementById("settingsRow").style.display="none";

		badgeSound.play();

	}
	function hideBadge(){
		document.getElementById("popup1").style.display="none";
		document.getElementById("gameInstructions").style.display="block";
		document.getElementById("settingsRow").style.display="flex";

		document.getElementById("dialogue").innerHTML="Continue your journey! ";
		document.getElementById("dialogue1").style.display="none";
		document.getElementById("nextBtn").style.display="none";		  
		document.getElementById("badge50").style.display="inline";
		btnClick.play();

	
	} 
	if(currentProgress>halfWay){
		document.getElementById("badge50").style.display="inline";

	}
	
	if(currentProgress==testTotal){
		document.getElementById("feedbackBg").style.backgroundImage="url('../assets/BOARDS/fb-finish.png')";

		document.getElementById("dialogue").innerHTML="Congratulations! ";
		document.getElementById("dialogue1").innerHTML="You have finished all the quests !";
		document.getElementById("finishBtn").style.display="inline"
		document.getElementById("badge").style.display="inline";



	}
	function finishBtn(){
		document.getElementById("finishBtn").href="#popup1";
		document.getElementById("gameInstructions").style.display="none";
		document.getElementById("settingsRow").style.display="none";

		document.getElementById("hideBadge").style.display="none";
		document.getElementById("nextBadge").style.display="inline";
		badgeSound.play();



	}
	function nextBadge(){		
		btnClick.play();

		if(currentScore>=passingScore){		
			document.getElementById("badgeFinish").style.display="inline";

				console.log("You passed");
				document.getElementById("gameInstructions").style.display="block";
				document.getElementById("settingsRow").style.display="flex";

				document.getElementById("popup1").style.display="none";
				document.getElementById("feedbackBg").style.backgroundImage="url('../assets/BOARDS/fb-pass.png')";


				document.getElementById("dialogue").innerHTML="You Passed ! ";
				document.getElementById("nextBtn").style.display="none";
				document.getElementById("finishBtn").style.display="none";
				document.getElementById("dialogue1").style.display="none";
				document.getElementById("remarksBtn").style.display="inline";


			}
			else if(currentScore<passingScore){
				document.getElementById("badgeFinish").style.display="inline";

				document.getElementById("gameInstructions").style.display="inline";
				document.getElementById("settingsRow").style.display="flex";

				document.getElementById("popup1").style.display="none";
				document.getElementById("feedbackBg").style.backgroundImage="url('../assets/BOARDS/fb-low.png')";

				console.log("Low Score")
				document.getElementById("dialogue").innerHTML="You did not pass! ";

				document.getElementById("badgeLow").style.display="inline";

				document.getElementById("nextBtn").style.display="none";
				document.getElementById("finishBtn").style.display="none";
				document.getElementById("dialogue1").style.display="none";
				document.getElementById("remarksBtn").style.display="inline";

			}
		
			else{
				console.log("Error");
			}
		
	}

	function remarksBtn(){
		btnClick.play();

		if(currentScore>=passingScore){		
		document.getElementById("feedbackBg").style.backgroundImage="url('../assets/BOARDS/fb-pass.png')";
		document.getElementById("popup1").style.display="inline";

		document.getElementById("remarksBtn").href="#popup1";
		document.getElementById("gameInstructions").style.display="none";
		document.getElementById("settingsRow").style.display="none";

		document.getElementById("hideBadge").style.display="none";
		document.getElementById("nextBadge").style.display="none";
		document.getElementById("finalBadge").style.display="inline";
		badgeSound.play();

		} else if(currentScore<passingScore){
			document.getElementById("feedbackBg").style.backgroundImage="url('../assets/BOARDS/fb-low.png')";
		document.getElementById("popup1").style.display="inline";
		document.getElementById("settingsRow").style.display="none";

		document.getElementById("remarksBtn").href="#popup1";
		document.getElementById("gameInstructions").style.display="none";
		document.getElementById("hideBadge").style.display="none";
		document.getElementById("nextBadge").style.display="none";
		document.getElementById("finalBadge").style.display="none";
		document.getElementById("finalBtn").style.display="none";
		document.getElementById("finalPageBtn").style.display="inline";

		}

	}

	function finalBadge(){				
		document.getElementById("badgePass").style.display="inline";

		if(currentScore==testTotal){
				document.getElementById("gameInstructions").style.display="block";
				document.getElementById("settingsRow").style.display="flex";

				document.getElementById("popup1").style.display="none";

				console.log("Perfect Score")
				document.getElementById("badgeFinish").style.display="inline";

				document.getElementById("feedbackBg").style.backgroundImage="url('../assets/BOARDS/fb100.png')";

				document.getElementById("dialogue").innerHTML=" You conquered all the quests!";
				document.getElementById("dialogue1").style.display="inline";
				document.getElementById("dialogue1").innerHTML="You got a perfect score";
				
				document.getElementById("nextBtn").style.display="none";
				document.getElementById("finishBtn").style.display="none";
				document.getElementById("remarksBtn").style.display="none";
				document.getElementById("finalBtn").style.display="inline";
				btnClick.play();


			}

		else{
			document.getElementById("popup1").style.display="none";
			document.getElementById("dialogue").style.display="none";
			document.getElementById("finalBadge").style.display="none";
			document.getElementById("nextBtn").style.display="none";
			document.getElementById("remarksBtn").style.display="none";
			document.getElementById("settingsRow").style.display="flex";

			document.getElementById("gameInstructions").style.display="block";

			document.getElementById("finalScorePage").style.display="inline";

		}
	}
	function finalBtn(){	
		document.getElementById("feedbackBg").style.backgroundImage="url('../assets/BOARDS/fb100.png')";
			
		document.getElementById("badge100").style.display="inline";

		document.getElementById("popup1").style.display="inline";

		document.getElementById("finalBtn").href="#popup1";
		document.getElementById("settingsRow").style.display="none";

		document.getElementById("gameInstructions").style.display="none";
		document.getElementById("hideBadge").style.display="none";
		document.getElementById("nextBadge").style.display="none";
		document.getElementById("finalBadge").style.display="none";
		document.getElementById("finalPageBtn").style.display="inline";

		badgeSound.play();

	}

	/*
		else 
	*/
</script>

</body>
</html>