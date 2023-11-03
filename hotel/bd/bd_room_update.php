<?php
require "bd_connection.php";

$room_id = "";
$number = "";
$type = "";
$status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['room_number'])) {
    $room_number = $_POST['room_number'];

    $sql = "SELECT * FROM rooms WHERE number = '$room_number'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $room_id = $row["id"];
        $number = $row["number"];
        $type = $row["type"];
        $status = $row["status"];
    } 
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_room'])) {
    $room_id = $_POST["room_id"];
    $number = $_POST["number"];
    $type = $_POST["type"];
    $status = $_POST["status"];

    $sql = "UPDATE rooms SET number='$number', type='$type', status='$status' WHERE id='$room_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Datos actualizados exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Actualizar Datos de Habitación</title>
</head>
<body>
    <h2>Actualizar Datos de Habitación</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="room_number">Ingrese el Número de Habitación:</label>
        <input type="text" name="room_number" >
        <input type="submit" value="Buscar Información de Habitación"><br><br>

        <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">
        <label for="number">Número de Habitación:</label>
        <input type="text" name="number" value="<?php echo $number; ?>" ><br><br>

        <label for="type">Tipo de Habitación:</label>
        <input type="text" name="type" value="<?php echo $type; ?>" ><br><br>

        <label for="status">Estado de la Habitación:</label>
        <input type="text" name="status" value="<?php echo $status; ?>" ><br><br>
        <input type="submit" name="update_room" value="Actualizar Datos">
    </form>
</body>
</html>
