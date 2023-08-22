<?php
include '../config/clsConnection.php';
include '../objects/clsDetails.php';

$database = new clsConnection();
$db = $database->connect();

$details = new ParDetails($db);

$details->id = $_POST['id'];
$details->recommendation = $_POST['recommendation'];
$details->gross = $_POST['gross'];

$upd = $details->update_PAR_manager();
if($upd)
{
    echo 1;
}
else
{
    echo 0;
}
?>