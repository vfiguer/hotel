<?php
require "bd_connection.php";

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reservation_id = $_POST["reservation_id"];
    $customer_id = $_POST["customer_id"];
    $date_in = $_POST["date_in"];
    $date_out = $_POST["date_out"];
    $room_id = $_POST["room_id"];
    $room_price = $_POST["room_price"];
    $status = $_POST["status"];
    $services = $_POST["services"];

    $sql = "UPDATE reservations SET customer_id='$customer_id', date_in='$date_in', date_out='$date_out', room_id='$room_id', room_price='$room_price', status='$status', services='$services' WHERE id='$reservation_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Datos de la reserva actualizados exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['id'])) {
    $reservation_id = $_GET['id'];

    $sql = "SELECT * FROM reservations WHERE id = $reservation_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $customer_id = $row["customer_id"];
        $date_in = $row["date_in"];
        $date_out = $row["date_out"];
        $room_id = $row["room_id"];
        $room_price = $row["room_price"];
        $status = $row["status"];
        $services = $row["services"];
    } else {
        echo "Reserva no encontrada.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Actualizar Reserva</title>
</head>
<body>
    <h2>Actualizar Reserva</h2>
    <form action="update_reservation.php" method="post">
        <label for="reservation_id">Seleccione una Reserva a Actualizar:</label>
        <select name="reservation_id" onchange="this.form.submit()">
            <option value="">Seleccionar una Reserva</option>
            <?php
            while ($row = $result->fetch_assoc()) {
                $reservation_id = $row["id"];
                echo "<option value='$reservation_id'>$reservation_id</option>";
            }
            ?>
        </select><br><br>

        <input type="hidden" name="reservation_id" value="<?php echo $reservation_id; ?>">
        <label for="customer_id">ID del Cliente:</label>
        <input type="text" name="customer_id" value="<?php echo $customer_id; ?>" required><br><br>

        <label for="date_in">Fecha de Entrada:</label>
        <input type="date" name="date_in" value="<?php echo $date_in; ?>" required><br><br>

        <label for="date_out">Fecha de Salida:</label>
        <input type="date" name="date_out" value="<?php echo $date_out; ?>" required><br><br>

        <label for="room_id">ID de la Habitación:</label>
        <input type="text" name="room_id" value="<?php echo $room_id; ?>" required><br><br>

        <label for="room_price">Precio de la Habitación:</label>
        <input type="text" name="room_price" value="<?php echo $room_price; ?>" required><br><br>

        <label for="status">Estado de la Reserva:</label>
        <input type="text" name="status" value="<?php echo $status; ?>" required><br><br>

        <label for="services">Servicios Adicionales:</label>
        <input type="text" name="services" value="<?php echo $services; ?>" required><br><br>

        <input type="submit" value="Actualizar Reserva">
    </form>
</body>
</html>
