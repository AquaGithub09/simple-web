<?php 

$host="localhost";
$user="root";
$password="";
$dbname="viims";

$conn = mysqli_connect($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection Error: " . $conn->connect_error);
}

$sql = "SELECT * FROM vehicle_list";

$result = $conn->query($sql);


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="vehicle-list.css">
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
        <div class="overflow-table">
        <?php 
        if ($result->num_rows > 0) {
	    	echo '<table class="cinereousTable">
	        <thead>
	            <tr style="text-align: center;">
	                <th>VEHICLE TYPE</th>
	                <th>VEHICLE PHOTO</th>
	                <th>PLATE NUMBER</th>
	                <th>VIOLATIONS</th>
	                <th>FEES</th>
	                <th>IMPOUND DATE</th>
	                <th>TIME</th>
	                <th>OWNER</th>
	            </tr>
	        </thead>';
    	while ($row = mysqli_fetch_assoc($result)) {
        $formatted_date = date('m/d/y', strtotime($row['date_impound']));
        $formatted_time = date('H:i', strtotime($row['time_impound']));

			        echo '<tr>';
			        echo '<td>' . $row['vehicle_type'] . '</td>';
			        echo '<td><img src="' . $row['vehicle_image'] . '" </td>';
			        echo '<td>' . $row['plate_number'] . '</td>';
			        echo '<td>' . $row['vehicle_violation'] . '</td>';
			        echo '<td>' . $row['violation_fee'] . '</td>';
			        echo '<td>' . $formatted_date . '</td>';
			        echo '<td>' . $formatted_time . '</td>';
			        echo '<td>' . $row['vehicle_owner'] . '</td>';
			        echo '</tr>';
   		};
    	} else {
        			echo "No records found.";
		}
		?>
	</div>
    </div>


</body>
</html>