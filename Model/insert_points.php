<?php

function point(){
    $servername = "localhost";
    $username = "root";
    $password = "";     
    $dbname = "utilizator";

    $conn = mysqli_connect($servername, $username, $password,$dbname);
    if (!$conn) 
        die("Connection error: " . mysqli_connect_error());

    $users=[];

    $sql = "SELECT username FROM user WHERE status=1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc())
        $user=$row['username'];
    
    $group=$_COOKIE["muscle"];

    if($group == "pull"){
        $stmt = $conn->prepare("UPDATE user_points SET total_points = total_points + 10
        , pull_points = pull_points + 10, count = count + 1 WHERE BINARY username = ?");
        $stmt->bind_param("s",$user);
        $stmt->execute();
        $stmt->close();
    }

    if($group == "push"){
        $stmt = $conn->prepare("UPDATE user_points SET total_points = total_points + 10
        , push_points = push_points + 10, count = count + 1 WHERE BINARY username = ?");
        $stmt->bind_param("s",$user);
        $stmt->execute();
        $stmt->close();
    }

    if($group == "legs"){
        $stmt = $conn->prepare("UPDATE user_points SET total_points = total_points + 10
        , legs_points = legs_points + 10, count = count + 1 WHERE BINARY username = ?");
        $stmt->bind_param("s",$user);
        $stmt->execute();
        $stmt->close();
    }

     if($group == "abs"){
        $stmt = $conn->prepare("UPDATE user_points SET total_points = total_points + 10
        , abs_points = abs_points + 10, count = count + 1 WHERE BINARY username = ?");
        $stmt->bind_param("s",$user);
        $stmt->execute();
        $stmt->close();
    }

    $conn->close();
}

point(); 
?>
