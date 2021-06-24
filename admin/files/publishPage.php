<?php
session_start();
if(!isset($_SESSION["user_id"]))
  header("Location:../index.php");
?>

<?php
  include '../../database/config.php';

$test_code = $_REQUEST['test_code'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="robots" content="noindex">
  <title>
  Publish Page
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/main.css" rel="stylesheet" />
  <link href="../../css/main.css" rel="stylesheet" />

</head>

<body class="">
<section>
			<div class="limiter">
      
				<div class="container-role">
        <div class="wrap-login100">
						
						<div class="login100-form validate-form">
						<span class="login100-form-title">
							Here's the quiz code.
						</span>
						
            <div id="login_form">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="text" id="testCode" class="input100" value="<?= $test_code;?>" style="text-align:center; padding-left:10px">
                        <span class="focus-input100"></span>
                       
                      </div>
                    </div>
                  </div>
                  
                  <div class="row center-element py-3">
                    <div class="col-md-12">
                      <div class="form-group" style="width: 100%;">
                        <button class="role-form-btn" onclick="copyCode()">Copy</button>
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
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script>
   function copyCode(){
    let copyCode = document.getElementById("testCode");

    /* Select the text field */
    copyCode.select();
    copyCode.setSelectionRange(0, 99999); /* For mobile devices */

    /* Copy the text inside the text field */
    document.execCommand("copy");

    /* Alert the copied text */
    alert("Copied the code: " + copyCode.value);
    window.location.href="dashboard.php";
   }
  </script>
</body>
</html>