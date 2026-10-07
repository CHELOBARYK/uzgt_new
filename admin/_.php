<?php
require_once 'config.php';

$login = 'admin';
$password = 'admin123';

$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (login, password) VALUES (?, ?)");
$stmt->bind_param("ss", $login, $hash);

if ($stmt->execute()) {
    echo "Пользователь admin создан с паролем admin123<br>";
    echo "Хеш: " . $hash;
} else {
    echo "Ошибка: " . $conn->error;
}