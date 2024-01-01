<?php
$db_hostname = "localhost";
$db_database = "parts_store";
$db_username = "root";
$db_password = "";

// Підключення до бази даних
$db_connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);

// Перевірка з'єднання
if ($db_connection->connect_error) {
    die("Помилка підключення до бази даних: " . $db_connection->connect_error);
}

// Санітарна очистка даних
$db_hostname = mysqli_real_escape_string($db_connection, $db_hostname);
$db_database = mysqli_real_escape_string($db_connection, $db_database);
$db_username = mysqli_real_escape_string($db_connection, $db_username);
$db_password = mysqli_real_escape_string($db_connection, $db_password);
?>
