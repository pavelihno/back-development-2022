<?php
session_start();
?>

<html lang="en">
<head>
<title>Drinks</title>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<h1 class="display-4">Drinks</h1>
<table class="table table-striped">
    <tr><th></th><th>Price</th></tr>

<?php
try
{
    $sql_connection = mysqli_connect("db", "root", "12345678", "appDB");
    $result = $sql_connection->query("SELECT * FROM drinks");

    foreach ($result as $row)
    {
        echo "<tr><td>{$row['title']}</td><td>{$row['price']}rub </td></tr>";
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
