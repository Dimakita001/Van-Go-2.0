<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Access Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }
        
        body {
           background: linear-gradient(135deg, #beceddff, #17446dff);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: #333;
        }
        
        .header {
            background-color: #0f075aff;
            padding: 1.2rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }
        
        .logo {
            color: #FFE1E0;
            font-size: 1.8rem;
            font-weight: 700;
            text-decoration: none;
            letter-spacing: 1px;
        }
        
        .navbar {
            display: flex;
            gap: 2rem;
        }
        
        .navbar a {
            color: #FFE1E0;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 4px;
        }
        
        .navbar a:hover {
            background-color: rgba(255, 225, 224, 0.2);
        }
        
        .login-btn {
            background-color: #3d9edaff;
            color: #fff;
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .login-btn:hover {
            background-color: #FFE1E0;
            color: #7F55B1;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        
        .Accesscontainer {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }
        
        .AccessForm {
            background-color: #e6dfdfff;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 450px;
            text-align: center;
        }
        
        .AccessForm h1 {
            color: #7F55B1;
            margin-bottom: 1.8rem;
            font-size: 1.8rem;
        }
        
        form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        
        label {
            text-align: left;
            color: #7F55B1;
            font-weight: 600;
        }
        
        input[type="password"] {
            padding: 1rem;
            border: 2px solid #9B7EBD;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        input[type="password"]:focus {
            outline: none;
            border-color: #e08393;
            box-shadow: 0 0 0 3px rgba(127, 85, 177, 0.3);
        }
        
        button[type="submit"] {
            background-color: #7F55B1;
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        button[type="submit"]:hover {
            background-color: #b46978ff;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        @media (max-width: 768px) {
            .header {
                padding: 1rem;
            }
            
            .navbar {
                gap: 1rem;
            }
            
            .AccessForm {
                padding: 2rem 1.5rem;
                margin: 1rem;
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
    </header>
    
    <div class="Accesscontainer">
        <div class="AccessForm">
            <h1>Restricted Page</h1>
            <form action="validate_code.php" method="POST">
                <label for="code">Enter Access Code:</label>
                <input type="password" id="code" name="code" required placeholder="Enter your access code">
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>