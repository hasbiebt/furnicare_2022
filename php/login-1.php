<?php
if (isset($_POST['login'])) {
    include_once $_SERVER['DOCUMENT_ROOT'].'/furnicare_2022/php/user-dbop.php';
    $objUser = new User();
    $objUser->login($_POST['email'], $_POST['password']);
    header('location:../index.html');
}
?>