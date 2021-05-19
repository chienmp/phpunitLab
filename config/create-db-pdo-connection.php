<?php
$host = getenv('DB_HOST');
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$pdo = new PDO("mysql:host=$host; dbname=$dbName; user=$dbUser; password=$dbPassword");
return $pdo;