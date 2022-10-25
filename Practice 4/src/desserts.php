<html lang="en">
<head>
<title>Desserts</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
<h1>Desserts</h1>
<table>
    <tr><th></th><th>Price</th><th>Calories</th></tr>

<?php
try
{
    $sql_connection = mysqli_connect("db", "root", "12345678", "appDB");
    $result = $sql_connection->query("SELECT * FROM desserts");

    foreach ($result as $row)
    {
        echo "<tr><td>{$row['title']}</td><td>{$row['price']}rub </td><td>{$row['calories']}</td></tr>";
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
