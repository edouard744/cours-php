<?php
use Core\Database;
use Core\Response;

$heading = 'Edit User';
$id = (int)$_GET['id'];
$database = new Database(ENV_FILE);
$user = $database->query('SELECT * FROM Users where id = :id', ['id' => $id])->findOrFail();


view('users/update.view.php', compact('user','heading'));