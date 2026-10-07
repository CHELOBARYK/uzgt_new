<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin.php?token=...');
    exit;
}
require_once '../config.php';

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    die("Неверный ID заявки");
}

$result = $conn->query("SELECT * FROM feedback WHERE id = $id");
$client = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Данные из формы
    $clientEmail = 'ponandralena@gmail.com';
    $subject = $_POST['subject'] ?? 'Ответ от администратора';
    $message = $_POST['message'] ?? '';
    $adminEmail = 'ponandralena@gmail.com'; // Ваш email
    $adminName = 'Поддержка сайта';
    
    // Валидация
    $errors = [];
    
    if (!filter_var($clientEmail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Неверный email клиента или email не указан';
    }
    
    if (empty(trim($message))) {
        $errors[] = 'Сообщение не может быть пустым';
    }
    
    if (empty($errors)) {
        
        // Заголовки
        $headers = "From: $adminName <$adminEmail>\r\n";
        $headers .= "Reply-To: $adminEmail\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        
        // HTML шаблон письма
        $emailTemplate = "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <style>
                body { font-family: Arial, sans-serif; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: #49769e; color: white; padding: 20px; text-align: center; }
                .content { background: #f9f9f9; padding: 30px; }
                .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>Ответ от администратора</h1>
                </div>
                <div class='content'>
                    " . nl2br(htmlspecialchars($message)) . "
                </div>
                <div class='footer'>
                    <p>С уважением,<br>Служба поддержки</p>
                </div>
            </div>
        </body>
        </html>";
        
        // Отправка
        if (mail($clientEmail, $subject, $emailTemplate, $headers)) {
            $success = "Письмо успешно отправлено клиенту!";
        } else {
            $errors[] = "Ошибка при отправке письма";
        }
    }
}
?>

<title>Заявка #<?= $client['id'] ?> — УЗГТ</title>
<?include('header.php')?>
<main>
    <h1>Отправить ответ клиенту</h1>
    
        <?php if (!empty($errors)): ?>
        <?php foreach ($errors as $error): ?>
            <p style="background:#f8d7da; color:#721c24; padding:13px 15px; 
                      border-radius:5px; text-align:center; max-width:600px;">
                <?= $error // *** ИЗМЕНЕНИЕ: короткий echo вместо короткого тега *** ?>
            </p>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <?php if (isset($success)): // *** ИЗМЕНЕНИЕ: вывод сообщения об успехе *** ?>
        <p style="background:#d4edda; color:#155724; padding:13px 15px; 
                  border-radius:5px; text-align:center; max-width:600px;">
            <?= $success ?>
        </p>
    <?php endif; ?>
    <div class="form-container">
        <form method="POST" action="send_email.php?id=<?= $client['id'] ?>">
            <div class="details">
                <p>Email клиента</p>
                <p><?= htmlspecialchars($client['email']) ?></p>
                <p>|</p>
                <p>Название заявки</p>
                <p><?= htmlspecialchars($client['title']) ?></p>
            </div>
            
            <div class="form-group">
                <label for="subject">Тема письма:</label>
                <input type="text" 
                       id="subject" 
                       name="subject" 
                       placeholder="Ответ на ваш запрос">
            </div>
            
            <div class="form-group">
                <label for="message">Текст сообщения:</label>
                <textarea id="content" 
                          name="message" 
                          required 
                          placeholder="Введите текст ответа клиенту..."
                          style='width:100%;'>
                </textarea>
            </div>
            
            <button type="submit" class='back-btn'>Отправить клиенту</button>
            <button type="reset" class='delete-btn'>Очистить</button>
        </form>
    </div>
</main>
</body>
</html>