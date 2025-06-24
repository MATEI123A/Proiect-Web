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
$user=$_COOKIE["username"];
        
$stmt = $conn->prepare("DELETE FROM user_points WHERE username = ?");
$stmt->bind_param("s",$user);
$stmt->execute();
$stmt->close();

$stmt = $conn->prepare("DELETE FROM details WHERE username = ?");
$stmt->bind_param("s",$user);
$stmt->execute();
$stmt->close();      

$stmt = $conn->prepare("DELETE FROM user WHERE username = ?");
$stmt->bind_param("s",$user);
$stmt->execute();
$stmt->close();

header("Location: ../View/PHP/admin.php");
exit;

mysqli_close($conn);
?>
