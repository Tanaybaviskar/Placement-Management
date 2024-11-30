<?php
include 'db_config.php';
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

// SQL query to join two tables and get company_id from the applications table
$sql = "SELECT students.student_id, students.name, students.email, students.roll_no, students.phone_no, students.dob, 
               students.gender, students.course_type, students.cpi, students.branch, applications.company_id 
        FROM students
        JOIN applications ON applications.student_id = students.student_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<div class="applicant-details">
                <div class="detail-row">
                    <span class="label">Student ID:</span><span class="value">' . $row['student_id'] . '</span>
                </div>
                <div class="detail-row">
                    <span class="label">Name:</span><span class="value">' . $row['name'] . '</span>
                </div>
                <div class="detail-row">
                    <span class="label">Email:</span><span class="value">' . $row['email'] . '</span>
                </div>
                <div class="detail-row">
                    <span class="label">Roll No:</span><span class="value">' . $row['roll_no'] . '</span>
                </div>
                <div class="detail-row">
                    <span class="label">Phone No:</span><span class="value">' . $row['phone_no'] . '</span>
                </div>
                <div class="detail-row">
                    <span class="label">Date of Birth:</span><span class="value">' . $row['dob'] . '</span>
                </div>
                <div class="detail-row">
                    <span class="label">Gender:</span><span class="value">' . $row['gender'] . '</span>
                </div>
                <div class="detail-row">
                    <span class="label">Course Type:</span><span class="value">' . $row['course_type'] . '</span>
                </div>
                <div class="detail-row">
                    <span class="label">CPI:</span><span class="value">' . $row['cpi'] . '</span>
                </div>
                <div class="detail-row">
                    <span class="label">Branch:</span><span class="value">' . $row['branch'] . '</span>
                </div>
                <div class="action-buttons">
                    <a href="accept.php?student_id=' . $row['student_id'] . '&company_id=' . $row['company_id'] . '" class="button accept">Accept</a>
                    <a href="reject.php?student_id=' . $row['student_id'] . '&company_id=' . $row['company_id'] . '" class="button reject">Reject</a>
                </div>
            </div>';
    }
} else {
    echo "<p>No results found.</p>";
}

$conn->close();
?>

<!-- External or inline CSS -->
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f7fc;
        color: #333;
        margin: 0;
        padding: 0;
    }

    .applicant-details {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin: 20px auto;
        max-width: 800px;
        padding: 20px;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }

    .label {
        font-weight: bold;
        color: #444;
    }

    .value {
        color: #555;
    }

    .action-buttons {
        text-align: center;
        margin-top: 20px;
    }

    .button {
        padding: 10px 20px;
        margin: 10px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        color: #fff;
    }

    .accept {
        background-color: #4CAF50;
    }

    .accept:hover {
        background-color: #45a049;
    }

    .reject {
        background-color: #f44336;
    }

    .reject:hover {
        background-color: #e53935;
    }

    /* Responsive styling */
    @media (max-width: 768px) {
        .applicant-details {
            padding: 15px;
        }

        .detail-row {
            flex-direction: column;
            align-items: flex-start;
        }

        .label {
            font-size: 14px;
        }

        .value {
            font-size: 14px;
        }

        .action-buttons {
            margin-top: 15px;
        }
    }
</style>
