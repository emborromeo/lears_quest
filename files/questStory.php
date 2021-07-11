<?php
session_start();
if(isset($_SESSION["player_id"]) && ($_SESSION["code"]) ){
    $questionid = $_REQUEST['id'];

}
?>

<?php
include '../database/config.php';
$code = $_SESSION['code'];


  $testCode = "SELECT * FROM tbl_tests WHERE generatedCode = '$code'";
  $resultTestId = mysqli_query($conn,$testCode);
  $rowTest = mysqli_fetch_assoc($resultTestId);
  $testId = (int) $rowTest['id'];

  $sql = "SELECT question_id FROM question_test_mapping WHERE test_id = $testId";
  $result = mysqli_query($conn,$sql);

  $row1;

  while($row = mysqli_fetch_assoc($result)) {
    $sql1 = "SELECT * FROM tbl_questions  WHERE id = $questionid ";
    $result1 = mysqli_query($conn,$sql1);
    $row1 = mysqli_fetch_assoc($result1);
  }
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
		<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="../vendor/tilt/tilt.jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Waiting+for+the+Sunrise" rel="stylesheet" type="text/css"/>
        <style>
       
        </style>
	</head>

<body>
<audio id="bgMusic" loop autoplay>
	<source src="../assets/SOUNDS/quest.ogg" type="audio/mpeg"/>
</audio>

<div class="gameWrapper" id="gameWrapper">
    <div class="mainHolder">
		<div class="canvasHolder">
            <center>
        	<div class="gameCanvas" style=" display:contents;">
                <div class="row justify-content-between" id="settingsRow" >
                        <div class="col-1">
                        <button id="backBtn"onclick="backBtn1()"><img  style="width: 3vw;" src="../assets/BUTTONS 2/back.png" alt="" > </button>
                        </div>

                        <div class="col-3">
                            <button id="musicBtn" onclick="pauseMusic()"><img src="../assets/BUTTONS 2/sound-on.png" alt=""style="width: 3vw;" id="soundImg"> </button>
                            <a href="studentLogout.php"> <img src="../assets/BUTTONS 2/logout.png" alt="" style="width: 3vw;"> </i></a> 
                        </div>

                </div>
                    <center>
                <div class="row justify-content-center" id="gameMap" style=" width:70vw; height:45vw; border-radius: 10px;background: rgba(0,0,0,0.3);margin-top:10px">

                        <div class="col-12">
                        <center> <p style="color: #fff; font-size:2vw" id="questTitle"><?= $rowQuest['quest_task']?></p></center> 

                        </div>

                        <div class="col-12">
                            <center><p style="color: #fff;font-size:2vw" id="questStory"></p>	</center> 

                        </div>
                    
                        <div class="col-12" style="margin: 30px;">

                        </div>
                    
                </div>
                </center>
                <div class="row" style="margin-top: -30px;">
                     <div class="col-12" >
                        <center> <a href="playerQuiz.php?id=<?php echo $questionid;?>" id="toQuestion" ><img src="../assets/BUTTONS 2/next-btn.png" alt="" style="width: 10vw;"> </a></center> 
                    </div>
                </div>
			</div> 
        </center>
		</div>

	</div>
</div>
		
		
	
<script>

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
   function backBtn1(){
       window.location.href="playerMap.php"
       document.getElementById("btnClick").play();

   }
    let questTask  = <?php echo json_encode ($rowQuest['quest_task']); ?>; 
    let questTaskDescription  = <?php echo json_encode ($rowQuest['quest_task_description']); ?>; 
    let questImg  = <?php echo json_encode ($rowQuest['img_path']); ?>; 
    console.log(questImg);
//	document.getElementById("gameCanvas").style.backgroundImage="url('<?php echo $rowQuest['img_path']; ?>')";
	document.getElementById("gameWrapper").style.backgroundImage="url('<?php echo $rowQuest['img_path']; ?>')";


    console.log(questTask);
    console.log(questTaskDescription);
    let questDesc = document.getElementById("questStory");

        // set up text to print, each item in array is new line
    var aText = new Array(
        questTaskDescription
    );
    var iSpeed = 80; // time delay of print out
    var iIndex = 0; // start printing array at this posision
    var iArrLength = aText[0].length; // the length of the text array
    var iScrollAt = 20; // start scrolling up at this many lines
    
    var iTextPos = 0; // initialise text position
    var sContents = ''; // initialise contents variable
    var iRow; // initialise current row
    
    function typewriter()
    {
    sContents =  ' ';
    iRow = Math.max(0, iIndex-iScrollAt);
    
    while ( iRow < iIndex ) {
    sContents += aText[iRow++] + '<br />';
    document.getElementById("toQuestion").style.display="block";

    }
    questDesc.innerHTML = sContents + aText[iIndex].substring(0, iTextPos) ;
    if ( iTextPos++ == iArrLength ) {
    iTextPos = 0;
    iIndex++;
    if ( iIndex != aText.length ) {
    iArrLength = aText[iIndex].length;
    setTimeout("typewriter()", 500);
    }
    } else {
    setTimeout("typewriter()", iSpeed);
    }
    }


typewriter();
	  
</script>
</body>
</html>