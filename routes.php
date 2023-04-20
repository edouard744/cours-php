<?php

$router->get('/', 'pages/dashboard.php');
$router->get('/about', 'pages/about.php');
$router->get('/contact', 'pages/contact.php');

//NOTE
$router->get('/notes', 'notes/index.php');
$router->get('/note', 'notes/show.php');
$router->get('/notes/create', 'notes/create.php');
$router->get('/note/update','notes/edit.php');
$router->put('/note','notes/update.php');
$router->post('/notes', 'notes/store.php');
$router->delete('/note', 'notes/destroy.php');

//USER
$router->get('/users', 'users/index.php');
$router->get('/user', 'users/show.php');
$router->get('/users/create', 'users/create.php');
$router->get('/user/update','users/edit.php');
$router->put('/user','users/update.php');
$router->post('/users', 'users/store.php');
$router->delete('/user', 'users/destroy.php');