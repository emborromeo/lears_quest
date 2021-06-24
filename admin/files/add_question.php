<?php
session_start();

if(!isset($_SESSION["user_id"]))
  header("Location:../index.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="robots" content="noindex">
  <meta http-equiv="pragma" content="no-cache" />
  <meta http-equiv="expires" content="-1" />
  <title>
    <?=ucfirst(basename($_SERVER['PHP_SELF'], ".php"));?>
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/main.css" rel="stylesheet" />
  <link href="../../css/main.css" rel="stylesheet" />
  <link href="../../css/header.css" rel="stylesheet" />
</head>

<body class="">

  <header class="header1">
				<!-- Header desktop -->
    <div class="container-menu-header">
				<div class="wrap_header"> 
        <div class="row justify-content-between" style="display: contents;">

              <div class="col-10">
              <h5 class="title" style="float: left;">Quiz Game Builder</h5>
              </div>
              <div class="col-2">
                  <a href="./logout.php">  <i class="fa fa-sign-out fa-2x" aria-hidden="true"  style="float:right;color:#484399;margin-top:0px;margin-right:-60px;width:100px !important;float:right !important; height:25px "></i></a> 

              </div>

            </div>
				</div>
		</div>

			<!-- Header Mobile -->
		<div class="wrap_header_mobile">
    <h5 class="title" style="float: left;">Quiz Game Builder</h5>
      <a href="./logout.php">  <i class="fa fa-sign-out fa-2x" aria-hidden="true"  style="float:right;color:#484399;margin-top:0px;margin-right:-60px;width:100px !important;float:right !important; height:25px "></i></a> 
		</div>

	</header>
  <nav class="navbar navbar-light bg-light">
      <div class="container">
          <div class="row justify-content-between" style="display: contents; width:100%;">
          <div class="col-10">
          <a href="dashboard.php" > <i class="fa fa-chevron-circle-left fa-lg" aria-hidden="true"></i></a>
          </div>
          <div class="col-2">
            <h6>Adding questions</h6>
          </div>
          </div>
      </div>
  </nav>

  <div class="wrapper ">
   
    <div class="main-panel" style="width: 100%;">

 <!--php code to redirect to the test details php after successfull question add-->
   <?php
        include '../../database/config.php';
        $test_id = $_POST['test_id'];
    ?>
    <form id="form-completed" method="POST" action="test_details.php">
        <input type="hidden" name="test_id" value="<?= $test_id;?>">
    </form>
    <script>
        function completed() {
          document.getElementById("form-completed").submit();
        }
    </script>
    <?php
   

      $questRecords ="SELECT quest_task, quest_id From tbl_quest ";
      $quest_result =  mysqli_query($conn, $questRecords);

      if(isset($_POST['test_id'])) {
        $test_id = $_POST['test_id'];
        $sql = "SELECT * from tbl_tests where id = $test_id";
        $result = mysqli_query($conn,$sql);
        $test_details = mysqli_fetch_assoc($result);

        }
      $randomChosenQuestID= "SELECT quest_id, quest_task FROM tbl_quest ORDER BY RAND() LIMIT 1";
      $chosenRandomResultID =  mysqli_query($conn, $randomChosenQuestID);
      $randomizedID = mysqli_fetch_assoc($chosenRandomResultID);
      
      
      $randomQuestID = $randomizedID['quest_id'];
      $intQuest = (int) $randomQuestID;
      $score =1;
        if(isset($_POST['add_question'])) {

          echo "<script>console.log('".$test_id."');</script>";
          echo "<script>console.log('here');</script>";
          $question_text = $_POST['question_text'];
          $op_a = $_POST['op_a'];
          $op_b = $_POST['op_b'];
          $op_c = $_POST['op_c'];
          $op_d = $_POST['op_d'];
          $op_correct = $_POST['correctAnswer'];

      
          echo "<script>console.log('".$question_text."');</script>";
          echo "<script>console.log('".$op_a."');</script>";
          echo "<script>console.log('".$op_b."');</script>";
          echo "<script>console.log('".$op_c."');</script>";
          echo "<script>console.log('".$op_d."');</script>";
          echo "<script>console.log('".$op_correct."');</script>";
          echo "<script>console.log('".$intQuest."');</script>";

          
          
          $sql = "INSERT INTO tbl_questions (question_text,optionA,optionB,optionC,optionD,correctAns,quest_id, score) values('$question_text','$op_a','$op_b','$op_c','$op_d','$op_correct','$intQuest', '$score')";
          $result = mysqli_query($conn,$sql);
          echo "<script>console.log('done 1');</script>";
          if($result) {
            echo "<script>console.log('done 2');</script>";
            $question_id = mysqli_insert_id($conn);
            $sql1 = "INSERT INTO question_test_mapping VALUES('$question_id','$test_id')";
            mysqli_query($conn,$sql1);
          
            echo '<script type="text/javascript">',
          '</script>';
          }
        }
    ?>


      <div class="content" style="min-height: auto;margin: 4rem 2rem">
        <div class="row">
          <div class="col-md-2"></div>  

          <div class="col-md-8">
             <div class="card" style="border:1px solid #000">


              <div class="card-header">
                  <h5 class="title">Add New Question</h5>
                
              </div>


            
              <div class="card-body">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                  <input type="hidden" name="add_question">
                  <input type="hidden" name="test_id" value="<?= $test_id;?>">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Question:</label>
                          <input type="text" class="form-control" name="question_text" placeholder="Question text" required/>
                      </div>
                      <div class="row">
                        <div class="col-6">
                          <div class="form-group">
                            <label>Option A</label>
                              <input type="text" class="form-control" name="op_a" placeholder="Option (A)" required/>
                          </div>
                          <div class="form-group">
                            <label>Option B</label>
                              <input type="text" class="form-control" name="op_b" placeholder="Option (B)" required/>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label>Option C</label>
                              <input type="text" class="form-control" name="op_c" placeholder="Option (C)" required/>
                          </div>
                          <div class="form-group">
                            <label>Option D</label>
                              <input type="text" class="form-control" name="op_d" placeholder="Option (D)" required/>
                          </div>
                        </div>
                      
                       </div>
                    
                      <div class="row"> 
                        <div class="col-6">
                          <select id="correctAnswer" name="correctAnswer" name="class_option"  required style="width:100%;">
                              <option selected="true" id="chosenAnswer" disabled="disabled">Choose answer</option>   
                              <option value="A" >A</option>      
                              <option value="B">B</option>      
                              <option value="C" >C</option>      
                              <option value="D" >D</option>      
   
                          </select>

                          </div>
                          <div class="col-6">
                            <div class="select">
                              <select name="correspondingQuest" id="correspondingQuest"  style="width:100%;" required>
                                <option selected id="chosenQuest">Choose a quest</option>
                                    <?php    
                                  while($data = mysqli_fetch_array($quest_result))
                                    {         
                                    echo "<option value='". $data['quest_id'] ."'>" .$data['quest_task'] ."</option>";  // displaying data in option menu
                                    }?>
                                </select>
                            </div>
                          </div>     
                        </div>
                        <br><br>
                      
                    </div>
                  </div>
                  <div class="row center-element">
                    <div class="col-md-8">
                      <div class="form-group">
                        <button class="role-form-btn" id="addBtn">ADD QUESTION</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
        </div>

          <div class="col-md-2"></div>
        </div>
      </div>
     
    </div>
  </div>
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>


  <script>
  let questChoice = <?php echo (int) ($test_details['random_choice']); ?>;  
  let totalQuestions = <?php echo (int) ($test_details['total_questions']); ?>;  
                                
  let randomizedQuestID = <?php echo (int) ($randomizedID['quest_id']); ?>;
  console.log("choice if yes or no", questChoice);
    
  questChooser= document.getElementById("correspondingQuest");

    if(questChoice==1){
         
         for (i = 0; i < questChooser.length; i++) {
              questChooser[i].disabled=true;
              questChooser.value=randomizedQuestID;
              console.log("id of random quest", randomizedQuestID);
         }
       }
       else if(questChoice == 0){
             console.log("no");
       }

    chosenAnswer = document.getElementById("chosenAnswer").value;
    console.log(chosenAnswer);
  </script>
 
</body>
</html>