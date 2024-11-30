<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 99%, #fad0c4 100%);
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
        }
        .message-box {
            background-color: white;
            color: #4CAF50;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            opacity: 0;
            animation: fadeIn 2s forwards;
        }
        .home-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .home-button:hover {
            background-color: #d400d4;
            color: white;
        }
        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }
        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
    </style>
</head>
<body>
    <div class="message-box">
        <?php
        echo 'Company Registered Successfully!!';
        ?>
        <br><br><br>
        <a href="registercompany.php" class="home-button">Go to Home Page</a>
    </div>
</body>
</html>