<?php
require("connectdb.php");
require("session.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <title>ParkNRide</title>
    <link rel="stylesheet" href="css/parking.css">
</head>
<body>

<!-- Блок с названием проекта и описанием -->
<header class="bg-primary text-white text-center">
    <div class="container">
        <h1 class="display-4">ParkNRide</h1>
        <p class="lead">Удобные пересадки с машины на метро!</p>
        
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav mx-auto">
            <li class="nav-item">
                <a class="nav-link text-white" href="index.php" style="font-size: 20px; ">Главная</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="allparks.php" style="font-size: 20px; ">Все парковки</a>
            </li>
            <li class="nav-item">
                <?php
                if ($session_user == true) {
                    $page = "Мой кабинет";
                    $link = "account.php";
                } else {
                    $page = "Авторизация";
                    $link = "auth.php";
                }
                ?>
                <a class="nav-link text-white" href="<?= $link ?>" style="font-size: 20px; "><?= $page ?></a>
            </li>
            <?php
            if (isset($_SESSION["role"]) && $_SESSION["role"] === "admin") {
                echo '<li class="nav-item">';
                echo '<a class="nav-link text-white" href="alloffers.php" style="font-size: 20px; ">Предложенные парковки</a>';
                echo '</li>';
            }
            ?>
            </ul>
        </div>
    </nav>
</div>
</header>

<?php

$parkingId = isset($_GET['id']) ? $_GET['id'] : null;
$query = "SELECT * FROM offer_parks WHERE id = \"".$parkingId."\"";
$result = mysqli_query($connect, $query);
if ($user = mysqli_fetch_assoc($result)) {
    echo '<div class="container mx-5 mt-1">';
    echo '<div class="row">';

    echo '<div class="col-lg-5">';
    echo '<div class="card h-100 border-0">';
    echo '<div class="card-body">';

    echo '<h4 class="card-title text-center">Парковка на карте</h4>';
    echo '<div id="map" class="map"></div>';

    echo '</div></div></div>';
    
    echo '<div class="col-lg-5 pt-4">';
    echo '<div class="card h-100 border-0">';
    echo '<div class="card-body">';

    // Номер парковки
    echo '<div class="">';
    echo '<p>Номер заявки: ' . $user['id'] . '</p>';
    echo '</div>';

    // Станция метро 
    echo '<div class="">';
    echo '<p>Станция метро: ' . $user['MetroStation'] . '</p>';
    echo '</div>';

    // Линия метро 
    echo '<div class="">';
    echo '<p>Линия метро: ' . str_replace('линия', '', $user['MetroLine']) . '</p>';
    echo '</div>';

    // Район 
    echo '<div class="">';
    echo '<p>Район: ' . str_replace('район', '', $user['District']) . '</p>';
    echo '</div>';

    // Время работы
    echo '<div class="">';
    echo '<p>Время работы: ' . $user['Schedule'] . '</p>';
    echo '</div>';

    // Вместимость
    echo '<div class="">';
    echo '<p>Вместимость: ' . $user['CarCapacity'] . '</p>';
    echo '</div>';
    
    // Стомость 
    echo '<div class="">';
    echo '<p>Стомость: ' . $user['Price'] . '</p>';
    echo '</div>';

    // Координаты
    echo '<div class="">';
    echo '<p>Координаты: ' . $user['Latitude'] . ', ' . $user['Longitude'] . '</p>';
    echo '</div>';

    echo '</div></div></div>';

    echo '<div class="col-lg-2 mt-5">';
    echo '<div class="card h-100 border-0">';
    echo '<div class="card-body">';

    
    echo '<form action="add_to_parks.php" method="post">' .
         '<input type="hidden" name="parkingId" value="' . $parkingId . '">' .
         '<td class="text-center">' .
         '<button type="submit" class="btn btn-success mt-4 w-100" id="favoritesButton">Добавить парковку</button>' .
         '</td>' .
         '</form>';
    
    echo '<form action="delete_from_offers.php" method="post">' .
         '<input type="hidden" name="parkingId" value="' . $parkingId . '">' .
         '<td class="text-center">' .
         '<button type="submit" class="btn btn-danger mt-2 w-100" id="favoritesButton">Удалить заявку</button>' .
         '</td>' .
         '</form>';
            
    echo '<button class="btn btn-secondary d-block w-100 mb-5 mt-2" onclick="goBack()">Назад</button>';

    echo '</div></div></div>';

    echo '</div></div>';
}

?>

<script src="https://api-maps.yandex.ru/2.1/?apikey=3d8e5ed6-c333-4ed0-a350-0c1b6e3957c5&lang=ru_RU"></script>
<script>

var long = parseFloat('<?= $user['Longitude'] ?>');
var lat = parseFloat('<?= $user['Latitude'] ?>');

let center = [lat, long];

function init() {
	let map = new ymaps.Map('map', {
		center: center,
		zoom: 15
	});

	let placemark = new ymaps.Placemark(center, {}, {
		iconLayout: 'default#image',
        iconImageHref: 'images/marker1_blue.svg',
        iconImageSize: [30, 30],
        iconImageOffset: [-17, -25]
	});

    map.controls.remove('geolocationControl');
    map.controls.remove('searchControl');
    map.controls.remove('trafficControl');
    map.controls.remove('typeSelector');
    map.controls.remove('fullscreenControl');
    map.controls.remove('zoomControl');
    map.controls.remove('rulerControl');
    map.behaviors.disable(['scrollZoom']);

	map.geoObjects.add(placemark);
}

ymaps.ready(init);
</script>

<!-- Подвал -->
<footer class="py-3 bg-dark">
    <div class="container text-center text-white">
        <p class="mb-0">a.v.shapovalov22@list.ru</p>
        <p class="mb-0">&copy; 2024 ParkNRide</p>
    </div>
</footer>

<!-- Скрипты Bootstrap (необходимы для работы компонентов) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script>

function goBack() {
    window.location.href = 'alloffers.php';
}
</script>    
</body>
</html>