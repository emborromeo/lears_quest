<?php
session_start();
if(isset($_SESSION["player_id"]) && ($_SESSION["code"]) ){
  $code = $_SESSION['code'];

  
  $questionid = $_REQUEST['id'];

  $score;
  
  //If Answered
 // $_SESSION['questDone'] = $var_value;

	  //if question is answered 1
	  //$questionAnswered;
 	 // $_SESSION['questDone'] = $var_value;
}
?>

<?php

  include '../database/config.php';
  $student_id = $_SESSION['player_id'];


  $testCode = "select * from tbl_tests where generatedCode = '$code'";
  $resultTestId = mysqli_query($conn,$testCode);
  $rowTest = mysqli_fetch_assoc($resultTestId);
  $testId = (int) $rowTest['id'];

  $sql = "select question_id from question_test_mapping where test_id = $testId";
  $result = mysqli_query($conn,$sql);

  $row1;

  while($row = mysqli_fetch_assoc($result)) {
    $sql1 = "select * from tbl_questions  where id = $questionid";
    $result1 = mysqli_query($conn,$sql1);
    $row1 = mysqli_fetch_assoc($result1);
  }

  //inserting test id, student id to table students
  //insert 
  //$studentScore = "INSERT INTO students (test_id, student_id, score) VALUES('$testId', '$student_id' ,'0') ";
 // $insertScore = mysqli_query($conn,$studentScore);
  /*
    $studentNewScore = "UPDATE students SET score = '5' where student_id='$student_id'";
		$saveScore = mysqli_query($conn,$studentNewScore);
  */	
  

    $chosenQuest = (int) $row1['quest_id'];
     
    //getting quest info
    $queryQuest = "SELECT * FROM tbl_quest WHERE quest_id = $chosenQuest";
    $resultQuest = mysqli_query($conn,$queryQuest);
    $rowQuest = mysqli_fetch_assoc($resultQuest);

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
	
	<style>
	

#feedbackBg{
background-size: 100% 100%;
width: 25%;
height: 50%;
margin: auto;
 
}
#minutes, #seconds, #colon{
    color: #723c29;
  font-size: 3.5vw;
  font-family: AzoSans;

  }
  #timer{
    margin-top: 25px;
  }

	</style>

	</head>

<body style="display: flex;">
<audio id="bgMusic" loop autoplay>
	<source src="../assets/SOUNDS/3" type="audio/mpeg"/>
</audio>
<audio id="correctSound">
	<source src="../assets/SOUNDS/correct1.wav" type="audio/mpeg"/>
</audio>
<audio id="wrongSound">
	<source src="../assets/SOUNDS/wrong.wav" type="audio/mpeg"/>
</audio>
<audio id="btnClick">
  <source src="../assets/SOUNDS/button.wav" type="audio/mpeg"/>
</audio>
<div class="gameWrapper" id="gameWrapper" style="background-size:100% 100%;" >
    <div class="mainHolder">
		<div class="canvasHolder">
      <center>
			<div class="gameCanvas" id="gameCanvas" style="display:contents">
				<!-- ROW FOR SETTINGS-->
			    <div class="row justify-content-between" id="settingsRow" >

            <div class="col-1 col-sm-1">
            <button id="backBtn" onclick="backBtn1()"><img src="../assets/BUTTONS 2/back.png" alt="" style="width: 3vw;"> </button>
            </div> 

            <div class="col-3 col-sm-3">
              <button id="musicBtn" onclick="pauseMusic()"><img src="../assets/BUTTONS 2/sound-on.png" alt="" style="width: 3vw; margin:5px" id="soundImg"> </button> 
              <a href="studentLogout.php"> <img src="../assets/BUTTONS 2/logout.png" alt="" style="width: 3vw;"> </i></a> 
            </div>

			    </div>
			
				<div class="row justify-content-center" id="gameMap" style="margin-top: 30px;">
					    <center>
            <div class="container-quiz" style="background-image: url('../assets/BOARDS/quest-box.png');width:70vw; margin-top:-45px">
              <div class="row justify-content-center">
                  <span id="question"><?= $row1["question_text"];?></span>
              </div> <br> 
                <input type="hidden" name="save_score">
                <div class="quiz " id="quiz" style="width: 90vw;">  
                  <div id="timer" >
                     <span id="minutes" >00</span><span id="colon">:</span><span id="seconds">00</span>
                  </div>   

                    <div id="optionA" class="element-animation1 btn btn-lg btn-choice"><input type="radio" name="q_answer" value="A"><span class="quest-choices" >&nbsp;<?= $row1["optionA"];?></span> </div> <br>
                    <div id="optionB" class="element-animation1 btn btn-lg btn-choice" ><input type="radio" name="q_answer"  value="B" ><span class="quest-choices" >&nbsp;<?= $row1["optionB"];?></span></div>
                    <br>
                          
                    <div id="optionC" class="element-animation1 btn btn-lg btn-choice"><input type="radio" name="q_answer" class="quest-choices" value="C"><span class="quest-choices" >&nbsp;<?= $row1["optionC"];?></span></div> <br>
                    <div id="optionD" class="element-animation1 btn btn-lg btn-choice"> <input type="radio" name="q_answer" class="quest-choices" value="D" ><span class="quest-choices" >&nbsp;<?= $row1["optionD"];?></span></div>
                    <br>

                    <div class="row justify-content-center">
                        <a class="button" href="#popup1"> <button class="role-form-bn" onclick="submitAnswer()"> <img src="../assets/BUTTONS 2/submit-btn.png" alt="" style=" width:8vw;"></button></a>
                    </div>
				      	</div>
					</div>  
