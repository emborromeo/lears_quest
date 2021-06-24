<?php
session_start();
if(!isset($_SESSION["user_id"]))
  header("Location:../index.php");

include '../../database/config.php'; 


$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 
  function generate_string($input, $strength = 16) {
      $input_length = strlen($input);
      $random_string = '';
      for($i = 0; $i < $strength; $i++) {
          $random_character = $input[mt_rand(0, $input_length - 1)];
          $random_string .= $random_character;
      }
   
      return $random_string;
  }
   
  // Output: iNCHNGzByPjhApvn7XBD
  $generatedCode= generate_string($permitted_chars, 10);

if(isset($_POST['new_test'])) {
  $quiz_name = $_POST['quizTitle'];
  $quiz_subject = $_POST['quizScope'];
  $total_questions = $_POST['quizTotal'];
  $quiz_random = $_POST['random'];

  $teacher_id = $_SESSION["user_id"];
  //creating new test
  $sql = "INSERT INTO tbl_tests (teacher_id,title, scope ,total_questions,random_choice, generatedCode) VALUES('$teacher_id','$quiz_name','$quiz_subject','$total_questions','$quiz_random', '$generatedCode')";
  $result = mysqli_query($conn,$sql);
  $quizid = mysqli_insert_id($conn);
  if($result) {
    header("Location:dashboard.php");

  }
 
}
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
                    <a href="./logout.php">  <i class="fa fa-sign-out fa-2x" aria-hidden="true"  style="color:#484399;margin-top:0px;margin-right:100px;width:100px !important;float:right !important; height:25px "></i></a> 

                </div>
              </div>
          </div>
			</div>

			<!-- Header Mobile -->
			<div class="wrap_header_mobile">
      <h5 class="title" style="float: left;">Quiz Game Builder</h5>
         <a href="./logout.php">  <i class="fa fa-sign-out fa-2x" aria-hidden="true"  style="color:#484399;margin-top:0px;margin-right:-60px;width:100px !important;float:right !important; height:25px "></i></a> 
			</div>

		
		</header>
    <nav class="navbar navbar-light bg-light">
      <div class="container">
          <div class="row justify-content-between" style="display: contents; width:100%;">
          <div class="col-10">
          <a href="dashboard.php" > <i class="fa fa-chevron-circle-left fa-lg" aria-hidden="true"></i></a>
          </div>
          <div class="col-2">
            <h6> Adding new quiz</h6>
          </div>
          </div>
      </div>
    </nav>

  <div class="wrapper ">
  
    <div class="main-panel" style="width: 100%;">
   
    <div class="content" style="margin:4rem 2rem; ">
        <div class="row">
          <div class="col-md-2" style="height:20px"></div>  
          <div class="col-md-8">
            <div class="card">

              <div class="card-header">
                <h5 class="title">Create New Quiz</h5>
              </div>

              <div class="card-body">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                  <input type="hidden" name="new_test">

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Title</label>
                          <input type="text" class="form-control" name="quizTitle" placeholder="Quiz name" required/>
                      </div>
                      <div class="form-group">
                        <label>Summary</label>
                          <input type="text" class="form-control" name="quizScope" placeholder="Quiz scope" required/>
                      </div>
                     
                      <div class="form-group">
                        <label>Total Questions</label>
                          <input type="number" class="form-control" name="quizTotal" placeholder="Quiz no. of questions" min="1" max="10" required/>
                      </div>

                      <div class="form-group">
                        <label>Randomize questions?</label> <br>                      
                        <div class="form-check">   
                          <input class="form-check-input" type="radio" name="random" id="randomYes" value="1" checked>
                          <label class="form-check-label"> Yes </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="random" id="randomNo" value="0" >
                          <label class="form-check-label"> No</label>
                        </div>
                     </div>
                    <div class="row center-element">
                        <div class="col-md-8">
                          <div class="form-group">
                            <button class="create-btn">CREATE QUIZ</button>
                          </div>
                        </div>
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

  
  </script>
</body>
</html>