<?php
session_start();
if(isset($_SESSION["player_id"])){
	$test_code = $_REQUEST['quiz_code'];
    $_SESSION['codeQuiz'] = $test_code;

	  //if question is answered 2

	//$var_value = $_SESSION['varname'];
}

?>
<?php
	include '../database/config.php';
	$student_id = $_SESSION['player_id'];

	$testCode = "SELECT * FROM tbl_tests WHERE generatedCode = '$test_code'";
	$resultTest = mysqli_query($conn,$testCode);
	$rowTest = mysqli_fetch_assoc($resultTest);
	$testId = (int) $rowTest['id'];
 
	
	//total questions

	$totalQuest = (int) $rowTest['total_questions'];


    $sql = "SELECT question_id FROM question_test_mapping WHERE test_id = $testId";
    $result = mysqli_query($conn,$sql);
    $row1;                     
        while($row = mysqli_fetch_assoc($result)) {
            $question_id = $row["question_id"];
            $sql1 = "SELECT * FROM tbl_questions order by id asc";
            $result1 = mysqli_query($conn,$sql1);
            $row1 = mysqli_fetch_assoc($result1);
		}

		
	$studentInfo = "SELECT * FROM students WHERE student_id = '$student_id'";
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
		<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="../vendor/tilt/tilt.jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>

	</head>

<body style="display: flex;">
<audio id="bgMusic" loop autoplay>
  <source src="../images/map2.mp3" type="audio/mpeg" />
</audio>
<div class="gameWrapper" >
    <div class="mainHolder">
		<div class="canvasHolder">
			<div class="gameCanvas" style="width: 1024px; height:640px;">
				<!-- ROW FOR SETTINGS-->
				<div class="row" id="settingsRow" >
					<div class="col-1">
                    	<button id="backBtn" onclick="backBtn1()"><i class="fa fa-chevron-left  fa-sm" ></i> <b> Back</b> </button>
					</div>
					<div class="col-6">
						<img src="../images/point.png" id="star1" alt="" width="40px" > 
						<img src="../images/point.png" id="star2" alt="" width="40px" >
						<img src="../images/point.png" id="star3" alt="" width="40px" >
						<img src="../images/point.png" id="star4"  alt="" width="40px" >
						<img src="../images/point.png" id="star5"  alt="" width="40px" >
						<img src="../images/point.png" id="star6"  alt="" width="40px" >
						<img src="../images/point.png" id="star7"  alt="" width="40px" >
						<img src="../images/point.png" id="star8"  alt="" width="40px" >
						<img src="../images/point.png" id="star9"  alt="" width="40px" >
						<img src="../images/point.png" id="star10"  alt="" width="40px" >	

					</div>		
					<div class="col-3">
						<img src="../images/badge.png" id="badge1"  alt=""  width="40px" hidden>
						<img src="../images/badge.png" id="badge2"  alt=""  width="40px" hidden>
						<img src="../images/badge.png" id="badge3"  alt=""  width="40px" hidden>
						<img src="../images/badge.png" id="badge4"  alt=""  width="40px" hidden>
						<img src="../images/badge.png" id="badge5"  alt=""  width="40px" hidden>

					</div>	
					<div class="col-2">                        
						<button id="musicBtn" onclick="pauseMusic1()"><i class="fa fa-music fa-2x"></i></button>  
						<a href="studentLogout.php"> <i class="fa fa-sign-out fa-2x" style="color:#679847"> </i></a>

					</div>

			 	</div>
				

				<!-- ROW FOR MAP-->
                            		
				<div class="row justify-content-md-center" id="gameMap" style="margin-left:0px">
					<div class="container-quests">
					<div class="row" style="margin: 30px;">
							<div class="col-2">
								<a href="playerQuiz.php?id=<?php echo $row1["id"]+9; ?>" id="quest10" class="button-quest button-circle button-primary">10</a>					

							</div>
							<div class="col-2">

							</div>
							<div class="col-2" >

							</div><div class="col-2" >

							</div>
							<div class="col-2" >

							</div>
							<div class="col-2" >
								<a href="playerQuiz.php?id=<?php echo $row1["id"]+8; ?>"  id="quest9" class="button-quest button-circle button-primary" > 9</a>	</button>				

							</div>
					
						</div>
						<div class="row" style="margin: 30px;">
							<div class="col-4">
								<a href="playerQuiz.php?id=<?php echo $row1["id"]+7; ?>"  id="quest8" class="button-quest button-circle button-primary" disabled>8</a>					

							</div>
							<div class="col-8">
								<a href="playerQuiz.php?id=<?php echo $row1["id"]+6; ?>"  id="quest7" class="button-quest button-circle button-primary" style="margin-left: 40px;" disabled>7</a>	

							</div>
						</div>
						<div class="row" style="margin: 30px;">
							<div class="col-3">
								<a href="playerQuiz.php?id=<?php echo $row1["id"]+5; ?>" id="quest6"  class="button-quest button-circle button-primary" disabled>6</a>					

							</div>
							<div class="col-6">

							</div>	
							<div class="col-3">
								<a href="playerQuiz.php?id=<?php echo $row1["id"]+4; ?>"  id="quest5" class="button-quest button-circle button-primary" style="margin-right:100px 50px;" disabled>5</a>					

							</div>	
						</div>
						<div class="row" style="margin: 30px;">
							<div class="col-4">
								<a href="playerQuiz.php?id=<?php echo $row1["id"]+3; ?>"  id="quest4" class="button-quest button-circle button-primary" style="margin-right:100px 50px;" disabled>4</a>					

							</div>
							<div class="col-4">
								
							</div>	
							<div class="col-4">
								<a href="playerQuiz.php?id=<?php echo $row1["id"]+2; ?>"  id="quest3" class="button-quest button-circle button-primary"  style="margin-bottom: -50px;margin-left: 110px;" disabled>3</a>	

							</div>	
							<div class="col-4">

							</div>		
						</div>
						<div class="row" style="margin: 30px;">
							<div class="col-2">
								<a href="playerQuiz.php?id=<?php echo $row1["id"]+1; ?>"  id="quest2" class="button-quest button-circle button-primary"  style="margin-bottom:30px ;">2</a>					

							</div>
							<div class="col-3">

							</div>	
							<div class="col-2">

							</div>
							<div class="col-3">

							</div>	
							<div class="col-2">	
								<a href="playerQuiz.php?id=<?php echo $row1["id"]; ?>"  id="quest1" class="button-quest button-circle button-primary" style="margin:30px ;">	1<img src="../images/boy.png" width="70px" hidden></a>	
							</div>
						</div>
	

					</div>

				</div>
				<!-- ROW FOR INSTRUCTION-->	
				<div class="row  justify-content-md-center" id="gameInstructions">	
					<div class="instructionHolder">
						<img src="../images/lear.png" alt="" width="120px" id="lear">
						<img src="../images/bar-sample.png" alt="" width="60%">
						<div class="instructionText">
							<p class="story" id="welcomeText"> Welcome, young adventurer! </p> 
							<p class="gameStory" id="story1"></p>
							<p class="gameStory" id="story2"></p>
							<p class="gameStory" id="story3"></p>					
							<button id="continueBtn" onclick="continueText()" style="display: inline;">Continue</button>
							<a href="playerQuiz.php?id=<?php echo $row1["id"];?>"  id="toQuest1" style="display:none">Go to quest 1</a>	

						</div>						

					</div>

				</div>
				
			</div>
		</div>

	</div>
