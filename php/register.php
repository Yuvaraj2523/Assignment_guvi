<?php
require 'dbconn.php';

header('Content-Type: application/json; charset=utf-8');

if (isset($_POST['signup'])) {
    $response = ['success'=>true,'message'=>'User created Successfully !'];

    try {
        newUser($_POST['email'],password_hash($_POST['password'],PASSWORD_DEFAULT),$_POST['first_name'],$_POST['last_name'],$_POST['age'],$_POST['gender'],$_POST['mobile']);
    } catch (\Throwable $th) {
        $response = ['success'=>false,'message'=>'User with the email already exists !'];

    }
    echo json_encode($response);
}