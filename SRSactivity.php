<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "srs";

$connection = mysqli_connect(hostname: $server, username: $username, password: $password, database: $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
echo "Connected Successfully";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $StudentID = $_POST["StudentID"];
    $FirstName = $_POST["FirstName"];
    $MiddleInitial = $_POST["MiddleInitial"];
    $LastName = $_POST["LastName"];
    $DateOfBirth = $_POST["DateOfBirth"];
    $Gender = $_POST["Gender"];
    $EmailAddress = $_POST["EmailAddress"];
    $PhoneNumber = $_POST["PhoneNumber"];

    // Insert data into database
    $sql = "INSERT INTO basic_information (StudentID, FirstName, MiddleInitial, LastName, DateOfBirth, Gender, EmailAddress, PhoneNumber) 
            VALUES ('$StudentID', '$FirstName', '$MiddleInitial', '$LastName', '$DateOfBirth', '$Gender', '$EmailAddress', '$PhoneNumber')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:green;'>New record added successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
    }
}

$connection->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Form</title>
</head>
<body>

<h2>Student Registration System</h2>
<form method="POST" action="">

    <label for="StudentID">Student ID:</label>
    <input type="text" name="StudentID" required><br><br>

    <label for="FirstName">First Name:</label>
    <input type="text" name="FirstName" required><br><br>

    <label for="MiddleInitial">Middle Initial (M.I):</label>
    <input type="text" name="MiddleInitial" maxlength="5"><br><br>

    <label for="LastName">Last Name:</label>
    <input type="text" name="LastName" required><br><br>

    <label for="DateOfBirth">Date of Birth:</label>
    <input type="text" name="DateOfBirth" required><br><br>

    <label for="Gender">Gender:</label>
    <select name="Gender" required>
        <option value="">Select Gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select><br><br>

    <label for="EmailAddress">Email Address:</label>
    <input type="text" name="EmailAddress" required><br><br>

    <label for="PhoneNumber">Phone NUmber:</label>
    <input type="email" name="PhoneNumber" required><br><br>

    <input type="submit" value="Submit">
</form>

</body>
</html>