<?php
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = 1; // Replace with session or logged-in student ID
    $job_id = $_POST['job_id'];

    // Insert the application into the Applications table
    $query = "INSERT INTO Applications (student_id, job_id, application_date) VALUES ('$student_id', '$job_id', now())";
    if (mysqli_query($conn, $query)) {
        echo "Application submitted successfully!";
        header('Location: student_dashboard.php'); // Redirect back to the student dashboard
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
