<?php
$servername = "localhost";
$username = "root";
$password = "";     
$dbname = "utilizator";

$conn = mysqli_connect($servername, $username, $password,$dbname);
if (!$conn) 
    die("Connection error: " . mysqli_connect_error());

$sql = "SELECT username,email FROM user WHERE status = 1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $user = $row['username'];
    $email = $row['email'];
}

$sql = "SELECT total_points FROM user_points WHERE BINARY username = ?";
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
