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

if (isset($_POST['height'],$_POST['weight'],$_POST['health'],$_POST['preference'])) {
    $height = (int)$_POST['height'];
    $weight = (int)$_POST['weight'];
    $health = trim($_POST['health']);
    $preference = trim($_POST['preference']);

    if($height<160){
         header("Location: ../View/HTML/page.html?status=underheight");
         exit;
    }

    if($height>=160 && $height<=170)
    {
        if(($weight>=0 && $weight<=45) || $weight>110){
            header("Location: ../View/HTML/page.html?status=weightproblem");
            exit;
        }
    } else if($height>=170 && $height<=180)
            {   
                if(($weight>=0 && $weight<=50) || $weight>120){
                    header("Location: ../View/HTML/page.html?status=weightproblem");
                    exit;
                }
            } else if($height>=180 && $height<=190)
                    {   
                        if(($weight>=0 && $weight<=65) || $weight>140){
                            header("Location: ../View/HTML/page.html?status=weightproblem");
                            exit;
                        }
                    } else if($height>=190 && $height<=200)
                            {   
                                if(($weight>=0 && $weight<=70) || $weight>160){
                                    header("Location: ../View/HTML/page.html?status=weightproblem");
                                    exit;
                                }
                            }

        $sql = "SELECT username FROM user WHERE status = 1";
        $result = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($result)) 
            $user = $row['username'];
        
        $stmt = $conn->prepare("UPDATE details SET height = ?, weight = ?, health = ?,preferences = ?
            WHERE username = ?");
        $stmt->bind_param("iisss",$height, $weight,$health,$preference,$user);
        $stmt->execute();
        $stmt->close();

        if($user=="Admin"){
            header("Location: ../View/HTML/admin.html");
            exit;
        }
      
    header("Location: ../View/HTML/page.html");
    exit;
}

mysqli_close($conn);
?>
