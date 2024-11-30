<?php
// Start the session to access session variables
session_start();

// Check if the student is logged in (i.e., if student_id exists in the session)


// Get the logged-in student's ID from the session
$student_id = $_SESSION['user_id'];

// Include database connection
include 'db_config.php';

// Query to get the student's details: CPI, course type, and branch
$query = "SELECT name, email, cpi, course_type, branch FROM students WHERE student_id = $student_id";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    die('Error in query: ' . mysqli_error($conn));
}

$student = mysqli_fetch_assoc($result);

// If no student data is found, handle error (e.g., session expired)
if (!$student) {
    echo "Student not found. Please log in again.";
    exit();
}

// Extract student details
$cpi = $student['cpi'];
$course_type = $student['course_type'];
$branch = $student['branch'];

// Query for full-time jobs eligible for this student
$query_full_time = "
    SELECT eligibility_id, title, branch, cpi_cutoff
    FROM eligible_for 
    WHERE course_type = '$course_type'
    AND branch = '$branch'
    AND cpi_cutoff <= $cpi";
$result_full_time = mysqli_query($conn, $query_full_time);
$full_time_jobs = mysqli_fetch_all($result_full_time, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="studstyles.css">
</head>
<body>
    <div class="dashboard-container">
        <header class="header">
            <h1>Welcome, <?php echo $student['name']; ?></h1>
            <p>Your Roll No: 1234567890</p>
        </header>

        <div class="dashboard-content">
            <section class="profile">
                <h2>Profile</h2>
                <div class="profile-details">
                    <p><strong>Name:</strong> <?php echo $student['name']; ?></p>
                    <p><strong>Email:</strong> <?php echo $student['email']; ?></p>
                    <p><strong>CPI:</strong> <?php echo $student['cpi']; ?></p>
                    <p><strong>Course Type:</strong> <?php echo $student['course_type']; ?></p>
                    <p><strong>Branch:</strong> <?php echo $student['branch']; ?></p>
                </div>
            </section>

            <section class="job-application">
                <h2>Full-Time Jobs Available for You</h2>
                <div class="job-list">
                    <?php
                    if (count($full_time_jobs) > 0) {
                        foreach ($full_time_jobs as $job) {
                            echo '
                            <div class="job-card">
                                <h3>' . $job['title'] . '</h3>
                                <p><strong>Branch:</strong> ' . $job['branch'] . '</p>
                                <p><strong>CPI Cutoff:</strong> ' . $job['cpi_cutoff'] . '</p>
                                <form action="apply.php" method="POST">
                                    <input type="hidden" name="job_id" value="' . $job['eligibility_id'] . '">
                                    <button type="submit" class="apply-btn">Apply Now</button>
                                </form>
                            </div>';
                        }
                    } else {
                        echo "<p>No full-time jobs available based on your criteria.</p>";
                    }
                    ?>
                </div>

                <h2>Internship Jobs Available for You</h2>
                <div class="job-list">
                    
                </div>
            </section>
        </div>

        <footer class="footer">
            <p>&copy; 2024 Student Placement Portal. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
