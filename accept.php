
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placement Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .message {
            font-size: 18px;
            color: #333;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="message">
            <?php
            // Database connection
            $servername = "localhost:3307";
            $username = "root";
            $password = "physicsW21";
            $dbname = "placement";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("<span class='error'>Connection failed: " . $conn->connect_error . "</span>");
            }

            // Check if student_id and company_id are passed in the URL
            if (isset($_GET['student_id']) && isset($_GET['company_id'])) {
                $student_id = $_GET['student_id'];
                $company_id = $_GET['company_id'];

                // Current date
                $current_date = date('Y-m-d');

                // Insert into hired_by (or whatever table you are inserting to)
                $sql = "INSERT INTO hired_by (student_id, company_id, date_of_joining) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iis", $student_id, $company_id, $current_date);

                if ($stmt->execute()) {
                    echo "<span class='success'>Successfully acepted </span><br>";

                    // Now delete the corresponding record from the applications table
                    $delete_sql = "DELETE FROM applications WHERE student_id = ? AND company_id = ?";
                    $delete_stmt = $conn->prepare($delete_sql);
                    $delete_stmt->bind_param("ii", $student_id, $company_id);

                    if ($delete_stmt->execute()) {
                        // echo "<span class='success'>Application successfully removed for student_id $student_id and company_id $company_id.</span>";
                    } else {
                        echo "<span class='error'>Error deleting application: " . $delete_stmt->error . "</span>";
                    }

                    $delete_stmt->close();
                } else {
                    echo "<span class='error'>Error inserting into hired_by table: " . $stmt->error . "</span>";
                }

                $stmt->close();
            } else {
                echo "<span class='error'>Error: Missing student_id or company_id in URL parameters.</span>";
            }

            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>