<?php
session_start();
if(isset($_SESSION["player_id"]))
    
$student_id = $_SESSION['player_id'];

 include '../database/config.php';

   
 $checkCode = "SELECT `generatedCode` FROM tbl_tests ";
  $try=mysqli_query($conn,$checkCode);
  if(mysqli_num_rows($try) > 0) {
    while($row = mysqli_fetch_row($try)) {
      $tempArray[] = $row;
    }

  }

?>

<?php

 
 
     ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="robots" content="noindex">
  <title>
 Lear's Quest
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="../admin/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../admin/assets/css/main.css" rel="stylesheet" />
  <link href="../css/main.css" rel="stylesheet" />

</head>

<body class="">
<section>
			<div class="limiter">
      
				<div class="container-role">
        <div class="wrap-login100">
						
						<div class="login100-form">
						<span class="login100-form-title">
							Paste the quiz code.
						</span>
						
            <!--<form id="login_form" method="post" action="playerStart.php">-->


                  <div class="row center-element">
                    <div class="col-12 col-md-12">
                      <div class="form-group">
                        <input type="text" name="testCode" id="testCode" class="input100" style="text-align:center; padding-left:10px" required>
                        <span class="focus-input100"></span>
                       
                      </div>
                    </div>
                  </div>
                  
                  <div class="row center-element py-3">
                    <div class="col-12 col-md-12">
                      <div class="form-group" style="width: 100%;">
                      <a href="#" data-toggle="modal" data-target="#" id="modalQuestionAlert"> <button class="role-form-btn" onclick="checkCode()">Submit </button></a>
                      </div>
                    </div>
                  </div>
              
                <!--</form>-->

                

                <div class="modal fade" id="codeAlert" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                      <div class="modal-body">
                        <span id="modalText"></span>
                      </div>
                      <div class="modal-footer">
                     <button type="button" class="role-form-btn" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
              </div>



            </div>
					</div>
				</div>
				</div>
			</div>
		</section>

  <!--   Core JS Files   -->
  <script src="../admin/assets/js/core/jquery.min.js"></script>
  <script src="../admin/assets/js/core/popper.min.js"></script>
  <script src="../admin/assets/js/core/bootstrap.min.js"></script>
  <script>


    let code = <?php echo json_encode($tempArray); ?>;
    console.log(code);
    let codeInput;    
    let codeExists;
    function checkCode(){
      codeInput = document.getElementById("testCode").value;

      console.log(codeInput);

      codeExists = exists(code, codeInput);

     console.log(codeExists);
     codeResult();
    }
  
    function exists(arr, search) {
      return arr.some(row => row.includes(search));
   }
   
   function codeResult(){
     if(codeExists==true){
     window.location = "playerStart.php?testCode="+codeInput;

   }
   else{
    document.getElementById("modalQuestionAlert").dataset.target ="#codeAlert";
    document.getElementById("modalText").innerHTML= "Incorrect Quiz Code";
   }
   }
 
  
  </script>
</body>
</html>