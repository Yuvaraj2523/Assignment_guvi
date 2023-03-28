<?php
function get_connection()
{
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "assignment_guvi";
    $port = "3306";
    $conn =  mysqli_connect($hostname, $username, $password, $database, $port);

    if (!$conn) {
        die("DB Error");
    } else {
        return $conn;
    }
}

mysqli_query(get_connection(),"CREATE TABLE IF NOT EXISTS `assignment_guvi`.`users` (`id` INT NOT NULL AUTO_INCREMENT , `email` VARCHAR(256) NOT NULL , `password` VARCHAR(256) NOT NULL , `first_name` VARCHAR(256) NOT NULL , `last_name` VARCHAR(256) NOT NULL , `age` INT NOT NULL , `gender` VARCHAR(10) NOT NULL , `mobile` VARCHAR(25) NOT NULL, PRIMARY KEY (`id`), UNIQUE (`email`));");

function newUser($email,$password,$first_name,$last_name,$age,$gender,$mobile){
    $conn = get_connection();
    $stmt =  mysqli_prepare($conn,"INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`, `age`, `gender`, `mobile`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssiss",$email,$password,$first_name,$last_name,$age,$gender,$mobile);
    try {
        $stmt->execute();
    } catch (\Throwable $th) {
        throw $th;
    }
}

function getByEmail($email){
    $sql = "SELECT * FROM `users` WHERE `email` = ? ";
    $conn = get_connection();
    $stmt =  mysqli_prepare($conn,$sql);
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result){
        return $result->fetch_assoc();
    }

    return false;
}

function update($first_name,$last_name,$age,$gender,$mobile,$id){
    $conn = get_connection();
    $stmt = mysqli_prepare($conn, "UPDATE `users` SET `first_name`=?,`last_name`=?,`age`=?, `gender`=?,`mobile`=? WHERE `id`=?");
    mysqli_stmt_bind_param($stmt, "ssissi",$first_name, $last_name,$age,$gender,$mobile,$id);
    try {
        $stmt->execute();
    } catch (\Throwable $th) {
        throw $th;
    }
}


?>



