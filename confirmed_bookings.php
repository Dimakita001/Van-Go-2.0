<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "van_go";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all confirmed bookings
$sql = "SELECT * FROM Confirm_Book_schedule";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <title>www.VanGo.com/CADDashB</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }
        
        body {
          background: #beceddff;
            color: #333;
            padding: 20px;
        }
        
        .header {
            background-color: #0f075aff;
            padding: 15px 30px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .logo {
            color: white;
            font-size: 28px;
            font-weight: bold;
            text-decoration: none;
        }
        
        .navbar {
            display: flex;
            gap: 20px;
        }
        
        .navbar a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            transition: opacity 0.3s;
        }
        
        .navbar a:hover {
            opacity: 0.8;
        }
        
        .login {
            display: flex;
            gap: 15px;
        }
        
        .login-btn {
            background-color: #3d9edaff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s;
        }
        
        .login-btn:hover {
            background-color: #e87c90;
        }
        
        .BookConfirm {
            background-color: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
        
        h2 {
            text-align: center;
            color: #7F55B1;
            margin-bottom: 25px;
            font-size: 28px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
        }
        
        th, td {
            padding: 12px 15px;
            text-align: center;
            border: 1px solid #434343ff;
        }
        
        th {
            background-color: #0f075aff;
            color: white;
            font-weight: 600;
        }
        
        tr:nth-child(even) {
            background-color: #ffffffff;
        }
        
        tr:hover {
            background-color: #e5e0e8ff;
        }
        
        .delete-btn {
            background-color: #7F55B1;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s;
        }
        
        .delete-btn:hover {
            background-color: #c65166ff;
        }
        
        .no-bookings {
            text-align: center;
            padding: 20px;
            color: #7F55B1;
            font-style: italic;
        }
    </style>
</head>
<body>
    <header class="header">
        <a href="index.php" class="logo">
           <img src="logo01.png" alt="Van Go Logo"
            style="height: 80px;width:80px;vertical-align:middle;margin-right:8px; border: none;">
           Van Go
        </a>
        <nav class="navbar">
            <a href="#"></a>
            <a href="#"></a>
            <a href="#"></a>
        </nav>
        <div class="login">
            <a href="admin_Costumer_dashboard.php">
                <button class="login-btn">Back</button>
            </a>
            <a href="feedback_list.php">
                <button class="login-btn">Next</button>
            </a>
        </div>
    </header>

   <div class="BookConfirm">
   <h2>Confirmed Bookings Schedule</h2>
    <table>
        <tr>
           
            <th>Name</th>
            <th>Company Name</th>
            <th>Phone Number</th>
            <th>Pickup Location</th>
            <th>Dropoff Location</th>
            <th>Service Type</th>
            <th>Service Option</th>
            <th>Rent Date</th>
            <th>Return Date</th>
            <th>Initial Amount</th>
            <th>Total Amount</th>
            <th>Total Amount Due</th>
            <th>Action</th>
        </tr>

        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['company_name']; ?></td>
                    <td><?= $row['phone_number']; ?></td>
                    <td><?= $row['pickup_location']; ?></td>
                    <td><?= $row['dropoff_location']; ?></td>
                    <td><?= $row['service_type']; ?></td>
                    <td><?= $row['service_option']; ?></td>
                    <td><?= $row['rent_date']; ?></td>
                    <td><?= $row['return_date']; ?></td>
                    <td><?= number_format($row['initial_amount'], 2); ?></td>
                    <td><?= number_format($row['total_amount'], 2); ?></td>
                    <td><?= number_format($row['total_amount_due'], 2); ?></td>
                    <td>
                        <form action="delete_booking.php" method="POST" 
                         onsubmit="return confirm('Are you sure you want to delete this booking?');">
                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                        <button type="submit" class="delete-btn">Delete</button>
                    </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="14">No confirmed bookings found.</td></tr>
        <?php endif; ?>
    </table>
   </div>

    <?php $conn->close(); ?>
</body>
</html>