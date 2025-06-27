<?php
$servername = "localhost";
$username = "root";
$password = "";     
$dbname = "utilizator";

$conn = mysqli_connect($servername, $username, $password,$dbname);
if (!$conn) 
    die("Connection error: " . mysqli_connect_error());

$user=$_COOKIE["username"];

$sql = "SELECT username,email FROM user WHERE username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()){
    $user = $row['username'];
    $email = $row['email'];
}

$sql = "SELECT weight,height FROM details WHERE BINARY username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()){
    $weight = $row['weight'];
    $height = $row['height'];
}

$data = array(
    "username"=>$user,
    "email"=>$email,
    "weight"=>$weight, 
    "height"=>$height
    );

echo json_encode($data);
$conn->close();

?>
