<?php
session_start();
include '../config/clsConnection.php';
include '../objects/clsUser.php';

$database = new clsConnection();
$db = $database->connect();

$user = new Users($db);

$user->id = $_POST['id'];
$user->user_pass = md5($_POST['password']);
$user->logcount = 0;
$exe = $user->reset_user();

if ($exe) {
    echo 1;
} else {
    echo 0;
}
