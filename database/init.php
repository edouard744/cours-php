<?php
require_once '../core/Database.php';
$file =  __DIR__ . '/../env.local.ini';

use Core\Database;
$database = new Database($file);

try {
    $connection =  $database->init();
    deleteTables($connection);
    createTables($connection);
    seedTables($connection);
} catch (Exception $e) {
    echo ($e->getMessage());
};

function deleteTables(PDO $connection): void
{
    $sql = <<<sql
    DROP TABLE IF EXISTS `notes`;
sql;
    $connection->exec($sql);
    $sql = <<<sql
    DROP TABLE IF EXISTS `users`;
sql;
    $connection->exec($sql);
}
function createTables(PDO $connection): void
{
    $sql = <<<sql
    CREATE TABLE `users` (
      `id` int unsigned NOT NULL AUTO_INCREMENT,
      `firstName` varchar(255) NOT NULL,
      `lastName` varchar(255) NOT NULL,
      `email` varchar(255)  CHARACTER SET  utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
      `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
      PRIMARY KEY (`id`),
      UNIQUE KEY `email` (`email`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
sql;
    $connection->exec($sql);
    $sql = <<<sql
    CREATE TABLE `notes` (
      `id` int unsigned NOT NULL AUTO_INCREMENT,
      `user_id` int unsigned NOT NULL,
      `description` text NOT NULL,
      PRIMARY KEY (`id`),
      KEY `user_id` (`user_id`),
      CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

sql;
    $connection->exec($sql);
}
function seedTables(PDO $connection): void
{
    $password= password_hash('test', PASSWORD_BCRYPT);
    $sql = <<<sql
    INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`)
VALUES 
        (1, 'Dominique', 'Vilain', 'dominique.vilain@hepl.be', :password),
        (2, 'Edouard', 'Willems', 'edouard.willems@hepl.be', :password),
        (3, 'Unautre', 'Mecsympa', 'unautre.mecsympa@hepl.be', :password);
;
        
    INSERT INTO `notes` (`id`, `user_id`, `description`)
    VALUES
        (1, 1, 'Ma première note'),
        (2, 1, 'Ma deuxième note');
sql;
    $seed = $connection->prepare($sql);
    $seed->bindParam(':password', $password);
    $seed->execute();
}
