<?php
require "bd_connection.php";

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_reservation'])) {
    $reservation_id_to_delete = $_POST["reservation_id_to_delete"];

    $sql = "DELETE FROM reservations WHERE id = '$reservation_id_to_delete'";

    if ($conn->query($sql) === TRUE) {
        echo "Reserva eliminada exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Reserva</title>
</head>
<body>
    <h2>Eliminar Reserva</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="reservation_id_to_delete">Ingrese el ID de la Reserva a Eliminar:</label>
        <input type="text" name="reservation_id_to_delete" required>
        <input type="submit" name="delete_reservation" value="Eliminar Reserva"><br><br>
    </form>
</body>
</html>
