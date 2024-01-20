<?php
    require("connectdb.php");
    require("session.php");

    $MetroStation = $_POST['MetroStation'];

    $MetroLine = $_POST['MetroLine'];

    $District = $_POST['District'];

    $Schedule = $_POST['Schedule'];

    $CarCapacity = $_POST['CarCapacity'];

    $Price = $_POST['Price'];

    $coords = $_POST['coords'];
    $coordinatesArray = explode(",", $coords);

    $Longitude = $coordinatesArray[1];
    $Latitude = $coordinatesArray[0];

    $result1 = mysqli_query($connect, "SELECT * FROM users WHERE login =  \"".$login."\";");
    $user1 = mysqli_fetch_assoc($result1);

    $result2 = mysqli_query($connect, "SELECT * FROM users WHERE email = \"".$email."\";");
    $email1 = mysqli_fetch_assoc($result2);

    mysqli_query($connect, "INSERT INTO offer_parks (MetroStation, MetroLine, District, Schedule, CarCapacity, Longitude, Latitude, Price) VALUES (
        \"".$MetroStation."\", 
        \"".$MetroLine."\",
        \"".$District."\",
        \"".$Schedule."\",
        \"".$CarCapacity."\", 
        \"".$Longitude."\",
        \"".$Latitude."\",
        \"".$Price."\"
        )"
    );
    
    header('Location: addpark_post.php');   
?>