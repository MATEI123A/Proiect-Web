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

if (isset($_POST['username'],$_POST['password'])) {

    $user = trim($_POST['username']);
    $password = trim($_POST['password']);
    $status=1;

    $check_data=$conn->prepare("SELECT username,password FROM user WHERE username = ? AND password = ?");
    $check_data->bind_param("ss", $user,$password);
    $check_data->execute();
  
    $result_data=$check_data->get_result();
    
    if($result_data->num_rows==1)
    {
        $stmt=$conn->prepare("UPDATE user SET status = ? WHERE username = ? AND password = ?");
        $stmt->bind_param("iss",$status,$user,$password);
        $stmt->execute();

        if($user=="Admin"){
            header("Location:../View/admin.php");
            exit;
        } else {
             header("Location:../View/page.php");
             exit;
        }
    } else
       header("Location:../View/mainpage.php?status=inccorect");
    
} 

mysqli_close($conn);
?>
