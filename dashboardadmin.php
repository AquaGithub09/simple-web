<?php 

session_start();

require_once 'auth_admin.php';

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "viims";


$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection Error: " . $conn->connect_error);
}


$email = $_SESSION['email_address'] ?? '';

$sql = "SELECT fullname FROM users WHERE email_address = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param('s', $email);

$stmt->execute();

$result = $stmt->get_result();
$fullname = '';

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fullname = $row['fullname'];
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="admin-style.css">
    <title>Admin Dashboard</title>
</head>
<body>
<center><h1 id="header">Admin Dashboard</h1></center>
    <div class="container">
        <div class="navbar">
            <li><a href="dashboardadmin.php">Home</a></li>
            <li><a href="vehicle-list.php">Impound List</a></li>
            <li><a href="">Reports</a></li>
            <li><a href="logout.php">Logout</a></li>
        </div>

        <h3> Welcome, </h3>
        <h1 class="greet"> ADMIN <?php echo htmlspecialchars($fullname); ?>
    </div>


</body>
</html>
