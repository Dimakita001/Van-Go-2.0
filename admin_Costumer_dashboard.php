<?php
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



// Fetch all bookings
$sql = "SELECT * FROM customer_info";
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    die("Error fetching data: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
    <title>www.VanGo.com/ADDashB</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }
        
        body {
          background: linear-gradient(135deg, #beceddff, #1f517fff);
            color: #333;
            padding: 20px;
            min-height: 100vh;
        }
        
        .header {
           background-color: #0f075aff;
            padding: 15px 30px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }
        
        .logo {
            color: #FFE1E0;
            font-size: 28px;
            font-weight: bold;
            text-decoration: none;
        }
        
        .navbar a {
            color: #FFE1E0;
            text-decoration: none;
            margin: 0 15px;
            font-size: 16px;
        }
        
        .login {
            display: flex;
            gap: 15px;
        }
        
        .login-btn {
            background-color: #3d9edaff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        
        .login-btn:hover {
            background-color: #FFE1E0;
            color: #7F55B1;
        }
        
        .admindashboard {
           background-color: rgba(252, 252, 252, 0.66);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }
        
        .admindashboard h1 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 32px;
            color: #7F55B1;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
            border-radius: 10px;
            overflow: hidden;
        }
        
        th, td {
            padding: 12px 15px;
            text-align: center;
            border: 1px solid #9B7EBD;
        }
        
        th {
            background-color: #0f075aff;
            color: #ffffffff;
            font-weight: bold;
        }
        
        tr:nth-child(even) {
            background-color: #ffffffff;
            color: #3c3b3bff;
        }
        
        tr:nth-child(odd) {
          background-color: #a9a7c1; 
            color: #3c3b3bff;
        }
        
        button {
            background-color: #7F55B1;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 3px;
        }
        
        button:hover {
            background-color: #F49BAB;
        }
        
        .confirm-btn {
            background-color: #7F55B1;
        }
        
        .confirm-btn:hover {
            background-color: #351a5bff;
        }
        
        .deny-btn {
            background-color: #F49BAB;
        }
        
        .deny-btn:hover {
            background-color: #893847ff;
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
            <a href="AdminReview_page.php">
                <button class="login-btn">Back</button>
            </a>
            <a href="confirmed_bookings.php">
                <button class="login-btn">Next</button>
            </a>
        </div>
    </header>

  <div class="admindashboard">
    <h1>Booking Requests</h1>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Company Name</th>
            <th>Phone Number</th>
            <th>Telephone Number</th>
            <th>Pick Up Location</th>
            <th>Pick Up Landmark</th>
            <th>Drop off location</th>
            <th>Rent Date and Time</th>
            <th>Return Date</th>
            <th>Service Type</th>
            <th>Service Option</th>
            <th>Action</th>
        </tr>

        <?php
        // Check if we have results
        if ($result->num_rows > 0) {
            // Fetch and display data
            while ($row = $result->fetch_assoc()) {
        ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['company_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                    <td><?php echo htmlspecialchars($row['telephone_number']); ?></td>
                    <td><?php echo htmlspecialchars($row['pickup_location']); ?></td>
                    <td><?php echo htmlspecialchars($row['pickup_landmark']); ?></td>
                    <td><?php echo htmlspecialchars($row['dropoff_location']); ?></td>
                    <td><?php echo htmlspecialchars($row['rent_date']); ?></td>
                    <td><?php echo htmlspecialchars($row['return_date']); ?></td>
                    <td><?php echo htmlspecialchars($row['service_type']); ?></td>
                    <td><?php echo htmlspecialchars($row['service_option']); ?></td>
                    <td style="display:flex; gap:5px; justify-content:center;">

                       <form action="admin_confirm.php" method="GET" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" onclick="alert('Booking confirmed!!');"> Confirm </button>
                    </form>

    
                    <form action="admin_deny.php" method="GET" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" onclick="return confirm('Are you sure?');"> Deny </button>
                    </form>
                    </td>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='12'>No booking requests found.</td></tr>";
        }
        ?>
    </table>
</div>

    <!-- No script needed: confirmation handled by form onsubmit, and confirm handled by backend. -->
</body>
</html>

<?php
$conn->close();
?>