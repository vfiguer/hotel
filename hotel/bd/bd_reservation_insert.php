<?php
require "bd_connection.php";

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST["customer_id"];
    $date_in = $_POST["date_in"];
    $date_out = $_POST["date_out"];
    $room_id = $_POST["room_id"];
    $room_price = $_POST["room_price"];
    $status = $_POST["status"];
    $services = $_POST["services"];

    $sql = "INSERT INTO reservations (customer_id, date_in, date_out, room_id, room_price, status, services) VALUES ('$customer_id', '$date_in', '$date_out', '$room_id', '$room_price', '$status', '$services')";

    if ($conn->query($sql) === TRUE) {
        echo "Reserva agregada exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Reserva</title>
</head>
<body>
    <h2>Agregar Reserva</h2>
    <form action="insert_reservation.php" method="post">
        <label for="customer_id">ID del Cliente:</label>
        <input type="text" name="customer_id" required><br><br>

        <label for="date_in">Fecha de Entrada:</label>
        <input type="date" name="date_in" required><br><br>

        <label for="date_out">Fecha de Salida:</label>
        <input type="date" name="date_out" required><br><br>

        <label for="room_id">ID de la Habitación:</label>
        <input type="text" name="room_id" required><br><br>

        <label for="room_price">Precio de la Habitación:</label>
        <input type="text" name="room_price" required><br><br>

        <label for="status">Estado de la Reserva:</label>
        <input type="text" name="status" required><br><br>

        <label for="services">Servicios Adicionales:</label>
        <input type="text" name="services" required><br><br>

        <input type="submit" value="Agregar Reserva">
    </form>
</body>
</html>
