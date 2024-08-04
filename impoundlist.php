add-vehicle.php
<?php

$conn = mysqli_connect('localhost', 'root', '', 'impound_system');

if ($conn->connect_error) {
    die("Error: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vtype = $_POST['vehicle_type'];
    $vpic = $_FILES['vehicle_photo'];
    $plate = $_POST['plate_number'];
    $vpenalty = $_POST['vehicle_penalty'];
    $vfee = $_POST['vehicle_fees'];
    $date = $_POST['date_impounded'];
    $time = $_POST['time_impounded'];

    $target_dir = "vehicle_pics/";
    $target_file = $target_dir . basename($vpic["name"]);

    // Ensure the directory exists or create it
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if (move_uploaded_file($vpic["tmp_name"], $target_file)) {
        $stmt = $conn->prepare("INSERT INTO impounded_vehicles (vehicle_type, vehicle_photo, plate_number, vehicle_penalty, vehicle_fees, date_impounded, time_impounded) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $vtype, $target_file, $plate, $vpenalty, $vfee, $date, $time);
        
        if ($stmt->execute()) {
            include 'view-vehicle.php' ;
        } else {
            echo "Unable to add user: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$conn->close();

?>