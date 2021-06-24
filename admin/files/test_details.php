<?php
session_start();
if(!isset($_SESSION["user_id"]))
  header("Location:../index.php");
?>
<?php
  include '../../database/config.php';

  if(isset($_POST['general_settings_update'])) {
    $test_id = $_POST['test_id'];
    $test_name = $_POST['test_name'];
    $test_scope = $_POST['quiz_scope'];
    $total_questions = $_POST['total_questions'];
    $random = $_POST['random'];
    $general_settings = false;

  
    $sql = "UPDATE tbl_tests SET title = '$test_name', scope = '$test_scope', total_questions = '$total_questions', random_choice = '$random' WHERE id = '$test_id'";
    $result = mysqli_query($conn,$sql);
    if($result) {
      $general_settings = true;
    }
  }
  
  function generateRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }


  if(isset($_POST['deleted'])) {
    $test_id = $_POST['test_id'];
    $delete = false;
    $sql1= "DELETE from question_test_mapping WHERE test_id = $test_id";
    $result1 = mysqli_query($conn,$sql1);


  }

  if(isset($_POST['test_id'])) {
    $test_id = $_POST['test_id'];
    $sql = "SELECT * from tbl_tests where id = $test_id";
    $result = mysqli_query($conn,$sql);
    $test_details = mysqli_fetch_assoc($result);

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
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />

  <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" charset="utf-8">
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
           Editing Quiz Info
        </div>
        </div>
    </div>
  </nav>
  <div class="wrapper ">
  
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content" style="margin: 4rem 2rem;min-height: auto;">
        <div class="row">
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Quiz Info</h5>
              </div>
              <div class="card-body">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                  <input type="hidden" name="general_settings_update">
                  <input type="hidden" name="test_id" value="<?= $test_id;?>">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Quiz Title</label>
                        <input type="text" class="form-control" name="test_name"  value="<?= $test_details["title"];?>"/>
                      </div>
                      <div class="form-group">
                        <label>Quiz scope</label>
                        <input type="text" class="form-control" name="quiz_scope" value="<?= $test_details["scope"];?>"/>
                      </div>
                    
                      <div class="form-group">
                        <label>Total Questions count</label>
                          <input type="number" class="form-control" min="1" max="10" name="total_questions" value="<?= $test_details["total_questions"];?>" required/>
                      </div>
                      <div class="form-group">
                        <label>Randomized quests?</label>
                        <div class="form-check">

                          <input class="form-check-input" type="radio" name="random" id="randomYes" value="1" checked>
                          <label class="form-check-label">
                          Yes
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="random" id="randomNo" value="0">
                          <label class="form-check-label">
                          No
                          </label>
                        </div>
                     </div>
                    </div>
                  </div>
                  <div class="row center-element">
                    <div class="col-md-8">
                      <div class="form-group">
                        <button class="role-form-btn">UPDATE</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
              <div class="row">
                  <div class="col-md-6">
                    <h5 class="title"> Questions</h5>
                  </div>
                  <form id="form-add-questions" method="POST" action="add_question.php">
                    <input type="hidden" name="test_id" value="<?= $test_id;?>">
                  </form>
             
                  <div class="col-md-6">
                    <button class="role-form-btn" onclick="redirect_to_add_question()" style="margin-top:0px;width:200px !important;float:right !important;">ADD QUESTION</button>
                  </div>
                </div>  
              </div>
              <div class="card-body">
              <div class="table-responsive">
              

                <table id="question_list" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Question</th>
                              <th>Option(A)</th>
                              <th>Option(B)</th>
                              <th>Option(C)</th>
                              <th>Option(D)</th>
                              <th>Answer</th>
                              <th colspan="2">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                      
                          <?php
                            $sql = "select question_id from question_test_mapping where test_id = $test_id";
                            $result = mysqli_query($conn,$sql);
                            $i = 1;
                            while($row = mysqli_fetch_assoc($result)) {
                              $question_id = $row["question_id"];
                              $sql1 = "select * from tbl_questions where id = $question_id";
                              $result1 = mysqli_query($conn,$sql1);
                              $row1 = mysqli_fetch_assoc($result1);

                              ?>
                              <tr id = "<?= $row1["id"]; ?>">


                                <input type="hidden" id="question_id" value="<?= $row1["id"]; ?>">
                                <td><?=$i?>.</td>
                                <td><?=$row1["question_text"]?></td>
                                <td><?= $row1["optionA"];?> </td>
                                <td><?= $row1["optionB"];?></td>
                                <td><?= $row1["optionC"];?></td>
                                <td><?= $row1["optionD"];?></td>
                                <td><?= $row1["correctAns"];?></td>
                                

                                <!--<td><button id="update" name="update" class="role-form-btn update" onclick="update_question('<?= $row1["id"]; ?>')"><i class="fa fa-save"></i></button></td>-->
                                <td><a href="updateQuestionPage.php?id=<?php echo $row1["id"]; ?>"><i class="fa fa-edit fa-lg"></i></a></td>
                                <td><a onclick="delete_question('<?= $row1["id"]; ?>','<?php echo $test_id; ?>')" id="delete" name="delete"><i class="fa fa-trash fa-lg"></i></a> </td>
                              </tr>

                            <?php
                            $i++;
                            }    
                          ?>
                          <!--
                          <?php
                              $questionID= $row1["id"];
                              if(isset($_POST['questions_update'])) {
                                $test_id = $_POST['test_id'];
                                $quest_text = $_POST['questionText'];
                                $opt_A = $_POST['choiceA'];
                                $opt_B = $_POST['choiceB'];
                                $opt_C = $_POST['choiceC'];
                                $opt_D = $_POST['choiceD'];
                                $answer = $_POST['choiceD'];                          
                              
                                $sql = "UPDATE tbl_questions SET question_text  = '$quest_text', optionA  = '$opt_A', optionB  = '$opt_B', optionC  = '$opt_C', optionD  = '$opt_D, correctAns  = '$answer' WHERE id = '$questionID'";
                                $result = mysqli_query($conn,$sql);
                              
                              }
                          ?>-->
                      </tbody>
                    </table>
                          
              </div>
              </div>
            </div>
          </div>
        </div> <br>

        <div class="row">
          <div class="container" style="width: 15rem"> 
          <a href="publishPage.php?test_code=<?php echo $test_details["generatedCode"]; ?>"><button class="role-form-btn" >Publish</button></a> 
          </div>
        </div>
      </div>



    
  </div>
<!--   Core JS Files   -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js"></script>
  <script src="../../vendor/jquery/jquery.tabledit.min.js"></script>
  <script src="../assets/js/core/jquery.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>

<script>

    function redirect_to_add_question() {
      document.getElementById("form-add-questions").submit();
    }


    function deleted() {
      document.getElementById("form-deleted").submit();
    }

    function delete_question(temp,testid) {
      var temp1 = document.getElementById(temp);
      temp1.style.display = 'none';
      $.ajax({
          type: 'POST',
          url: 'delete_question.php',
          data: {
            'question_id': temp,
            'test_id': testid,
          },
          success: function (response) {
          }
      });
    }

      /*
$(document).ready(function(){  
     $('#question_list').Tabledit({
      url:'update_question.php',
      columns:{
       identifier:[0, "id"],
       editable:[[1, 'question_text'], [2, 'optionA'], [3, 'optionB'] ,[4, 'optionC'], [5, 'optionD'] [6, 'correctAns']]
      },
      restoreButton:false,
      onSuccess:function(data, textStatus, jqXHR)
      {
       if(data.action == 'delete')
       {
        $('#'+data.id).remove();
       }
      },
      buttons: {
    edit: {
        class: 'btn btn-sm btn-default',
        html: '<span class="glyphicon glyphicon-pencil"></span>',
        action: 'edit'
    },
    delete: {
        class: 'btn btn-sm btn-default',
        html: '<span class="glyphicon glyphicon-trash"></span>',
        action: 'delete'
    },
    save: {
        class: 'btn btn-sm btn-success',
        html: 'Save'
    },
    restore: {
        class: 'btn btn-sm btn-warning',
        html: 'Restore',
        action: 'restore'
    },
    confirm: {
        class: 'btn btn-sm btn-danger',
        html: 'Confirm'
    }
     });
    });

   
    function update_question(temp) {
      var temp2 = document.getElementById(temp);
      temp2.style.display = 'none';
      $.ajax({
          type: 'POST',
          url: 'update_question.php',

          data: {
            'question_id': temp,
          },
          success: function (response) {
          }
      });
    }
<?php
  if($general_settings == "true")
  {
    ?>

    <script type="text/javascript">
      $.notify({
        message: 'Quiz Info Updated Successfully' 
      },{
        type: 'success'
      });
  

    <?php
  }
  else if($general_settings == "false")
  {
    ?>

      <script type="text/javascript">
        $.notify({
          message: 'There was an error updating quiz info' 
        },{
          type: 'danger'
        });

    <?php
  }
  else {}
  
?>

*/

</script>

</body>
</html>