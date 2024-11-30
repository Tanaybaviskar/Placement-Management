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
            background-color: tan;
        }
        .message-box {
            background-color: white; /* Changed from #4CAF50 to white */
            color: #4CAF50; /* Changed text color to green for better contrast */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            opacity: 0;
            animation: fadeIn 2s forwards;
        }
        .home-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: red; /* Changed the button background to magenta */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .home-button:hover {
            background-color: #d400d4; /* Adjusted hover color to a darker magenta */
            color: white;
        }
        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="message-box">
        <?php
        echo 'Student Registered Sucessfully!!';
        ?>
        <br><br><br>
        <a href="registerstudent.php" class="home-button">Go to Home Page</a>
    </div>
</body>
</html>