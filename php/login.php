<?php
require 'dbconn.php';
session_start();
header('Content-Type: application/json; charset=utf-8');

if (isset($_POST['login'])) {
    $user = getByEmail($_POST['email']);
    $response = [ 'success' => true, 'message' => 'User loggedin Successfully !'];
    if ($user) {
        if (password_verify($_POST['password'], $user['password'])) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['loggedin'] = true;
            $response['session'] = true;
        } else {
            $response['success'] = false;
            $response['message'] = 'Password Incorrect';
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'User does not exist !';
    }
    echo json_encode($response);
}
