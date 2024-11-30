<?php
// Start the session
session_start();

// Database connection
$servername = "localhost";
$username = "root"; // Change to your MySQL username
$password = "Tanay@123"; // Change to your MySQL password
$dbname = "placement"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: {$conn->connect_error}");
}

// Get the login credentials from the form
$user_email = $_POST['email'];
$user_password = $_POST['password'];
$user_role = $_POST['role']; // 'student', 'company', or 'admin'

// Sanitize inputs to avoid SQL injection
$user_email = $conn->real_escape_string($user_email);
$user_password = $conn->real_escape_string($user_password);

// Hash the password before checking (if stored hashed in DB)
$user_password = md5($user_password); // Or use bcrypt if needed

// Prepare the query based on the role selected
if ($user_role == 'student') {
    $sql = "SELECT * FROM students WHERE email = '$user_email' AND password = '$user_password'";
} elseif ($user_role == 'company') {
    $sql = "SELECT * FROM company WHERE email = '$user_email' AND password = '$user_password'";
} elseif ($user_role == 'admin') {
    $sql = "SELECT * FROM admin WHERE name = '$user_email' AND password = '$user_password'";
} else {
    // Invalid role, redirect back with an error
    header("Location: login.php?error=Invalid Role");
    exit();
}

// Execute the query
$result = $conn->query($sql);

// Check if the query returned a result
if ($result->num_rows > 0) {
    // User found, store session and redirect
    $user_data = $result->fetch_assoc();
    $_SESSION['user_id'] = $user_data['student_id'];  // Store user ID in session
    $_SESSION['user_email'] = $user_data['email']; // Store user email in session
    $_SESSION['user_role'] = $user_role; // Store role in session

    // Redirect based on role
    if ($user_role == 'student') {
        header("Location: student_dashboard.php");
    } elseif ($user_role == 'company') {
        header("Location: company_dashboard.php");
    } elseif ($user_role == 'admin') {
        header("Location: admin_dashboard.php");
    }
} else {
    // If no user found, redirect to login page with an error
    header("Location: login.php?error=Invalid Credentials");
}

// Close the database connection
$conn->close();
?>
