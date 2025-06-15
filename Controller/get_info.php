<?php
$servername = "localhost";
$username = "root";
$password = "";     
$dbname = "utilizator";

$conn = mysqli_connect($servername, $username, $password);
if (!$conn) 
    die("Connection error: " . mysqli_connect_error());

$sql = "CREATE DATABASE IF NOT EXISTS utilizator";
mysqli_query($conn, $sql);

mysqli_select_db($conn, $dbname); 

$sql = "SELECT username,email FROM user WHERE status = 1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $user = $row['username'];
    $email = $row['email'];
}

$sql = "SELECT total_points FROM user_points WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) 
    $points = $row['total_points'];
    
$data = array(
    "username"=>$user, 
    "email"=>$email, 
    "points"=>$points);

echo json_encode($data);
$conn->close();
?>
