<?php
session_start();
require_once 'config.php';

// Получаем и очищаем данные
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

$name = trim($_POST['name'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');
$title = trim($_POST['title'] ?? '');
$product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;

// echo $name,"\n",$phone;

// Валидация обязательных полей
if (empty($name) || empty($phone)) {
    if (empty($title)) {
        $title="";
    }
    if(empty($message)){
        $message="";
    }
    $_SESSION['feedback_error'] = 'Заполните имя, телефон и сообщение';
    header('Location: index.php');
    exit;
}

// Дополнительная валидация телефона на сервере (на всякий случай)
$phone_pattern = '/(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/';
if (!preg_match($phone_pattern, $phone)) {
    $_SESSION['feedback_error'] = 'Введите корректный номер телефона';
    header('Location: index.php');
    exit;
}

function clearPhone($phone) {
    $phone = preg_replace('/[^0-9]/', '', $phone);   
    if (preg_match('/^8/', $phone)) {
        $phone = '+7' . substr($phone, 1);
    }elseif (preg_match('/^7/', $phone)) {
        $phone = '+' . $phone;
    }
    
    return $phone;
}

$clear_phone = clearPhone($phone);

$stmt = $conn->prepare("INSERT INTO feedback (name, phone, email, message, product_id, title) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssis", $name, $clear_phone, $email, $message, $product_id, $title);

if ($stmt->execute()) {
    $_SESSION['feedback_success'] = 'Спасибо! Ваша заявка отправлена. Мы свяжемся с вами.';
} else {
    $_SESSION['feedback_error'] = 'Ошибка отправки. Попробуйте позже.';
}

$stmt->close();
$conn->close();

header('Location: index.php');
exit;
}
?>