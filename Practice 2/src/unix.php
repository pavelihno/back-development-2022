<?php session_start(); ?>
<html lang="en">
<head>
<title>UNIX</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>

<div style="float: right;">
    <form method="post">
        <button type="submit" name="clear_button">Очистить</button>
    </form>
</div>
<h1>Командная строка</h1>
<div class="form-block">
    <form method="post">
        <input type="text" name="command" required>
        <button type="submit" name="command_button">Отправить</button>
    </form>
</div>
<div class="commands-block">
    
<?php

    $lines_var_name = 'lines_var_name';
    
    if (!array_key_exists($lines_var_name, $_SESSION) || (array_key_exists('clear_button', $_POST))) {
        $_SESSION[$lines_var_name] = array();
    }

    if (array_key_exists('command_button', $_POST)) {
        $command = $_POST['command'];
        array_push($_SESSION[$lines_var_name], 'username> ' . $command);
        exec($command, $_SESSION[$lines_var_name]);
    }
    
    foreach($_SESSION[$lines_var_name] as $line) {
        echo "<span>{$line}</span>";
    } 

?>

</div>

</body>
</html>