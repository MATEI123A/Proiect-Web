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

unset($_COOKIE['username']);
setcookie("username","",time()-3600,"/");

if ($row = $result->fetch_assoc()) 
    $user = $row['username'];

$sql = "UPDATE user SET status = 0 WHERE BINARY username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$conn->close();
header("Location: ../View/PHP/mainpage.php");
exit;
?>
