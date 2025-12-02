<?php
session_start();
include 'Connect.php'; 

// Handle Signup
if (isset($_POST['signUp'])) {
    $Firstname = $_POST['fname'];
    $LastName = $_POST['Lname'];
    $Email = $_POST['email'];
    $Password = $_POST['Password'];
    $Password = md5($Password); 

    $checkEmail = "SELECT * FROM Staff_admin WHERE email = '$Email'";
    $result = $conn->query($checkEmail);

    if ($result->num_rows > 0) {
        echo "Email already exists!";
    } else {
        // Insert new user into the database
        $insertQuery = "INSERT INTO Staff_admin (Firstname, LastName, Email, Password) 
                        VALUES ('$Firstname', '$LastName', '$Email', '$Password')";

        if ($conn->query($insertQuery) === TRUE) {
            // Display confirmation alert and redirect
            echo "<script>
                    alert('Registration Successful!');
                    window.location.href = 'AD00.php';
                  </script>";
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

// Handle Sign In
if (isset($_POST['SignIN'])) {
    $Email = $_POST['email'];
    $Password = $_POST['Password'];
    $Password = md5($Password); // If you're using md5 for password hashing

    $sql = "SELECT * FROM Staff_admin WHERE email = '$Email' AND Password = '$Password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email']; // Store email in session

        // Redirect to Home page after successful login
        header("Location: AdminReview_page.php");
        exit();
    } else {
        echo "Incorrect Email or Password.";
    }
}
?>
