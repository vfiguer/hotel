<?php
require "bd_connection.php";

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST["customer_id"];
    $name = $_POST["name"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $dni = $_POST["dni"];

    $sql = "UPDATE customers SET name='$name', password='$password', email='$email', phone='$phone', dni='$dni' WHERE id='$customer_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Datos del cliente actualizados exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['id'])) {
    $customer_id = $_GET['id'];

    $sql = "SELECT * FROM customers WHERE id = $customer_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row["name"];
        $password = $row["password"];
        $email = $row["email"];
        $phone = $row["phone"];
        $dni = $row["dni"];
    } else {
        echo "Cliente no encontrado.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Actualizar Cliente</title>
</head>
<body>
    <h2>Actualizar Cliente</h2>
    <form action="update_customer.php" method="post">
        <label for="customer_id">Seleccione un Cliente a Actualizar:</label>
        <select name="customer_id" onchange="this.form.submit()">
            <option value="">Seleccionar un Cliente</option>
            <!-- Aquí debes llenar las opciones del menú desplegable con datos de la base de datos -->
        </select><br><br>

        <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
        <label for="name">Nombre:</label>
        <input type="text" name="name" value="<?php echo $name; ?>" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" value="<?php echo $password; ?>" required><br><br>

        <label for="email">Correo Electrónico:</label>
        <input type="email" name="email" value="<?php echo $email; ?>" required><br><br>

        <label for="phone">Teléfono:</label>
        <input type="text" name="phone" value="<?php echo $phone; ?>" required><br><br>

        <label for="dni">DNI:</label>
        <input type="text" name="dni" value="<?php echo $dni; ?>" required><br><br>

        <input type="submit" value="Actualizar Cliente">
    </form>
</body>
</html>
