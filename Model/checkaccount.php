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

if (isset($_POST['username'], $_POST['password'])) {

    $user = trim($_POST['username']);
    $password = trim($_POST['password']);
    $status = 1;

    $check_data = $conn->prepare("SELECT password FROM user WHERE username = ?");
    $check_data->bind_param("s", $user);
    $check_data->execute();
    $result_data = $check_data->get_result();

    if ($result_data->num_rows == 1) {
        $row = $result_data->fetch_assoc();
        $hashed_password = $row['password'];

        if (password_verify($password, $hashed_password)) {

            $stmt = $conn->prepare("UPDATE user SET status = ? WHERE username = ?");
            $stmt->bind_param("is", $status, $user);
            $stmt->execute();
            setcookie("username",$user,time()+(86400*30),"/");

            if ($user == "Admin") {
                header("Location: ../View/HTML/admin.html");
                exit;
            } else {
                header("Location: ../View/HTML/page.html");
                exit;
            }

        } else {
            header("Location: ../View/PHP/mainpage.php?status=inccorect");
            exit;
        }
    } else {
        header("Location: ../View/PHP/mainpage.php?status=inccorect");
        exit;
    }
}

mysqli_close($conn);
?>
