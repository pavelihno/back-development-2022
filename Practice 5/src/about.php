<?php
session_start();
require('locale_preferences.php');
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
    <?php require 'theme_preferences.php' ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title><?php echo $langArray['about']?></title>
</head>
<body class="body">
    <h1 class="display-4"><?php echo $langArray['about']?></h1>
    <div style="display: flex; flex-direction: column;">
        <p class="text-muted large-font"><?php echo $langArray['description']?></p>
        <span class="text-muted large-font"><?php echo $langArray['address']?>: Москва, улица Тверская, дом 1</span>
        <span class="text-muted large-font"><?php echo $langArray['phone']?>: <a href="tel:89038751221">+7(903)875-12-21</a></span>
        <span><a class="text-muted large-font" href="./index.php"><?php echo $langArray['homepage']?></a></span>
    </div>
</body>
</html>
