<?php
$hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "assignment_guvi";
    $port = "3306";
    $conn =  mysqli_connect($hostname, $username, $password, $database, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$stmt = mysqli_prepare($conn, "UPDATE `users` SET `first_name`=?,`last_name`=?,`age`=?, `gender`=?,`mobile`=? WHERE `id`=?");
mysqli_stmt_bind_param($stmt, "ssissi",$first_name, $last_name,$age,$gender,$mobile,$id);

if (mysqli_stmt_execute($stmt)) {
    echo "Record updated Successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>




