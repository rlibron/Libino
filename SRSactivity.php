<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "srs";

$connection = new mysqli($server, $username, $password, $database);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentID = $_POST["StudentID"];
    $firstName = $_POST["FirstName"];
    $middleInitial = $_POST["MiddleInitial"];
    $lastName = $_POST["LastName"];
    $dateOfBirth = $_POST["DateOfBirth"];
    $gender = $_POST["Gender"];
    $emailAddress = $_POST["EmailAddress"];
    $phoneNumber = trim($_POST["PhoneNumber"]); // Trim whitespace

    // Validate phone number (must be 11 digits)
    if (!preg_match('/^[0-9]{11}$/', $phoneNumber)) {
        die("<p style='color:red;'>Invalid phone number! Must be exactly 11 digits.</p>");
    }

    $stmt = $connection->prepare("INSERT INTO basic_information (StudentID, FirstName, MiddleInitial, LastName, DateOfBirth, Gender, EmailAddress, PhoneNumber) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $studentID, $firstName, $middleInitial, $lastName, $dateOfBirth, $gender, $emailAddress, $phoneNumber);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>New record added successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

// Fetch student data
$result = $connection->query("SELECT * FROM basic_information");
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration System</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
    </style>
</head>
<body>

<h2>Student Registration System</h2>
<form method="POST" action="">
    <label>Student ID: <input type="text" name="StudentID" required></label><br><br>
    <label>First Name: <input type="text" name="FirstName" required></label><br><br>
    <label>Middle Initial: <input type="text" name="MiddleInitial" maxlength="5"></label><br><br>
    <label>Last Name: <input type="text" name="LastName" required></label><br><br>
    <label>Date of Birth: <input type="date" name="DateOfBirth" required></label><br><br>
    <label>Gender: <select name="Gender" required>
        <option value="">Select Gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select></label><br><br>
    <label>Email Address: <input type="email" name="EmailAddress" required></label><br><br>
    <label>Phone Number: <input type="tel" name="PhoneNumber" pattern="[0-9]{11}" maxlength="11" title="Please enter a valid 11-digit phone number" required></label><br><br>
    <input type="submit" value="Submit">
</form>

<table border="1">
    <tr>
        <th>Student ID</th>
        <th>Last Name</th>
        <th>First Name</th>
        <th>Middle Initial</th>
        <th>Date of Birth</th>
        <th>Gender</th>
        <th>Email Address</th>
        <th>Phone Number</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['StudentID']) ?></td>
        <td><?= htmlspecialchars($row['LastName']) ?></td>
        <td><?= htmlspecialchars($row['FirstName']) ?></td>
        <td><?= htmlspecialchars($row['MiddleInitial']) ?></td>
        <td><?= htmlspecialchars($row['DateOfBirth']) ?></td>
        <td><?= htmlspecialchars($row['Gender']) ?></td>
        <td><?= htmlspecialchars($row['EmailAddress']) ?></td>
        <td><?= htmlspecialchars($row['PhoneNumber']) ?></td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
