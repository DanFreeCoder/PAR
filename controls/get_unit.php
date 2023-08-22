<?php
include '../config/clsConnection.php';
include '../objects/clsUser.php';

$database = new clsConnection();
$db = $database->connect();

$user = new Users($db);

$user->dept_id = $_POST['dept'];
$count = $user->count_unit();
while($row_count = $count->fetch(PDO::FETCH_ASSOC))
{
    if($row_count['counts'] > 0)
    {
        //get the list of units
        $user->dept_id = $_POST['dept'];
        $sel = $user->view_unit();
        while($row = $sel->fetch(PDO::FETCH_ASSOC))
        {
            echo '<option value='.$row['id'].'>'.$row['unit_name'].'</option>';
        }
    }
    else
    {
        //get the COMMON UNITS(HEAD OFFICE)
        $sel = $user->view_common_unit();
        while($row = $sel->fetch(PDO::FETCH_ASSOC))
        {
            echo '<option value='.$row['id'].' selected>'.$row['unit_name'].'</option>';
        }
    }
}
?>