<?php
include '../config/clsConnection.php';
include '../objects/clsUser.php';

$database = new clsConnection();
$db = $database->connect();

$user = new Users($db);

$date_hire = date('Y-m-d', strtotime($_POST['date_hire']));
$user->firstname = strtoupper($_POST['firstname']);
$user->lastname = strtoupper($_POST['lastname']);
$user->position = strtoupper($_POST['position']);
$user->project = $_POST['project'];
$user->unit = $_POST['project'];
$user->date_hire = $date_hire;
$user->dept = $_POST['dept'];
$user->email = $_POST['email'];
$user->username = $_POST['username'];
$user->user_pass = md5('123456');
$user->logcount = 0;
$user->access = $_POST['access'];
$user->role = $_POST['role'];
$user->status = 1;

$save = $user->addUser();
if ($save) {
    echo 1;
} else {
    echo 0;
}
