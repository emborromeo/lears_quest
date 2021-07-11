<?php
session_start();
if(isset($_SESSION["player_id"]))
  header("Location:testCodePage.php");
?>

<html>
	<head>
		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title>Student Login</title>
	    <link rel="icon" type="image/png" href="../admin/assets/img/favicon.png">
		<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/header.css">
		<link rel="stylesheet" type="text/css" href="../css/util.css">
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
		<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="../vendor/tilt/tilt.jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>

	</head>

<body style="display: flex;">

		<section>
			<div class="limiter">
				<div class="container-login100">
					<div class="wrap-login100">
						
						<div class="login100-form validate-form">
						<span class="login100-form-title">
							Hello, sign in here.
						</span>
						
						
					<form id="player_login_form">
					<div class="row center-element">
                    <div class="col-12">
                      <div class="form-group">
                        <input type="text" id="studentUsername" name="studentUsername" class="input100" placeholder="Username" >
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                      <i class="fa fa-user-circle" aria-hidden="true"></i>
                      </span>
                      <span class="error text-danger" id="empty_roll_number_field"></span>
                      </div>
                    </div>
                  </div>
				  <div class="row center-element">
                    <div class="col-12">
                      <div class="form-group">
                        <input type="password" id="studentPassword" name="studentPassword" class="input100" placeholder="Password">
                      	<span class="focus-input100"></span>
                        <span class="symbol-input100">
                          <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                        <span class="error text-danger" id="empty_roll_password_field"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row center-element py-3">
                    <div class="col-12">
                      <div class="form-group" style="width: 100%;">
                        <button class="role-form-btn">Sign in</button>
                      </div>
                    </div>
                  </div>
                   <div class="row">
                    <div class="col-md-12">
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
		<script>
		

		$('#player_login_form').submit(function(event) {
		console.log($(this).serialize());
		$("#result").html("Logging in...");
		/* Act on the event */
		event.preventDefault();
		$.ajax({
			type:"POST",
			url:"student_login.php",
			data:$(this).serialize(),
			success:function(data)
			{
			if(data=="success")
			{
				$("#result").html("Login Successful");
				setTimeout(function(){
				window.location="testCodePage.php";
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