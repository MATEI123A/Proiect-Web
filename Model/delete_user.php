<?php
$servername = "localhost";
$username = "root";
$password = "";     
$dbname = "utilizator";

$conn = mysqli_connect($servername, $username, $password,$dbname);
if (!$conn) 
    die("Connection error: " . mysqli_connect_error());

$user=$_COOKIE["username"];
        
$stmt = $conn->prepare("DELETE FROM user_points WHERE BINARY username = ?");
$stmt->bind_param("s",$user);
$stmt->execute();
$stmt->close();

$stmt = $conn->prepare("DELETE FROM details WHERE BINARY username = ?");
$stmt->bind_param("s",$user);
$stmt->execute();
$stmt->close();      

$stmt = $conn->prepare("DELETE FROM user WHERE BINARY username = ?");
$stmt->bind_param("s",$user);
$stmt->execute();
$stmt->close();

header("Location: ../View/PHP/admin.php");
exit;

mysqli_close($conn);
?>
