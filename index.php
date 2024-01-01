<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Інформація про клієнтів</title>
</head>
<body>
    <center>
        <h1>Інформація про клієнтів</h1>
    </center>

    <?php
    // Підключення до бази даних
    require_once 'shopLog.php';

    $db_connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);

    // Перевірка з'єднання
    if ($db_connection->connect_error) {
        die("Помилка підключення до бази даних: " . $db_connection->connect_error);
    }

    $db_connection->set_charset("utf8");

    // Вибірка даних з таблиці customers
    $query = "SELECT * FROM customers";
    $result = $db_connection->query($query);

    if (!$result) {
        die("Збій при доступі до бази даних: " . $db_connection->error);
    }

    // Виведення результатів у вигляді HTML-таблиці
    echo "<center>";
    echo "<table border=\"1\" >\n";
    echo "<tr>\n<th>Customer ID</th><th>Email</th><th>Telephone</th><th>Full Name</th><th>Payment Method</th>\n</tr>\n";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>\n";
        echo "<td>" . htmlspecialchars($row["customer_id"]) . "</td>\n";
        echo "<td>" . htmlspecialchars($row["email"]) . "</td>\n";
        echo "<td>" . htmlspecialchars($row["telephone"]) . "</td>\n";
        echo "<td>" . htmlspecialchars($row["full_name"]) . "</td>\n";
        echo "<td>" . htmlspecialchars($row["payment_method"]) . "</td>\n";
        echo "</tr>\n";
    }

    echo "</table>";
    echo "</center>";

    // Закриття з'єднання
    $db_connection->close();
    ?>
</body>
</html>
