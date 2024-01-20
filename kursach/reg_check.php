<?php
require("connectdb.php");
require("session.php");

$login = $_POST['username'];
$email = $_POST['email'];
$pass = $_POST['password'];
$role = 'user';

$errors = array();

if (strlen($login) < 3) {
    $errors = "Слишком маленький логин";
} elseif (strlen($login) > 50) {
    $errors = "Слишком большой логин";
} elseif (strlen($pass) < 8) {
    $errors = "Слишком маленький пароль";
} elseif (strlen($pass) > 50) {
    $errors = "Слишком большой пароль";
}

$result1 = mysqli_query($connect, "SELECT * FROM users WHERE login =  \"".$login."\";");
$user1 = mysqli_fetch_assoc($result1);

$result2 = mysqli_query($connect, "SELECT * FROM users WHERE email = \"".$email."\";");
$email1 = mysqli_fetch_assoc($result2);

if ($user1) {
    $errors = "Такой логин уже существует";
}

if ($email1) {
    $errors = "Такая почта уже привязана";
}

// Если есть ошибки, выводим их и завершаем скрипт
if (!empty($errors)) {
    $_SESSION['error'] = $errors;
    header('Location: reg_error.php');
    exit();
}

// Если ошибок нет, продолжаем выполнение кода
$pass = md5($pass."qwpfgow234");

mysqli_query($connect, "INSERT INTO users (login, password, email, role) VALUES (
    \"".$login."\", 
    \"".$pass."\",
    \"".$email."\",
    \"".$role."\"
    )"
);

$session_user = true;

header('Location: auth.php');
?>
