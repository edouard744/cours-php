<?php

use Core\Database;
use Core\Response;
use Core\Validator;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$errors = [];


    if(!Validator::between($_POST['firstName'], 1, 50)){
		$errors['firstName'] = 'Attention, le prénom doit faire entre 1 et 50 caractères';
	}
    if(!Validator::between($_POST['lastName'], 1, 50)){
        $errors['lastName'] = 'Attention, le Nom doit faire entre 1 et 50 caractères';
    }
    if(!Validator::between($_POST['email'], 1, 50)){
        $errors['email'] = 'Attention, le Email doit faire entre 1 et 50 caractères';
    }

    if (!Validator::correctPassword($_POST['password'])){
        $errors['password'] = 'Doit contenir au moins une lettre capital et une chiffre';
    }


	if (empty($errors)) {
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$email = $_POST['email'];
        $password= password_hash($_POST['password'],PASSWORD_BCRYPT);
		$database = new Database(ENV_FILE);
        $database->query(
            'INSERT INTO Users(firstName,lastName,email,password) values(:firstName, :lastName,:email,:password)',
            [
                ':firstName' => $firstName,
                ':lastName' => $lastName,
                ':email' => $email,
                ':password' => $password
            ]
        );
		Response::redirect('Location: http://php.test/users');
	} else {
		$heading = 'create user';
		view('users/create.view.php', compact('heading','errors'));
	}

} else {
	Response::abort(Response::NOT_ALLOWED);
}
