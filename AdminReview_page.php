<?php
$host = "localhost"; 
$username = "root";  
$password = "";      
$database = "van_go"; 

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Approve/Delete actions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $review_id = $_POST['review_id'];  // Fixed to match input name
    $action = $_POST['action'];

    if ($action === "approve") {
        $conn->query("UPDATE reviews SET status='approved' WHERE ReviewID=$review_id"); // Update status to 'approved'
    } elseif ($action === "delete") {
        // Delete images from the server before removing the review
        $result = $conn->query("SELECT image FROM reviews WHERE ReviewID=$review_id");
        if ($result === false) {
            die("SQL Error (SELECT image): " . $conn->error);
        }
        $row = $result->fetch_assoc();
        if (!empty($row['image'])) {
            // If you store the file path, use it directly. If you store the image as binary, skip deletion.
            // Example: if (file_exists($row['image'])) { unlink($row['image']); }
            // But your 'image' is a LONGBLOB, so nothing to delete from disk.
        }
        $deleteResult = $conn->query("DELETE FROM reviews WHERE ReviewID=$review_id"); // Updated column name
        if ($deleteResult === false) {
            die("SQL Error (DELETE review): " . $conn->error);
        }
    }
}

// Fetch all reviews
$result = $conn->query("SELECT * FROM reviews ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>www.VanGo.com/Admin_review</title>
    <link rel="stylesheet" href="StyleSheet.Css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
          background: #4476a5ff;
            color: #333;
            margin: 0;
            padding: 0;
        }
        
        .header {
            background-color: #0f075aff;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #FFE1E0;
            text-decoration: none;
        }
        
        .login-btn {
            background-color: #3d9edaff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease;
        }
        
        .login-btn:hover {
            background-color: #9B7EBD;
        }
        
        .adminreviewpage {
            padding: 30px;
            background: linear-gradient(135deg, #beceddff, #4476a5ff);
         min-height: calc(100vh - 80px);
        }
        
        h2 {
            text-align: center;
            color: #7F55B1;
            margin-bottom: 30px;
            font-size: 32px;
        }
      
        table {
            width: 100%; 
            border-collapse: collapse;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        th, td { 
            padding: 15px; 
            border: 1px solid #ddd; 
            text-align: center; 
        }
        
        th { 
            background: #0f075aff;  
            color: white; 
            font-weight: bold;
        }
        
        tr:nth-child(even) {
            background-color: white;
        }
        
        img { 
            width: 130px; 
            border-radius: 5px; 
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        
        img:hover {
            transform: scale(1.05);
        }
        
        /* Image Modal Styles */
        .img-modal {
            display: none;
            position: fixed;
            z-index: 10000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.8);
        }
        
        .img-modal-content {
            display: block;
            margin: 5% auto;
            border-radius: 8px;
            box-shadow: 0 0 20px #000;
            /* Show image at true size unless it exceeds viewport */
            width: auto;
            height: auto;
            max-width: 90vw;
            max-height: 90vh;
        }
        
        .img-modal-close {
            position: absolute;
            top: 30px;
            right: 50px;
            color: #fff;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
            z-index: 10001;
            transition: color 0.3s ease;
        }
        
        .img-modal-close:hover {
            color: #F49BAB;
        }
        
        .action-btn {  
            cursor: pointer; 
            border: none; 
            gap:10px; 
            border-radius: 5px;
            padding: 12px 20px;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        
         .approve { 
           background-color: #7F55B1;
            color: white;
            font-size: 16px; 
        }
        
        .approve:hover {
              background-color: #351a5bff;
        }
        
        .delete { 
           background-color: #F49BAB;
            color: white;
            font-size: 16px; 
        }
        
        .delete:hover {
             background-color: #893847ff;
        }
        
        
        
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        
        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 30px;
            border: none;
            width: 350px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }
        
        .modal-content p {
            color: #7F55B1;
            padding: 15px 0;
            font-size: 18px;
        }
        
        .modal-btn {
            margin: 15px 10px 0 10px;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .modal-btn.confirm {
            background: #F49BAB; 
            color: white;
        }
        
        .modal-btn.confirm:hover {
            background: #e07a8b;
            transform: translateY(-2px);
        }
        
        .modal-btn.cancel {
            background: #9B7EBD; 
            color: white;
        }
        
        .modal-btn.cancel:hover {
            background: #7F55B1;
            transform: translateY(-2px);
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
        <a href="#">
            <!-- need for next page --->
        </a>
        <a href="admin_Costumer_dashboard.php">
            <button class="login-btn">Next</button>
        </a>
        <a href="#">
            <button class="login-btn" type="button" onclick="openLogoutModal()">
                <i class="fas fa-power-off"></i>
            </button>
        </a>
    </div>
    
    <!-- Logout Modal -->
    <div id="logoutModal" class="modal">
        <div class="modal-content">
            <p>Are you sure you want to log out?</p>
            <button class="modal-btn confirm" onclick="confirmLogout()">Log Out</button>
            <button class="modal-btn cancel" onclick="closeLogoutModal()">Cancel</button>
        </div>
    </div>
</header>

<div class="adminreviewpage">
<h2> Review Management </h2>
<table>
    <tr>
     <!-- Updated header -->
        <th>Name</th>
        <th>Message</th>
        <th>Rating</th>
        <th>Images</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
          
            <td><?php echo htmlspecialchars($row["name"]); ?></td>
            <td><?php echo htmlspecialchars($row["message"]); ?></td>
            <td><?php echo $row["rating"]; ?>/10</td>
            <td>
                <?php
                if (!empty($row["image"])) {
                    $base64 = base64_encode($row["image"]);
                    $imgSrc = "data:image/jpeg;base64,$base64";
                    $imgSrcEsc = htmlspecialchars($imgSrc, ENT_QUOTES, 'UTF-8');
                    echo "<img src='$imgSrcEsc' alt='Review Image' onclick=\"openImgModal('$imgSrcEsc')\" style='cursor:pointer;'>";
                } else {
                    echo "No Image";
                }
                ?>
            </td>
            <td><?php echo ucfirst($row["status"]); ?></td> <!-- Display the status -->
            <td>
                <?php if (strtolower($row["status"]) === "pending") { ?>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="review_id" value="<?php echo $row['ReviewID']; ?>">
                        <button type="submit" name="action" value="approve" class="action-btn approve">Approve</button>
                    </form>
                    <form method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to deny (delete) this review?');">
                        <input type="hidden" name="review_id" value="<?php echo $row['ReviewID']; ?>">
                        <button type="submit" name="action" value="delete" class="action-btn delete">Deny</button>
                    </form>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
</table>
</div>

<!-- Image Modal (outside PHP loop) -->
<div id="imgModal" class="img-modal" onclick="closeImgModal(event)">
    <span class="img-modal-close" onclick="closeImgModal(event)">&times;</span>
    <img class="img-modal-content" id="imgModalContent" src="" alt="Full Image">
</div>



</body>
<script>
// Image Modal JS
function openImgModal(src) {
    var modal = document.getElementById('imgModal');
    var modalImg = document.getElementById('imgModalContent');
    modal.style.display = 'block';
    modalImg.src = src;
}
function closeImgModal(event) {
    var modal = document.getElementById('imgModal');
    if (event.target === modal || event.target.classList.contains('img-modal-close')) {
        modal.style.display = 'none';
        document.getElementById('imgModalContent').src = '';
    }
}
</script>
<script>
function openLogoutModal() {
    document.getElementById('logoutModal').style.display = 'block';
}
function closeLogoutModal() {
    document.getElementById('logoutModal').style.display = 'none';
}
function confirmLogout() {
    window.location.href = 'index.php';
}
// Optional: Close modal when clicking outside
window.onclick = function(event) {
    var modal = document.getElementById('logoutModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
</script>
</html>

<?php
// Close database connection
$conn->close();
?>
