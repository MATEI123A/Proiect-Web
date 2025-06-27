<?php
function users(){
    $servername = "localhost";
    $username = "root";
    $password = "";     
    $dbname = "utilizator";

    $conn = mysqli_connect($servername, $username, $password,$dbname);
    if (!$conn) 
        die("Connection error: " . mysqli_connect_error());

    $sql = "SELECT username from user WHERE BINARY username NOT LIKE 'Admin'";
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
