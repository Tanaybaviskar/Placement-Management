<!DOCTYPE html>
<html>
<head>
    <title>Admin Portal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .header, .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            flex: 1;
        }
        .table-container {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
        }
        th {
            background-color: #4CAF50;
            color: white;
            text-align: left;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #ddd;
        }
        h2 {
            color: #333;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Admin Portal</h1>
</div>

<div class="container">
    <?php
    $servername = "localhost:3307";
    $username = "root";
    $password = "root";
    $dbname = "placement";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to select data from first table
    $sql1 = "SELECT * FROM applications";
    $result1 = $conn->query($sql1);

    echo '<div class="table-container">';
    echo '<h2>Applications</h2>';
    if ($result1->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>ID</th><th>Student ID</th><th>Job ID</th><th>Application Date</th></tr>';
        // Output data of each row from first table
        while($row1 = $result1->fetch_assoc()) {
            echo '<tr><td>' . $row1["id"]. '</td><td>' . $row1["student_id"]. '</td><td>' . $row1["job_id"]. '</td><td>' . $row1["application_date"]. '</td></tr>';
        }
        echo '</table>';
    } else {
        echo "0 results from applications table";
    }
    echo '</div>';

    // SQL query to select data from second table
    $sql2 = "SELECT * FROM statistics";
    $result2 = $conn->query($sql2);

    echo '<div class="table-container">';
    echo '<h2>Statistics</h2>';
    if ($result2->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>ID</th><th>Average Package</th><th>Total Hired</th><th>Total Offers</th><th>Company ID</th></tr>';
        // Output data of each row from second table
        while($row2 = $result2->fetch_assoc()) {
            echo '<tr><td>' . $row2["stats_id"]. '</td><td>' . $row2["avg_package"]. '</td><td>' . $row2["total_hired"]. '</td><td>' . $row2["total_offers"]. '</td><td>' . $row2["company_id"]. '</td></tr>';
        }
        echo '</table>';
    } else {
        echo "0 results from statistics table";
    }
    echo '</div>';

    $conn->close();
    ?>
</div>

<div class="footer">
    <p>&copy; 2023 Admin Portal. All rights reserved.</p>
</div>

</body>
</html>