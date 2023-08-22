<?php
include '../config/clsConnection.php';
include '../objects/clsUser.php';

$database = new clsConnection();
$db = $database->connect();

$user = new Users($db);

$user->id = $_POST['id'];
$user->user_pass = md5('123456');
$user->logcount = 0;
$reset = $user->reset_user();

if ($reset) {
    echo 1;
} else {
    echo 0;
}
