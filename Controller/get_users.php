<?php
function users(){
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

    $sql = "SELECT username from user WHERE username NOT LIKE 'Admin'";
    $result = $conn->query($sql);
    $users=[];

    if ($result->num_rows > 0) 
        while ($row = $result->fetch_assoc()) {
            $users[]=$row['username'];   
        }
            
    $conn->close();
    echo json_encode($users);
}

users(); 
?>
