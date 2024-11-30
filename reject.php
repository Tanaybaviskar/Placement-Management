<?php
// Database connection
$servername = "localhost:3307";
$username = "root";
$password = "physicsW21";
$dbname = "placement";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if student_id and company_id are passed in the URL
$message = "";
if (isset($_GET['student_id']) && isset($_GET['company_id'])) {
    $student_id = $_GET['student_id'];
    $company_id = $_GET['company_id'];
    
    // Delete the corresponding record from the applications table
    $delete_sql = "DELETE FROM applications WHERE student_id = ? AND company_id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("ii", $student_id, $company_id);
    
    if ($delete_stmt->execute()) {
        $message = "Application successfully rejected";
        $message_class = "success";
    } else {
        $message = "Error deleting application: " . $delete_stmt->error;
        $message_class = "error";
    }
    
    $delete_stmt->close();
} else {
    $message = "Error: Missing student_id or company_id in URL parameters.";
    $message_class = "error";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .message {
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            font-size: 18px;
            width: 50%;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="message <?php echo $message_class; ?>">
        <?php echo $message; ?>
    </div>
</body>
</html>
