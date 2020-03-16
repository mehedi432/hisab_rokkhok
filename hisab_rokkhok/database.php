<?php

try {
    $pdo = new PDO("mysql:host=localhost; dbname=pos", 'root', '');
    // echo "Success";
} catch (PDOException $exception) {
    echo $exception->getMessage();
}
