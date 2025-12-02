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

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch booking data from customer_info table
    $sql = "SELECT * FROM customer_info WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $booking = $result->fetch_assoc();

    

    // Insert booking data into Confirm_Book_schedule table
    if ($booking) {
        // Calculate the total amount before 12% discount
        $totalAmount = $booking['initial_amount'] / 0.12; // Total before discount
        // Calculate the amount due (difference between the total and the initial amount)
        $totalAmountDue = $totalAmount - $booking['initial_amount']; 

        

      

        // Insert data into Confirm_Book_schedule table with total_amount,and total_amount_due
        $insert_sql = "INSERT INTO Confirm_Book_schedule 
                        (name, company_name, address, phone_number, telephone_number, pickup_location, pickup_landmark, dropoff_location, 
                         service_type, service_option, van_model, cargo_model, rent_date, return_date, discount_option, 
                         payment_method, payment_detail_input, initial_amount, total_amount, total_amount_due) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("ssssssssssssssssssdd", 
        $booking['name'], $booking['company_name'], $booking['address'], $booking['phone_number'], $booking['telephone_number'], 
        $booking['pickup_location'], $booking['pickup_landmark'], $booking['dropoff_location'], $booking['service_type'], 
        $booking['service_option'], $booking['van_model'], $booking['cargo_model'], $booking['rent_date'], $booking['return_date'], 
        $booking['discount_option'], $booking['payment_method'], $booking['payment_detail_input'], $booking['initial_amount'], 
        $totalAmount, $totalAmountDue);
    

        if ($insert_stmt->execute()) {
            // After successful insertion, delete the booking from customer_info table
            $delete_sql = "DELETE FROM customer_info WHERE id = ?";
            $delete_stmt = $conn->prepare($delete_sql);
            $delete_stmt->bind_param("i", $id);
            if ($delete_stmt->execute()) {
                header("Location: admin_Costumer_dashboard.php");
            } else {
                echo "Error deleting booking: " . $delete_stmt->error;
            }
        } else {
            echo "Error inserting into Confirm_Book_schedule: " . $insert_stmt->error;
        }

        $insert_stmt->close();
    } else {
        echo "Booking not found.";
    }

    $stmt->close();
}

$conn->close();
?>