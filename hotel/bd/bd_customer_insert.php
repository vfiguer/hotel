<?php
require "bd_connection.php";

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $dni = $_POST["dni"];

    $sql = "INSERT INTO customers (name, password, email, phone, dni) VALUES ('$name', '$password', '$email', '$phone', '$dni')";

    if ($conn->query($sql) === TRUE) {
        echo "Cliente agregado exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Cliente</title>
</head>
<body>
    <h2>Agregar Cliente</h2>
    <form action="insert_customer.php" method="post">
        <label for="name">Nombre:</label>
        <input type="text" name="name" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" required><br><br>

        <label for="email">Correo Electrónico:</label>
        <input type="email" name="email" required><br><br>

        <label for="phone">Teléfono:</label>
        <input type="text" name="phone" required><br><br>

        <label for="dni">DNI:</label>
        <input type="text" name="dni" required><br><br>

        <input type="submit" value="Agregar Cliente">
    </form>
</body>
</html>
