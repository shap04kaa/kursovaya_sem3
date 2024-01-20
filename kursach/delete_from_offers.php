<?php
require("session.php");
require("connectdb.php");

// Проверка наличия переданных данных
$parkingId = isset($_POST['parkingId']) ? $_POST['parkingId'] : null;
$offerId = $_POST["parkingId"];

// SQL-запрос для добавления записи в таблицу users_parkings
mysqli_query($connect, "DELETE FROM offer_parks WHERE id = \"".$offerId."\" ");

header('Location: alloffers.php');
?>
