<?php
session_start();

if(!isset($_SESSION["user_id"]))
  header("Location:../index.php");
  
?>
<?php
  include '../../database/config.php';
  $test_id = $_REQUEST['test_id'];

$questionid = $_REQUEST['id'];
$query = "SELECT * from tbl_questions where id= $questionid"; 
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

//$questID =  $row['quest_id'];

$questRecords ="SELECT quest_task, quest_id From tbl_quest ";
$quest_result =  mysqli_query($conn, $questRecords);


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="robots" content="noindex">
  <meta http-equiv="pragma" content="no-cache" />
  <meta http-equiv="expires" content="-1" />
  <title>
   Update Question
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
    <div class="row justify-content-between" style="display: contents; width:100%;">
          <div class="col-6 col-sm-8 col-lg-1o">
              <a href="dashboard.php" > <i class="fa fa-chevron-circle-left fa-lg" aria-hidden="true"></i></a>
          </div>
          <div class="col-4 col-sm-4 col-lg-2">
            Updating Question
          </div>
        </div>
    </nav>
    <div class="wrapper ">
   
        <div class="main-panel" style="width: 100%;">
            <?php

                if(isset($_POST['update_question'])) {
                $questionid = $_REQUEST['id'];
                    
                $question_text = $_POST['question_text'];
                $op_a = $_POST['op_a'];
                $op_b = $_POST['op_b'];
                $op_c = $_POST['op_c'];
                $op_d = $_POST['op_d'];
                $op_correct = $_POST['correctAnswer'];
                $chosen_quest = $_POST['correspondingQuest'];

                
                $sql = "UPDATE tbl_questions SET question_text= '$question_text'  ,optionA= '$op_a' ,optionB= '$op_b'  ,optionC= '$op_c' ,optionD= '$op_d' ,correctAns= '$op_correct',quest_id= '$chosen_quest' where id=$questionid";
                $result = mysqli_query($conn,$sql);

                //header("Location:test_details.php?test_id=$test_id");

                }
            
            ?>
            <div class="panel-header panel-header-sm">
            </div>

            <div class="content" style="min-height: auto;margin: 4rem 2rem">
                <div class="row">

                    <div class="col-md-2"></div>  

                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="title">Update Question</h5>                     
                            </div>
                        

                        <div class="card-body">
                            <form method="POST" >
                                <input type="hidden" name="update_question">
                                <input type="hidden" name="test_id" value="<?= $test_id;?>">
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Question:</label>
                                        <input type="text" class="form-control" name="question_text" placeholder="Question text" value="<?php echo $row['question_text'];?>" required/>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                        <div class="form-group">
                                            <label>Option A</label>
                                            <input type="text" class="form-control" name="op_a" placeholder="Option (A)"  value="<?php echo $row['optionA'];?>" required/>
                                        </div>
                                        <div class="form-group">
                                            <label>Option B</label>
                                            <input type="text" class="form-control" name="op_b" placeholder="Option (B)"  value="<?php echo $row['optionB'];?>" required/>
                                        </div>
                                        </div>
                                        <div class="col-6">
                                        <div class="form-group">
                                            <label>Option C</label>
                                            <input type="text" class="form-control" name="op_c" placeholder="Option (C)"  value="<?php echo $row['optionC'];?>" required/>
                                        </div>
                                        <div class="form-group">
                                            <label>Option D</label>
                                            <input type="text" class="form-control" name="op_d" placeholder="Option (D)"  value="<?php echo $row['optionD'];?>" required/>
                                        </div>
                                        </div>
                                    
                                    </div>
                                    
                                    <div class="row"> 
                                        <div class="col-6">
                                        <select id="correctAnswer" name="correctAnswer" name="class_option"  style="width:100%;" required>
                                            <option selected="true" id="chosenAnswer" value="" disabled="disabled">Choose answer</option>   
                                            <option value="A" id="optionA">A</option>      
                                            <option value="B" id="optionB">B</option>      
                                            <option value="C" id="optionC" >C</option>      
                                            <option value="D" id="optionD">D</option>      

                                        </select>

                                        </div>
                                        <div class="col-6">
                                            <div class="select">
                                            <select name="correspondingQuest" id="correspondingQuest"  style="width:100%;" required>
                                                <option selected id="chosenQuest" value="<?php echo $row['quest_id'];?>"> Choose a quest</option>
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
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-7"">
                                    <div class="form-group">
                                        <button class="role-form-btn" >UPDATE </button>
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
   

  <script src="../assets/js/core/jquery.min.js"></script>

  <script>
    let correctChoice = <?php echo ($row['correctAns']); ?>;
    answerChooser= document.getElementById("correctAnswer");
    console.log(answerChooser);
    answerChooser.value="hi";
    
    
  </script>
 
</body>
</html>