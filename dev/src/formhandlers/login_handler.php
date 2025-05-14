<?php
session_start();

include_once('../Database/Database.php');

// Validatie
if(!isset($_POST['email']) || empty($_POST['email'])) {
   header('Location: ../../login.php');
   exit();
}

if(!isset($_POST['password']) || empty($_POST['password'])) {
   header('Location: ../../login.php');
   exit();
}

$email = htmlentities($_POST['email']);
$password = htmlentities($_POST['password']);

$sql = "SELECT * FROM customers WHERE email = '$email'";
Database::query($sql);
$customer = Database::get();

if(empty($customer)) {
   header('Location: ../../login.php');
   exit();
}

if(!password_verify($password, $customer->password)) {
   header('Location: ../../login.php');
   exit();
}

$_SESSION['user_id'] = $customer->id;
$_SESSION['firstname'] = $customer->firstname;

header('Location: ../../index.php');
