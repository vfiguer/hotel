<?php
require "bd_connection.php";

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_customer'])) {
    $customer_id_to_delete = $_POST["customer_id_to_delete"];

    $sql = "DELETE FROM customers WHERE id = '$customer_id_to_delete'";

    if ($conn->query($sql) === TRUE) {
        echo "Cliente eliminado exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Cliente</title>
</head>
<body>
    <h2>Eliminar Cliente</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="customer_id_to_delete">Ingrese el ID del Cliente a Eliminar:</label>
        <input type="text" name="customer_id_to_delete" required>
        <input type="submit" name="delete_customer" value="Eliminar Cliente"><br><br>
    </form>
</body>
</html>
