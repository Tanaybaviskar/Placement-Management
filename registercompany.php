<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "placement";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $location = $_POST['location'];
    $contact_info = $_POST['contact_info'];
    $job_type = $_POST['job_type'];

    $sql = "INSERT INTO company (name, email, password, location, contact_info, job_type) VALUES ('$name', '$email', '$password', '$location', '$contact_info', '$job_type')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
header('location:msgcompany.php');
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Company</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-green-400 to-blue-500 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Register Company</h2>
        <form method="post" action="">
            <label for="name" class="block mb-2">Name:</label>
            <input type="text" id="name" name="name" required class="w-full p-2 mb-4 border border-gray-300 rounded">
            <label for="email" class="block mb-2">Email:</label>
            <input type="email" id="email" name="email" required class="w-full p-2 mb-4 border border-gray-300 rounded">
            <label for="password" class="block mb-2">Password:</label>
            <input type="password" id="password" name="password" required class="w-full p-2 mb-4 border border-gray-300 rounded">
            <label for="location" class="block mb-2">Location:</label>
            <input type="text" id="location" name="location" class="w-full p-2 mb-4 border border-gray-300 rounded">
            <label for="contact_info" class="block mb-2">Contact Info:</label>
            <input type="text" id="contact_info" name="contact_info" class="w-full p-2 mb-4 border border-gray-300 rounded">
            <label for="job_type" class="block mb-2">Job Type:</label>
            <select id="job_type" name="job_type" required class="w-full p-2 mb-4 border border-gray-300 rounded">
                <option value="Full Time">Full Time</option>
                <option value="Intern">Intern</option>
            </select>
            <input type="submit" value="Register" class="w-full p-2 bg-green-500 text-white rounded hover:bg-green-600">
        </form>
       
    </div>
    
</body>
</html>
