<?php
session_start();
if(isset($_SESSION["user_id"]))
  header("Location:files/dashboard.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="robots" content="noindex">
  <title>
   Admin Login
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/main.css" rel="stylesheet" />
  <link href="../css/main.css" rel="stylesheet" />

</head>

<body class="">
<section>
			<div class="limiter">
      
				<div class="container-role">
					<div class="wrap-role">
						<div class="role-form">
						<span class="role-form-title">
							Hi, sign in here.
						</span>
						
                <form id="login_form">
                
                <div class="row center-element">
                    <div class="col-12 col-md-12 col-sm-6">
                      <div class="form-group">
                        <input type="text" id="username" name="username" class="input100" placeholder="Username" >
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                      <i class="fa fa-user-circle" aria-hidden="true"></i>
                      </span>
                      <span class="error text-danger" id="empty_roll_number_field"></span>
                      </div>
                    </div>
                  </div>
                 
                  <div class="row center-element">
                    <div class="col-12 col-md-12 col-sm-6">
                      <div class="form-group">
                        <input type="password" id="password" name="password" class="input100" placeholder="Password">
                      	<span class="focus-input100"></span>
                        <span class="symbol-input100">
                          <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                        <span class="error text-danger" id="empty_roll_password_field"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row center-element">
                  <div class="col-12 col-md-12 col-sm-6">
                      <div class="form-group" style="width: 100%;">
                        <button class="role-form-btn">Sign in</button>
                      </div>
                    </div>
                  </div>
                  <div class="row center-element ">
                  <div class="col-6 col-md-12">
                      <div class="form-group">
                      <center><div id="result"></div></center>
                      </div>
                    </div>
                  </div>
                </form>
             

</div>
					</div>
				</div>
			</div>
		</section>

  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script>
    $('#login_form').submit(function(event) {
      console.log($(this).serialize());
      $("#result").html("Logging in...");
      /* Act on the event */
      event.preventDefault();
      $.ajax({
        type:"POST",
        url:"files/checklogin.php",
        data:$(this).serialize(),
        success:function(data)
        {
          if(data=="success")
          {
            $("#result").html("Login Successful");
            setTimeout(function(){
              window.location="files/dashboard.php";
            },1200);
          }
          else
          {
            $("#result").html("Login Failed");
          }
        }
      });
    });
  </script>
</body>
</html>