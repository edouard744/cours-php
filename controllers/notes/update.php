<?php


use Core\Database;
use Core\Response;
use Core\Validator;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentUserId = $_POST['currentUserId'];
    $database = new Database(ENV_FILE);
    $id = (int)$_POST['id'];
    $errors = [];

    $note = $database->query('SELECT * FROM Notes where id = :id', ['id' => $id])->findOrFail();
    $note_userId=$note['user_id'];


    if (!Validator::correctRequest($_POST, 'update')){
        Response::abort(Response::BAD_REQUEST);
    }

    if(!Validator::between($_POST['description'], 1, 1000)){
        $errors['description'] = 'Attention, la description doit faire entre 1 et 1000 caractères';
    }

    if (Validator::correctUser($currentUserId, $note_userId)) {
        $errors['correctUser'] = 'Vous ne pouvez pas modifier des notes qui ne vous appartienne pas';
        Response::abort(Response::BAD_REQUEST);
    }

    if (empty($errors)) {
        $description = $_POST['description'];
        $database = new Database(ENV_FILE);
        $database->query('UPDATE notes SET description=:description WHERE id=:id', ['description' => $description,'id'=>$id]);
        Response::redirect('Location: http://php.test/notes');
    } else {
        $heading = 'create note';
        view('notes/create.view.php', compact('heading','errors', 'currentUserId'));
    }

} else {
    Response::abort(Response::NOT_ALLOWED);
}