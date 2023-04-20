<?php

use Core\Database;
use Core\Response;
use Core\Validator;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentUserId = $_POST['currentUserId'];
    $database = new Database(ENV_FILE);
    $id = $_POST['id'];
    $note = $database->query('SELECT * FROM Notes where id = :id', ['id' => $id])->findOrFail();
    $note_userId=$note['userId'];
    $errors = [];

    if (!Validator::correctRequest($_POST, 'delete')) {
        Response::abort(Response::BAD_REQUEST);
    }
    if (Validator::correctUser($currentUserId, $note_userId)) {
        $errors['correctUser'] = 'Vous ne pouvez pas subprime des notes qui ne vous appartienne pas';
        Response::abort(Response::BAD_REQUEST);
    }

    if (empty($errors)) {

        $database->query('DELETE from notes WHERE id=:id', ['id' => $id]);
        Response::redirect('Location: http://php.test/notes');
    } else {
        $heading = 'DELETE note';
        view('notes/create.view.php', compact('heading', 'errors', 'currentUserId'));
    }
} else {
    Response::abort(Response::NOT_ALLOWED);
}
