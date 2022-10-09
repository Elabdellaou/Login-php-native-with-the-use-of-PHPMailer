<?php
session_start();
require 'concetion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $f = new filter_info();
        $f->filter_information($_POST['password'], $_POST['username'], $_POST['email'], $_POST['cpassword']);
        $c = new conect();
        $c->Connection();
        $u = new user($_POST['username'], filter_var($_POST['email'], FILTER_SANITIZE_EMAIL), $_POST['password'], null, null);
        $result = $c->select();
        while ($row = $result->fetch_assoc()) {
            if ($row['email'] == $u->getEmail()) {
                $_SESSION['name'] = $row['Nom'];
                $_SESSION['email'] = $row['email'];
                header('Location:register.php?err');
                exit();
            }
        }
        $u->setFullname(mysqli_real_escape_string($c->getConnection(), $_POST['username']));
        $c->insert($u);
        header('Location:login.php');
    }
}
