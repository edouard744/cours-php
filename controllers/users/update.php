<?php


use Core\Database;
use Core\Response;
use Core\Validator;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new Database(ENV_FILE);
    $id = $_POST['id'];
    $errors = [];

    $user = $database->query('SELECT * FROM Users where id = :id', ['id' => $id])->findOrFail();
    $user_oldPassword=$user['password'];


    if (!Validator::correctRequest($_POST, 'update')){
        Response::abort(Response::BAD_REQUEST);
    }
    if (!Validator::correctPassword($_POST['newPassword'])){
        $errors['newPassword'] = 'Doit contenir au moins une lettre capital et une chiffre';
    }
    if(!Validator::lastPasswordCheck($user_oldPassword,$_POST['oldPassword'])){
        $errors['oldPassword']= 'Votre votre anciens mots de passe est incorrect';
    }

    if (empty($errors)) {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];

        $password= password_hash($_POST['newPassword'],PASSWORD_BCRYPT);
        $database = new Database(ENV_FILE);
        $database->query('UPDATE users SET firstName=:firstName, lastName=:lastName, email=:email, password=:password WHERE id=:id', [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'password' => $password,
            'id' => $id
        ]);
        Response::redirect('Location: http://php.test/users');
    } else {
        $heading = 'Update Users';
        view('users/create.view.php', compact('heading','errors'));
    }

} else {
    Response::abort(Response::NOT_ALLOWED);
}