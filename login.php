<?php 

$host="localhost";
$user="root";
$password="";
$dbname="viims";

session_start();

$conn = mysqli_connect($host,$user,$password,$dbname);

if ($conn === false) {
    die ("Connection Failed");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $email = $_POST['email_address'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email_address = '$email' AND password = '$password'";

    $result=mysqli_query($conn,$sql);

    $row = mysqli_fetch_array($result);

    if ($row["user_type"] == "user") {
        $_SESSION["email_address"] = $email;
        header("location:dashboarduser.php");
    } 
    elseif ($row["user_type"] == "admin") {
        $_SESSION["email_address"] = $email;
        header("location:dashboardadmin.php");
    } 
    else {
        header("location:login.php");
    }
}


?>