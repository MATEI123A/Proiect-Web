<?php
$servername = "localhost";
$username = "root";
$password = "";     
$dbname = "utilizator";

$conn = mysqli_connect($servername, $username, $password,$dbname);
if (!$conn) 
    die("Connection error: " . mysqli_connect_error());

$sql = "SELECT username FROM user WHERE status = 1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) 
    echo json_encode($result->fetch_assoc());
 else 
    echo json_encode(["username" => ""]);

$conn->close();
?>
