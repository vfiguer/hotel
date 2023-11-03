<?php
require "bd_connection.php";

// Inicializa una variable para almacenar el número de la habitación a eliminar
$room_number_to_delete = "";

// Verifica si se ha enviado el formulario de eliminación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_room'])) {
    $room_number_to_delete = $_POST["room_number_to_delete"];

    // Consulta SQL para eliminar la habitación basada en el número
    $sql = "DELETE FROM rooms WHERE number = '$room_number_to_delete'";

    if ($conn->query($sql) === TRUE) {
        echo "Habitación eliminada exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Habitación</title>
</head>
<body>
    <h2>Eliminar Habitación</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="room_number_to_delete">Ingrese el Número de Habitación a Eliminar:</label>
        <input type="text" name="room_number_to_delete" required>
        <input type="submit" name="delete_room" value="Eliminar Habitación"><br><br>
    </form>
</body>
</html>
