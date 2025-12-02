<?php
$host = "localhost"; 
$username = "root";  
$password = "";     
$database = "van_go"; 

// connection
$conn = new mysqli($host, $username, $password, $database);

// verification
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all feedback
$sql = "SELECT * FROM feedback_form ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
    <title>www.VanGo.com/FBLDashB</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }
        
        body {
         background: linear-gradient(135deg, #beceddff, #17446dff);
            color: #333;
            padding: 20px;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background-color: #0f075aff; 
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(127, 85, 177, 0.3);
        }
        
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #FFE1E0;
            text-decoration: none;
        }
        
        .navbar {
            display: flex;
            gap: 20px;
        }
        
        .navbar a {
            color: #FFE1E0;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s;
        }
        
        .navbar a:hover {
            color: #F49BAB;
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
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        
        .login-btn:hover {
            background-color: #e58a9a;
        }
        
        .Feedslist {
            background-color: #dedee1ff; 
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        h2 {
            text-align: center;
            color: #7F55B1;
            margin-bottom: 25px;
            font-size: 28px;
            padding-bottom: 10px;
            border-bottom: 2px solid #9B7EBD;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #e0e0e0;
        }
        
        th {
            background-color: #0f075aff; 
            color: white;
            font-weight: bold;
        }
        
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        tr:hover {
            background-color: #e4e4e4ff;
        }
        
        .delete-btn {
            background-color: #7F55B1;
            color: white;
            padding: 8px 15px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
            transition: background-color 0.3s;
        }
        
        .delete-btn:hover {
            background-color: #e58a9a;
        }
        
        .no-messages {
            text-align: center;
            color: #7F55B1;
            font-style: italic;
            padding: 20px;
        }
        
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 15px;
            }
            
            table {
                display: block;
                overflow-x: auto;
            }
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
        <a href="confirmed_bookings.php">
            <button class="login-btn">Back</button>
        </a>
        <a href="AdminReview_page.php">
            <button class="login-btn">Next</button>
        </a>
    </div>
</header>

    <div class="Feedslist">
    <h2>Feedback Message</h2>

    <table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Message</th>
        <th>Action</th>
    </tr>

    <?php if ($result->num_rows > 0) : ?>
    <?php while ($row = $result->fetch_assoc()) : ?>
        <tr>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['message']); ?></td>
            <td>
                <form action="delete_feedback.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                    <button type="submit" class="delete-btn">Delete</button>
                </form>
            </td>
        </tr>
    <?php endwhile; ?>
<?php else : ?>
    <tr>
        <td colspan="4">No messages found.</td>
    </tr>
<?php endif; ?>

    </table>
    </div>
    <script>
        // Simple confirmation for delete actions
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('Are you sure you want to delete this message?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
</body>
</html>

<?php $conn->close(); ?>
