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
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- CSS Files -->
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
      <h6>Dashboard</h6>
      </div>
      <div class="col-2">
         <h6>Welcome, teacher. </h6>
      </div>
      </div>
  </div>
</nav>
  <div class="wrapper ">
  
    <div class="main-panel" style="width: 100%; ">

      <div class="content" style="margin-top:40px; padding:50px 50px;">
        <div class="row">
          <div class="col-md-12">
            <div class="card" style="min-height:400px;">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-10 col-xs-12">
                  <h5 class="title" style="float: left">Quizzes</h5>

                  </div>
                  <div class="col-md-2 col-xs-12">
                       <button class="role-form-btn admin-btn" onclick="redirect_to_new_test()" style="height: 2rem; width:140px;"> New Quiz</button>
                  </div>
                </div>  
              </div> 
              <div class="card-body" >
              <?php
                    include '../../database/config.php';
                    $user_id = $_SESSION["user_id"];
                    $sql = "select * from tbl_tests where teacher_id = $user_id ";
                    $result = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                        ?>
                          <div class="card" style="background:#ededed;">
                              <div class="card-body" onclick="submit(<?= $row['id'];?>)">
                                <h6><?= $row["title"];?></h6>
                                <div class="row">
                                  <div class="col-md-8">
                                    <p>Scope - <?= $row['scope'];?></p>
                                  </div>
                                  <div class="col-md-4"> 
                                    <p style="text-align:right;">Total - <?= $row['total_questions'];?></p>
                                  </div>
                                </div>
                              </div>
                          </div> <br>
                        <?php
                      }
                    }
                    else {
                      ?>
                      <div id="no-data">              
                          <center><h5>No Data</h5></center>
                        
                      </div>
                      <?php
                    }
                  ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <form method="POST" action="test_details.php" id="test_details">
        <input type="hidden" id="test_id" name="test_id">
      </form>
    
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.1.0" type="text/javascript"></script>
  <!-- <script src="http://jqueryte.com/js/jquery-te-1.4.0.min.js"></script> -->
</body>
<script>
  function redirect_to_new_test() {
    window.location = "new_test.php";
  }

  function submit(val1) {
    document.getElementById("test_id").value = val1;
    document.getElementById("test_details").submit();
  }
</script>
</html>