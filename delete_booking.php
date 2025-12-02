<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "van_go";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Delete the booking from Confirm_Book_schedule
    $sql = "DELETE FROM Confirm_Book_schedule WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>
                alert('Booking deleted successfully.');
                window.location.href = 'confirmed_bookings.php';
              </script>";
    } else {
        echo "Error deleting booking: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