</div>
		
		
	
<script>
	/*let testTotal = <?php echo (int) ($testRow['total_questions']); ?>; 
   */
	let testTotal  = <?php echo (int) ($rowTest['total_questions']); ?>; 
	console.log(testTotal);
	let currentScore  = <?php echo (int) ($rowStudent['score']); ?>; 

	function backBtn1(){
		window.location.replace("playerStart.php");

	}
    function pauseMusic1(){
        let bgMusic= document.getElementById("bgMusic");

        if(bgMusic.paused) {
            bgMusic.play();
        }
        else {
            bgMusic.pause();
        }
    }
	let continueBtn= document.getElementById("continueBtn");
	let firstParagraph = document.getElementById("welcomeText");
	let pStory1 = document.getElementById("story1");
	let pStory2 = document.getElementById("story2");
	let pStory3 = document.getElementById("story3");


	let story1 = 'I am Lear, I have some great quests prepared for young backpackers like you to train you as you take the journey of becoming the next generation of great adventurers.';
	let story2 ='As you explore and conquer the quests, you will gain valuable knowledge and skills that will help you overcome more and harder challenges you will encounter as you go on your journey.';
	let story3 = 'Now, are you ready to go on an adventure?  If you are, then LET\'S GO !!!';
	let speed = 50;
	let click=0;
	let i = 0;

	let toQuest1= document.getElementById('toQuest1');

	function continueText() {
		if(click==0){
		firstPar();
			click=1;

		}
		else if(click==1){
			secondPar();
			click=2;
		}
		else if(click==2){
			thirdPar();			
			continueBtn.style.display="none";
			toQuest1.style.display="inline";
			click=3;
		}
		else if(click==3){

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

	  	if (i1 < story2.length) {
		
		pStory2.innerHTML += story2.charAt(i1);
		i1++;
		setTimeout(secondPar, speed);
		}

	}
	let i2 = 0;

	function thirdPar(){
		firstParagraph.style.display="none";
		pStory1.style.display="none";
		pStory2.style.display="none";

	  	if (i2 < story3.length) {
		
		pStory3.innerHTML += story3.charAt(i2);
		i2++;
		setTimeout(thirdPar, speed);
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

	if(currentScore>=1){
		document.getElementById("welcomeText").style.display="none";
		document.getElementById("continueBtn").style.display="none";

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
	else{
		console.log("no quests"); 
	}
</script>

</body>
</html>