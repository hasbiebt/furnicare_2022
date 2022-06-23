<?php

if (!isset($_SESSION))
    session_start();
include_once $_SERVER['DOCUMENT_ROOT'].'/furnicare_2022/php/dbconnect.php';

class User {

    var $dbObj;

    public function __construct() {
        $this->dbObj = new db();
    }

    public function insert($full_name, $user_name, $email, $phone_no, $password) {
        $password = hash('sha256', $password);
        $sql = " INSERT INTO user"
                . " (full_name,user_name,email,phone_no,password)"
                . " VALUES('$full_name', '$user_name', '$email', '$phone_no', '$password')";
        return $this->dbObj->ExecuteQuery($sql, 2);
    }

    public function update($full_name, $user_name, $email, $phone_no, $password) {
        if (empty($password))
            $password = $old_password;
        else
            $password = hash('sha256', $password);
        $sql = " UPDATE"
                . " user "
                . " SET full_name = '$full_name', user_name = '$user_name',email = '$email',phone_no = '$phone_no',"
                . " password = '$password'"
                . " WHERE user_id = '$user_id'";
        return $this->dbObj->ExecuteQuery($sql, 3);
    }

    public function select_by_id($user_id) {
        $sql = " SELECT"
                . " user_id,full_name,user_name,email,phone_no,password"
                . " FROM user WHERE user_id = '$user_id'";
        return $this->dbObj->ExecuteQuery($sql, 1);
    }

    public function delete_account($user_id) {
        $sql = " DELETE FROM user WHERE user_id = '$user_id'";
        return $this->dbObj->ExecuteQuery($sql, 3);
    }

    public function login($email, $password) {
        $password = hash('sha256', $password);
        $sql = " SELECT"
                . " user_id,user_name"
                . " FROM user WHERE"
                . " email = '$email' AND password = '$password'";
        $data = $this->dbObj->ExecuteQuery($sql, 1);
        if (mysqli_num_rows($data) > 0) {
            $fetch_data = mysqli_fetch_assoc($data);
            $_SESSION['user_id'] = $fetch_data['user_id'];
            $_SESSION['full_name'] = $fetch_data['full_name'];
            header("location:../index.html");
        } else {
            echo "<script>window.location='index.php';alert('Invalid User Name or Password !!')</script>";
        }
    }

}

?>