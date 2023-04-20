<?php

use Core\Database;
use Core\Response;

$heading = 'User';
$id = (int)$_GET['id'];
$database = new Database(ENV_FILE);
$user = $database->query('SELECT * FROM Users where id = :id', ['id' => $id])->findOrFail();

view('users/show.view.php', compact('heading', 'user'));
