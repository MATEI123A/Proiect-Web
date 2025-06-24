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

if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
    $user = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $status = 1;

    $check_user = $conn->prepare("SELECT username FROM user WHERE username = ?");
    $check_user->bind_param("s", $user);
    $check_user->execute();
    $check_user->store_result();
   
    $check_email = $conn->prepare("SELECT email FROM user WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $check_email->store_result();

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if ($check_user->num_rows == 0 && $check_email->num_rows == 0) {
        $stmt = $conn->prepare("INSERT INTO user (username, email, password, status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $user, $email, $hashed_password, $status);
        $stmt->execute();
        $stmt->close();
        $check_user->close();
        $check_email->close(); 

        setcookie("username",$user,time()+(86400*30),"/");

        $height=0;
        $weight=0;
        $birthday="";
        $gender="";
        $health="";
        $birthday="";
        $preferences="";

        $stmt = $conn->prepare("INSERT INTO details (username,height,weight,gender,health,preferences,birthday)
                                VALUES (?,?,?, ?, ?, ?,?)");
        $stmt->bind_param("siissss", $user, $height, $weight,$gender,$health,$preferences,$birthday);
        $stmt->execute();
        $stmt->close();

        $total_points=0;
        $abs_points=0;
        $legs_points=0;
        $push_points=0;
        $pull_points=0;
        $count=0;

        $stmt = $conn->prepare("INSERT INTO user_points (username,total_points,abs_points,legs_points,push_points,pull_points,count)
                                VALUES (?,?,?, ?, ?, ?,?)");
        $stmt->bind_param("siiiiii", $user,$total_points,$abs_points,$legs_points,$push_points,$pull_points,$count);
        $stmt->execute();
        $stmt->close();

        header("Location: ../View/PHP/mainpage.php?status=valid");
     
    } else header("Location: ../View/PHP/mainpage.php?status=invalid");
}

mysqli_close($conn);
?>
