<?php
$host = "localhost"; 
$username = "root";  
$password = "";     
$database = "van_go"; 

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM feedback_form WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: feedback_list.php");
        exit();
    } else {
        echo "Error deleting feedback: " . $stmt->error;
    }
}

$conn->close();
?>
