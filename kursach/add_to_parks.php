<?php
require("session.php");
require("connectdb.php");

// Проверка наличия переданных данных
$parkingId = isset($_POST['parkingId']) ? $_POST['parkingId'] : null;
$offerId = $_POST["parkingId"];

// SQL-запрос для добавления записи в таблицу offer_parks
$result1 = mysqli_query($connect, "SELECT * FROM offer_parks WHERE id = \"".$offerId."\"");

$user = mysqli_fetch_assoc($result1);

// SQL-запрос для добавления записи в таблицу users_parkings
mysqli_query($connect, "INSERT INTO parkings (MetroStation, MetroLine, AdmArea, District, Schedule, CarCapacity, Longitude, Latitude, Price) VALUES (
    \"".$user['MetroStation']."\", 
    \"".$user['MetroLine']."\",
    '',
    \"".$user['District']."\",
    \"".$user['Schedule']."\",
    \"".$user['CarCapacity']."\", 
    \"".$user['Longitude']."\",
    \"".$user['Latitude']."\",
    \"".$user['Price']."\"
    )"
);

mysqli_query($connect, "DELETE FROM offer_parks WHERE id = \"".$offerId."\" ");

header('Location: alloffers.php');
?>
