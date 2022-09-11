<html lang="en">
<head>
<title>Hello world page</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
<h1>Таблица пользователей данного продукта</h1>
<table>
    <tr><th>Id</th><th>Name</th><th>Surname</th></tr>

<?php

try {
    $sql_connection = mysqli_connect("db", "root", "12345678", "appDB");
    $result = $sql_connection->query("SELECT * FROM users");
    foreach ($result as $row){
        echo "<tr><td>{$row['ID']}</td><td>{$row['name']}</td><td>{$row['surname']}</td></tr>";
    }
}
catch (mysqli_sql_exception $e) {
    print("Ошибка подключения к БД");
}

?>

</table>
<?php
phpinfo();
?>
</body>
</html>