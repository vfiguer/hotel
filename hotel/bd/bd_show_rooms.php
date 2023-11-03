<?php
require "bd_connection.php";

$roomType = "";
$dateIn = "";
$dateOut = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roomType = $_POST["room_type"];
    $dateIn = $_POST["date_in"];
    $dateOut = $_POST["date_out"];
}

$query = "SELECT * FROM rooms WHERE status = 'ready'";

if (!empty($roomType)) {
    $query .= " AND type = '$roomType'";
}

if (!empty($dateIn) && !empty($dateOut)) {
    $query .= " AND id NOT IN (SELECT room_id FROM reservations WHERE date_in <= '$dateOut' AND date_out >= '$dateIn')";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Habitaciones - Hotel Elegante</title>
    <link rel="stylesheet" href="../css/style2.css">
</head>
<body>
    <header>
        <h1 class="hotel-title"><a href ="../index.html" >Hotel Elegante<a></h1>
        <br>
        <nav>
            <ul class="nav-list">
                <li><a href="#habitaciones">Habitaciones</a></li>
                <li><a href="#reservas">Reservas</a></li>
                <li><a href="login.php" class="btn-login">Log In</a></li>
                <li><a href="register.php" class="btn-register">Register</a></li>
            </ul>
        </nav>
    </header>

    <section id="buscar-habitaciones" class="search-rooms-section">
        <h2>Buscar Habitaciones Disponibles</h2>
        <form action="" method="post">
            <label for="room_type">Tipo de Habitación:</label>
            <select name="room_type" id="room_type">
                <option value="">Cualquier tipo</option>
                <option value="1">Individual</option>
                <option value="2">Doble</option>
                <option value="3">Suite</option>
                <option value="4">Familiar</option>
                <option value="5">Deluxe</option>
                <option value="6">Presidencial</option>
            </select>
            <label for="date_in">Fecha de Entrada:</label>
            <input type="date" name="date_in" id="date_in">
            <label for="date_out">Fecha de Salida:</label>
            <input type="date" name="date_out" id="date_out">
            <input type="submit" value="Buscar">
        </form>
    </section>

    <section id="habitaciones-disponibles" class="available-rooms-section">
        <h2>Habitaciones Disponibles</h2>
        <ul>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>";
                echo "Número de Habitación: " . $row["number"] . "<br>";
                echo "Tipo de Habitación: " . $row["type"] . "<br>";
                echo "Estado de Disponibilidad: " . $row["status"] . "<br>";
                echo "</li>";
            }
            ?>
        </ul>
    </section>
</body>
</html>
