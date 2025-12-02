<?php
session_start();

// Ensure the user is authenticated
if (!isset($_SESSION['authenticated'])) {
    header('Location: index.php'); // Redirect to login page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>www.VanGo.com/Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #0f075aff;
            --secondary: #e08393;
            --accent: #3d9edaff;
            --light: #FFE1E0;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, var(--light) 0%, #f8f8f8 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: #333;
        }
        
        .header {
            background: var(--primary);
            padding: 1rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .logo {
            font-size: 2rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
        }
        
        .login-btn {
            background: var(--accent);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .login-btn:hover {
            background: #e08393;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        
        .Adminbody {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
            padding: 2rem;
            background: linear-gradient(135deg, #beceddff, #4c647bff);
            
        }
        
        .Admincontainer {
            background: rgba(255, 255, 255, 0.5);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(27, 26, 26, 0.5);
            padding: 2.5rem;
            width: 100%;
            max-width: 450px;
            transition: all 0.4s ease;
        }
        
        .form-title {
            color: var(--primary);
            text-align: center;
            margin-bottom: 1.8rem;
            font-size: 1.8rem;
            font-weight: 700;
        }
        
        .input-group {
            margin-bottom: 1.5rem;
            position: relative;
        }
        
        .input-group input {
            width: 100%;
            padding: 1rem 1.2rem;
            border: 2px solid #e6e6e6;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .input-group input:focus {
            border-color: var(--secondary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(155, 126, 189, 0.2);
        }
        
        .btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 10px;
            width: 100%;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 0.5rem;
        }
        
        .btn:hover {
            background: #b45867ff;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(127, 85, 177, 0.2);
        }
        
        .link {
            text-align: center;
            margin-top: 1.5rem;
            color: #666;
        }
        
        .link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s ease;
        }
        
        .link a:hover {
            color: var(--secondary);
            text-decoration: underline;
        }
        
        .link p {
            margin-bottom: 0.5rem;
        }
        
        .Recover {
            text-align: center;
            margin: 1rem 0;
        }
        
        .Recover a {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }
        
        .Recover a:hover {
            color: #e08393;
            text-decoration: underline;
        }
        
        @media (max-width: 768px) {
            .Admincontainer {
                padding: 2rem 1.5rem;
            }
            
            .header {
                padding: 1rem;
            }
            
            .logo {
                font-size: 1.5rem;
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
        <a href="index.php">
            <button class="login-btn">Back</button>
        </a>
    </div>
</header>

<div class="Adminbody">
    <div class="Admincontainer" id="SignUpform" style="display: none;">
        <h1 class="form-title">Register</h1>
        <form method="post" action="register.php">
            <div class="input-group">
                <input type="text" name="fname" id="fname" placeholder="First name" required>
            </div>
            <div class="input-group">
                <input type="text" name="Lname" id="Lname" placeholder="Last name" required>
            </div>
            <div class="input-group">
                <input type="email" name="email" id="email" placeholder="Email address" required>
            </div>
            <div class="input-group">
                <input type="password" name="Password" id="Password" placeholder="Password" required>
            </div>
            <input type="submit" class="btn" value="Sign Up" name="signUp">
            <div class="link">
                <p>Already have an account?</p>
                <a href="#" id="SignINbutton">Sign In</a>
            </div>
        </form>
    </div>
    <div class="Admincontainer" id="SignINform">
        <h1 class="form-title">Login</h1>
        <form method="post" action="register.php">
            <div class="input-group">
                <input type="email" name="email" id="email" placeholder="Email address" required>
            </div>
            <div class="input-group">
                <input type="password" name="Password" id="Password" placeholder="Password" required>
            </div>
            <input type="submit" class="btn" value="Sign In" name="SignIN">
            <p class="Recover">
                <a href="#">Recover Password</a>
            </p>
            <div class="link">
                <p>Don't Have an Account Yet?</p>
                <a href="#" id="SignUpbutton">Sign Up</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById("SignUpbutton").addEventListener("click", function() {
        document.getElementById("SignUpform").style.display = "block";
        document.getElementById("SignINform").style.display = "none";
    });

    document.getElementById("SignINbutton").addEventListener("click", function() {
        document.getElementById("SignUpform").style.display = "none";
        document.getElementById("SignINform").style.display = "block";
    });
</script>
</body>
</html>