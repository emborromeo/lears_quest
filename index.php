<?php

?>

<html>
	<head>
		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title>Lear's Quest</title>
	    <link rel="icon" type="image/png" href="admin/assets/img/favicon.png">
		<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/header.css">
		<link rel="stylesheet" type="text/css" href="css/util.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
	
		<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>

	</head>

	<body>
	
		<section>
			<div class="limiter">
				<div class="container-role">
					<div class="wrap-role">
						<div class="role-form">
						<span class="role-form-title">
							Hi, choose your role.
						</span>
						
						<div class="container-role-form-btn">
							<button class="role-form-btn" onclick="adminView()">
								Teacher
							</button>
						</div>

						<div class="container-role-form-btn">
							<button class="role-form-btn" onclick="studentView()">
								Student
							</button>
						</div>

</div>
					</div>
				</div>
			</div>
		</section>
		<script>
		function adminView(){
            window.location.replace("admin/index.php");

        }
        function studentView(){
           window.location.replace("files/playerLogin.php");

        }
		</script>
	</body>
</html>