<?php

use Core\Database;

$heading = 'Mes Utilisateurs';

$database = new Database(ENV_FILE);
$users = $database->query('SELECT * FROM Users')->all();
view('users/index.view.php', compact('heading', 'users')) ;
