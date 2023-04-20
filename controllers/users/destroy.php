<?php

use Core\Database;
use Core\Response;
use Core\Validator;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $database = new Database(ENV_FILE);
    $id = $_POST['id'];

    $errors = [];

    if (!Validator::correctRequest($_POST, 'delete')) {
        Response::abort(Response::BAD_REQUEST);
    }


    if (empty($errors)) {

        $database->query('DELETE from users WHERE id=:id', ['id' => $id]);
        Response::redirect('Location: http://php.test/users');
    } else {
        $heading = 'DELETE user';
        view('users/create.view.php', compact('heading', 'errors'));
    }
} else {
    Response::abort(Response::NOT_ALLOWED);
}
