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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['student_name'])) {
    $student_name = $_POST['student_name'];
    $student_email = $_POST['student_email'];
    $student_password = MD5($_POST['student_password']);
    $roll_no = $_POST['roll_no'];
    $phone_no = $_POST['phone_no'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $course_type = $_POST['course_type'];
    $cpi = $_POST['cpi'];
    $branch = $_POST['branch'];

    $sql = "INSERT INTO students (name, email, password, roll_no, phone_no, dob, gender, course_type, cpi, branch) VALUES ('$student_name', '$student_email', '$student_password', '$roll_no', '$phone_no', '$dob', '$gender', '$course_type', '$cpi', '$branch')";

    if ($conn->query($sql) === TRUE) {
        echo "New student record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
header('location:msgstudent.php');
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register Student</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-green-400 to-blue-500 min-h-screen flex items-center justify-center">
    <div class="container mx-auto p-8 bg-white rounded-lg shadow-lg max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Register Student</h2>
        <form method="post" action="">
            <label for="student_name" class="block text-gray-700">Name:</label>
            <input type="text" id="student_name" name="student_name" class="w-full p-2 mb-4 border border-gray-300 rounded" required>
            
            <label for="student_email" class="block text-gray-700">Email:</label>
            <input type="email" id="student_email" name="student_email" class="w-full p-2 mb-4 border border-gray-300 rounded" required>
            
            <label for="student_password" class="block text-gray-700">Password:</label>
            <input type="password" id="student_password" name="student_password" class="w-full p-2 mb-4 border border-gray-300 rounded" required>
            
            <label for="roll_no" class="block text-gray-700">Roll No:</label>
            <input type="text" id="roll_no" name="roll_no" class="w-full p-2 mb-4 border border-gray-300 rounded" required>
            
            <label for="phone_no" class="block text-gray-700">Phone No:</label>
            <input type="text" id="phone_no" name="phone_no" class="w-full p-2 mb-4 border border-gray-300 rounded">
            
            <label for="dob" class="block text-gray-700">Date of Birth:</label>
            <input type="date" id="dob" name="dob" class="w-full p-2 mb-4 border border-gray-300 rounded">
            
            <label for="gender" class="block text-gray-700">Gender:</label>
            <select id="gender" name="gender" class="w-full p-2 mb-4 border border-gray-300 rounded" required>
                <option value="M">Male</option>
                <option value="F">Female</option>
                <option value="Other">Other</option>
            </select>
            
            <label for="course_type" class="block text-gray-700">Course Type:</label>
            <select id="course_type" name="course_type" class="w-full p-2 mb-4 border border-gray-300 rounded" required>
                <option value="UG">Undergraduate</option>
                <option value="PG">Postgraduate</option>
            </select>
            
            <label for="cpi" class="block text-gray-700">CPI:</label>
            <input type="number" step="0.01" id="cpi" name="cpi" class="w-full p-2 mb-4 border border-gray-300 rounded" required>
            
            <label for="branch" class="block text-gray-700">Branch:</label>
            <input type="text" id="branch" name="branch" class="w-full p-2 mb-4 border border-gray-300 rounded" required>
            
            <input type="submit" value="Register" class="w-full p-2 bg-green-500 text-white rounded hover:bg-green-600">
        </form>
    </div>
</body>
</html>
