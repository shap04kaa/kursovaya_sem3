<?php
require("connectdb.php");
require("session.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ParkNRide</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/auth_reg.css">
</head>
<body>

<div class="container mb-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card custom-card">
        <div class="card-header bg-primary">
          Добавление новой парковки
        </div>
        <div class="card-body">
          <form action="addpark_check.php" method="post">
            <div class="form-group">
              <label for="MetroStation">Укажите ближайшую станцию метро:</label>
              <input type="text" class="form-control" id="MetroStation" name="MetroStation" required>
            </div>
            <div class="form-group">
              <label for="MetroLine">Укажите линию метро:</label>
              <input type="text" class="form-control" id="MetroLine" name="MetroLine" required>
            </div>
            <div class="form-group">
              <label for="District">Укажите район:</label>
              <input type="text" class="form-control" id="District" name="District" required>
            </div>
            <div class="form-group">
              <label for="Schedule">Укажите время работы парковки:</label>
              <input type="text" class="form-control" id="Schedule" name="Schedule" required>
            </div>
            <div class="form-group">
              <label for="CarCapacity">Укажите вместимость парковки:</label>
              <input type="text" class="form-control" id="CarCapacity" name="CarCapacity" required>
            </div>
            <div class="form-group mb-0">
              <label for="District">Укажите стоимость:</label>
              <input type="text" class="form-control" id="Price" name="Price" required>
            </div>
            <small id="passwordHelp" class="form-text text-muted">*если парковка бесплатная, напишите 'free'</small>
            <div class="form-group mt-3">
              <label for="coords">Укажите координаты:</label>
              <input type="text" class="form-control" id="coords" name="coords" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Отправить запрос</button>
          </form>
          <button class="btn btn-secondary d-block w-100 mt-2" onclick="window.location.href='account.php'">Назад</button>
        </div>
      </div>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

