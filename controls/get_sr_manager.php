<?php
include '../config/clsConnection.php';
include '../objects/clsUser.php';
include '../objects/clsDetails.php';

$database = new clsConnection();
$db = $database->connect();

$user = new Users($db);
$details = new ParDetails($db);

$id = $_POST['id'];
if($id == 0)
{
	$view = $user->view_sr_manager();
	while($row = $view->fetch(PDO::FETCH_ASSOC))
	{
		echo '<option value="'.$row['id'].'">'.$row['fullname'].'</option>';
	}
}
else
{
	//get the rater_name of par
	$details->id = $id;
	$sel = $details->get_unevaluated_par();
	while($row1 = $sel->fetch(PDO::FETCH_ASSOC))
	{	
		$user->dept = $_POST['dept'];
		$view = $user->view_sr_manager();
		while($row2 = $view->fetch(PDO::FETCH_ASSOC))
		{
			if($row2['id'] == $row1['rater_id']){
				echo '<option value="'.$row2['id'].'"selected>'.$row2['fullname'].'</option>';
			}else{
				echo '<option value="'.$row2['id'].'">'.$row2['fullname'].'</option>';
			}	
		}
	}	
}
?>