</center>
			</div>
        </center>     
			<!--FEEDBACK MODAL-->
				<div id="popup1" class="overlay">

					<div id="feedbackBg">
						<div class="popup" id="popup" style=" margin-top: 100px;">
              <div class="content">		

                <center><p id="feedbackText">
                </p> </center>

                <div id="starPoints">
              <center><img src="../assets/BUTTONS 2/Stars.png" id="star1" alt="" style=" width:8vw;">  </center>

                </div>

                <center> <a href="playerMap.php?quiz_code=<?php echo $code;?>" id="continueMap"><img src="../assets/BUTTONS 2/next-btn.png" alt=""  style=" width:8vw;"  style="margin: 15px;"> </a></center>
              </div>
					  </div>
					</div> 
					
				</div>

       


			</div>
		</div>

	</div>

		

		
<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../vendor/tilt/tilt.jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>

<script type="text/javascript">
      let btnClick  = document.getElementById("btnClick");

      document.getElementById("star1").style.display="none";

        let minutesLabel = document.getElementById("minutes");
        let secondsLabel = document.getElementById("seconds");
        let totalSeconds = 0;
        setInterval(setTime, 1000);

        function setTime()
        {
            ++totalSeconds;
            secondsLabel.innerHTML = pad(totalSeconds%60);
            minutesLabel.innerHTML = pad(parseInt(totalSeconds/60));
        }

        function pad(val)
        {
          let valString = val + "";
            if(valString.length < 2)
            {
                return "0" + valString;
            }
            else
            {
                return valString;
            }
        }


function getTime(){
  let timetry  = document.getElementById("seconds").value;
  console.log(timetry);
}

  let answer  = <?php echo json_encode ($row1['correctAns']); ?>; 
  
  document.getElementById("gameCanvas").style.backgroundImage="url('<?php echo $rowQuest['img_path']; ?>')";
	document.getElementById("gameWrapper").style.backgroundImage="url('<?php echo $rowQuest['img_path']; ?>')";


  function backBtn1(){
      
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
  function submitAnswer(){    
    btnClick.play();

    let getSelectedAnswer =document.querySelector('input[name="q_answer"]:checked');   
    let selectedAnswer= getSelectedAnswer.value;   
    let correctSound = document.getElementById("correctSound");
    let wrongSound = document.getElementById("wrongSound");


    console.log(selectedAnswer);

    let feedbackTitle = document.getElementById("feedbackTitle");
    let feedbackText = document.getElementById("feedbackText");

    if(answer==selectedAnswer){ 
  //pasas to update score
  //enable next queston
      document.getElementById("feedbackBg").style.backgroundImage="url('../assets/BOARDS/correct1.png')";
      document.getElementById("star1").style.display="block";
      document.getElementById("popup").style.paddingTop="18vh";

      console.log("correct");
      feedbackText.innerHTML = "  ";
      correctSound.play();

      updateScore();
    }
    else{
      document.getElementById("feedbackBg").style.backgroundImage="url('../assets/BOARDS/wrong2.png')";
      document.getElementById("star1").style.display="none";
      document.getElementById("popup").style.paddingTop="28vh";

      feedbackText.innerHTML = "The answer is " + answer;
      console.log(answer)
      wrongSound.play();
      updateProgress();
    }

  }
    
   function updateScore(){
    let studentid = <?php echo (int) $student_id; ?>;
    let student_test = <?php echo (int) $testId; ?>;

    $.ajax({
      url: "checkQuiz.php",
      type: "POST",
      data:{"score":0,
      "currrent_student":studentid,
       "current_test": student_test}
    })

   }
 
   function updateProgress(){
    let studentid1 = <?php echo (int) $student_id; ?>;
    let student_test1 = <?php echo (int) $testId; ?>;

    $.ajax({
      url: "student_test_progress.php",
      type: "POST",
      data:{
      "currrent_student1":studentid1,
      "current_test1": student_test1}
    })

   }



</script>
</body>
</html>