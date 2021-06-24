
<?php  
include "../../database/config.php";  

$input = filter_input_array(INPUT_POST);

$question_txt = mysqli_real_escape_string($conn, $input["question_text"]);
$option_a = mysqli_real_escape_string($conn, $input["optionA"]);
$option_b = mysqli_real_escape_string($conn, $input["optionB"]);
$option_c = mysqli_real_escape_string($conn, $input["optionC"]);
$option_d = mysqli_real_escape_string($conn, $input["optionD"]);
$correct_choice = mysqli_real_escape_string($conn, $input["correctAns"]);


if($input["action"] === 'edit')
{
 $query = "
 UPDATE tbl_user 
 SET first_name = '".$question_txt."', 
 last_name = '".$option_a."',
 last_name = '".$option_b."',
 last_name = '".$option_c."',
 last_name = '".$option_d."',
 last_name = '".$correct_choice."',
 WHERE id = '".$input["id"]."'
 ";

 mysqli_query($conn, $query);

}
if($input["action"] === 'delete')
{
    $sql = "DELETE from question_test_mapping where question_id = '$question_id' and test_id = '$test_id'";
    mysqli_query($conn,$sql);
    
}

echo json_encode($input);

?>
