<?php
require "bd_connection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number = $_POST["number"];
    $type = $_POST["type"];
    $status = $_POST["status"];
    $available_extras = $_POST["available_extras"];

    $sql = "INSERT INTO rooms (number, type, status, available_extras) VALUES ('$number', '$type', '$status', '$available_extras')";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insert Room Data</title>
</head>
<body>
    <h2>Insert Room Data</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="number">Room Number:</label>
        <input type="text" name="number" required><br><br>

        <label for="type">Room Type:</label>
        <input type="text" name="type" required><br><br>

        <label for="status">Room Status:</label>
        <input type="text" name="status" required><br><br>

        <label for="available_extras">Available Extras:</label>
        <input type="text" name="available_extras" required placeholder='{"wifi": true, "tv": true, "minibar": true}'><br><br>

        <input type="submit" value="Insert Data">
    </form>
</body>
</html>
