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

$sql = "SELECT username FROM user WHERE status = 1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) 
    $user = $row['username'];

$sql = "SELECT weight,height,birthday,gender,health,preferences FROM details WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()){
    $weight = $row['weight'];
    $height = $row['height'];
    $birthday = $row['birthday'];
    $gender = $row['gender'];
    $health = $row['health'];
    $preference = $row['preferences'];
}
    
$data = array(
    "weight"=>$weight, 
    "height"=>$height, 
    "birthday"=>$birthday,
    "gender"=>$gender,
    "health"=>$health,
    "preferences"=>$preference
);

echo json_encode($data);
$conn->close();

?>
