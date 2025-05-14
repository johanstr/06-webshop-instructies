<?php

include_once('../Database/Database.php');

if($_SERVER['HTTP_REFERER'] != 'https://wittekip-lessen.local/register.php' ||
   $_SERVER['REQUEST_METHOD'] != 'POST') {
   echo 'Onjuiste request';
   die();
}

$validation_result = true;
$error_message = '';

// Validatie
if(!isset($_POST['firstname']) || empty($_POST['firstname'])) {
   $validation_result = false;
   $error_message = 'Voornaam_';
}

if (!isset($_POST['lastname']) || empty($_POST['lastname'])) {
   $validation_result = false;
   $error_message .= 'Achternaam_';
}

if (!isset($_POST['street']) || empty($_POST['street'])) {
   $validation_result = false;
   $error_message .= 'Straatnaam_';
}

if (!isset($_POST['housenumber']) || empty($_POST['housenumber'])) {
   $validation_result = false;
   $error_message .= 'Huisnummer_';
}

if (!isset($_POST['zipcode']) || empty($_POST['zipcode'])) {
   $validation_result = false;
   $error_message .= 'Postcode_';
}

if (!isset($_POST['city']) || empty($_POST['city'])) {
   $validation_result = false;
   $error_message .= 'Plaats_';
}

if (!isset($_POST['email']) || empty($_POST['email'])) {
   $validation_result = false;
   $error_message .= 'Email_';
}

if (!isset($_POST['password']) || empty($_POST['password'])) {
   $validation_result = false;
   $error_message .= 'Wachtwoord_';
}

if (!isset($_POST['password_confirm']) || empty($_POST['password_confirm'])) {
   $validation_result = false;
   $error_message .= 'WWConfirm_';
}

if($_POST['password'] != $_POST['password_confirm']) {
   $validation_result = false;
   $error_message .= 'WWOngelijk_';
}

if(! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
   $validation_result = false;
   $error_message .= 'Emailformat';
}

if(!$validation_result) {
   header('Location: ../../register.php?msg=' . $error_message);
   exit();
}

// Op het punt dat validatie gelukt
// Nu input values beveiligen tegen HTML en JavaScript
$firstname = htmlentities($_POST['firstname']);
$lastname = htmlentities($_POST['lastname']);
$prefixes = htmlentities($_POST['prefixes']);
$street = htmlentities($_POST['street']);
$housenumber = htmlentities($_POST['housenumber']);
$addition = htmlentities($_POST['addition']);
$zipcode = htmlentities($_POST['zipcode']);
$city = htmlentities($_POST['city']);
$email = htmlentities($_POST['email']);
$password = htmlentities($_POST['password']);

// Alles is nu klaar om de customer aan de database toe te voegen
Database::insert('customers', [
   'firstname' => $firstname,
   'prefixes' => $prefixes,
   'lastname' => $lastname,
   'street' => $street,
   'house_number' => $housenumber,
   'addition' => $addition,
   'zipcode' => $zipcode,
   'city' => $city,
   'email' => $email,
   'password' => password_hash($password, PASSWORD_DEFAULT)
]);

// Na het opslaan in de database laten we de gebruiker terugkeren naar
// het login scherm, zodat hij/zij gelijk kan inloggen
header('Location: ../../login.php');
exit();                                      // Niet echt nodig, maar ach....