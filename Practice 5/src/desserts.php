<?php
session_start();
require('preferences/locale.php');
?>

<html lang="en">
<head>
    <title><?php echo $langArray['desserts']?></title>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
    <?php require('preferences/theme.php'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body class="body">
<h1 class="display-4"><?php echo $langArray['desserts']?></h1>
<table class="table table-striped">
    <tr><th></th><th><?php echo $langArray['price']?></th><th><?php echo $langArray['calories']?></th></tr>

<?php
try
{
    $sql_connection = mysqli_connect("db", "root", "12345678", "appDB");
    $result = $sql_connection->query("SELECT * FROM desserts");

    foreach ($result as $row)
    {
        $row_str = "<tr><td>{$row['title']}</td><td>{$row['price']}" . $langArray['rub'] .  "</td><td>{$row['calories']}</td></tr>";
        echo $row_str;
    }
}
catch(mysqli_sql_exception $e)
{
    print ("Ошибка подключения к БД");
}
?>

</table>

</body>
</html>
