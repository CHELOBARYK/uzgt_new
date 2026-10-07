<?php
session_start();



if (isset($_SESSION['admin'])) {
    header('Location: admin_dashboard.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once(__DIR__ . '/../config.php');
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $stmt = $conn->prepare("SELECT * FROM users WHERE login = ?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['admin'] = $user['id'];
        header('Location: admin_dashboard.php');
        exit;
    } else {
        $error = 'Неверный логин или пароль';
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход в панель управления</title>
    <link rel="stylesheet" href="/main.css">
    <style>
        .admin-login { max-width: 400px; margin: 100px auto; padding: 30px; background: white; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); }
        .admin-login h2 { text-align: center; margin-bottom: 20px; }
        .admin-login input { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 5px; }
        .admin-login button { width: 100%; padding: 10px; background: #1a2c3e; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .error { color: red; text-align: center; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="admin-login">
        <h2>Вход в панель управления</h2>
        <?php if ($error): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="login" placeholder="Логин" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <button type="submit">Войти</button>
        </form>
        <a href="/../index.php" style='color:white;'><button class="back-btn">На главную</button></a>
    </div>
</body>
</html>