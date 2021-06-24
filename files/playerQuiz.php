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
  $studentScore = "INSERT INTO students (test_id, student_id, score) VALUES('$testId', '$student_id' ,'0') ";
  $insertScore = mysqli_query($conn,$studentScore);
  /*
    $studentNewScore = "UPDATE students SET score = '5' where student_id='$student_id'";
		$saveScore = mysqli_query($conn,$studentNewScore);
  */	
  

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
	
.overlay {
	
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
}
.overlay:target {
  visibility: visible;
  opacity: 1;
}
#feedbackBg{
	background-image: url('../images/bar-sample.png');
background-size: 100% 100%;
width: 25%;
height: 50%;
margin: auto;
    margin-top: auto;
margin-top: -50px;
}

.popup {
  margin: 250px auto;
  padding: 20px;
  background: transparent;
  border-radius: 5px;
  width: 90%;
  position: relative;
  transition: all 5s ease-in-out;
}

.popup span {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}

.popup .content {
  max-height: 30%;
  overflow: auto;
}

@media screen and (max-width: 700px){
  .box{
    width: 70%;
  }
  .popup{
    width: 70%;
  }
}
		
	</style>

	</head>

<body style="display: flex;">
<div class="gameWrapper" >
    <div class="mainHolder">
		<div class="canvasHolder">
			<div class="gameCanvas" style="width: 1024px; height:640px;">
				<!-- ROW FOR SETTINGS-->
			    <div class="row" id="settingsRow" >

					<div class="col-md-10">
						<button id="backBtn"><i class="fa fa-chevron-left  fa-lg"></i> Back </button>
					</div>

					<div class="col-md-2">
                        <button id="musicBtn"><i class="fa fa-music fa-2x"></i></button>
                        <button id="logoutBtn"><i class="fa fa-sign-out fa-2x"></i> </button>
					</div>

			    </div>
				<!-- ROW FOR GAME INFO - PROGRESS BAR, SCORE, BADGES -->
				<div class="row justify-content-md-center" id="gameInfo" >
				<!--PROGRESS BAR-->
				</div>

				<!-- ROW QUESTION-->

				<div class="row justify-content-md-center" id="gameMap" style="margin-left:0px">
					<div class="container-quiz">
              <div class="row justify-content-md-center">
                  <span id="question"><?= $row1["question_text"];?></span>
              </div> <br> 
                <input type="hidden" name="save_score">
                <div class="quiz " id="quiz" >     
                      
                    <div id="optionA" class="element-animation1 btn btn-lg btn-choice"><input type="radio" name="q_answer" value="A">&nbsp;<?= $row1["optionA"];?></div> <br>
                    <div id="optionB" class="element-animation1 btn btn-lg btn-choice" ><input type="radio" name="q_answer" value="B" >&nbsp;<?= $row1["optionB"];?></div>
                    <br>
                          
                    <div id="optionC" class="element-animation1 btn btn-lg btn-choice"><input type="radio" name="q_answer" value="C">&nbsp;<?= $row1["optionC"];?></div> <br>
                    <div id="optionD" class="element-animation1 btn btn-lg btn-choice"> <input type="radio" name="q_answer" value="D" >&nbsp;<?= $row1["optionD"];?></div>
                    <br>

                    <div class="row justify-content-md-center">
                        <a class="button" href="#popup1"> <button class="role-form-bn" onclick="submitAnswer()"> <img src="../images/submit.png" alt="" style="width: 20%;"></button></a>
                    </div>
				      	</div>
					</div>

			</div>
            
			<!--FEEDBACK MODAL-->
				<div id="popup1" class="overlay">

					<div id="feedbackBg">
						<div class="popup">
						<div class="content">		
							<span id="feedbackTitle">Feedback</span>

							<p id="feedbackText">
								Feedback
							</p>

							<div id="starPoints">
							<img src="../images/point.png" id="start1" alt="" width="40px"> 

							</div>

							<div id="badgeAchievement">

							</div>
							<a href="playerMap.php?quiz_code=<?php echo $code;?>"><button> Continue</button></a>
						</div>
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
    let answer  = <?php echo json_encode ($row1['correctAns']); ?>; 

  function submitAnswer(){    

    let getSelectedAnswer =document.querySelector('input[name="q_answer"]:checked');   
    let selectedAnswer= getSelectedAnswer.value;   
      

    console.log(selectedAnswer);

    let feedbackTitle = document.getElementById("feedbackTitle");
    let feedbackText = document.getElementById("feedbackText");

    if(answer==selectedAnswer){
  //pasas to update score
  //enable next queston
      feedbackTitle.innerHTML = "CORRECT"
      feedbackText.innerHTML = "Yey! Congrats"
      console.log("correct");
    /*
      <?php $score=$scoreCounter++;?>
      let score = <?php echo (int) $score;?>;
      console.log(score);

    */
    updateScore();
    }
    else{
      feedbackTitle.innerHTML = "AW, WRONG"
      feedbackText.innerHTML = "The correct answer is " + answer;
      console.log("wrong")
      updateProgress();
    }

  }
    
   function updateScore(){
    let studentid = <?php echo (int) $student_id; ?>;

    $.ajax({
      url: "checkQuiz.php",
      type: "POST",
      data:{"score":0,
      "currrent_student":studentid}
    })

   }
 
   function updateProgress(){
    let studentid1 = <?php echo (int) $student_id; ?>;

    $.ajax({
      url: "student_test_progress.php",
      type: "POST",
      data:{
      "currrent_student":studentid1}
    })

   }

 

</script>
</body>
</html>