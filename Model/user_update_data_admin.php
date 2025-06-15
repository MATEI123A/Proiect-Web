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

if (isset($_POST['height'],$_POST['weight'])) {
    $height = (int)$_POST['height'];
    $weight = (int)$_POST['weight'];
  
    if($height<160){
         header("Location: ../View/admin.php?status=underheight");
         exit;
    }

    if($height>=160 && $height<=170)
    {
        if(($weight>=0 && $weight<=45) || $weight>110){
            header("Location: ../View/admin.php?status=weightproblem");
            exit;
        }
    } else if($height>=170 && $height<=180)
            {   
                if(($weight>=0 && $weight<=50) || $weight>120){
                    header("Location: ../View/admin.php?status=weightproblem");
                    exit;
                }
            } else if($height>=180 && $height<=190)
                    {   
                        if(($weight>=0 && $weight<=65) || $weight>140){
                            header("Location: ../View/admin.php?status=weightproblem");
                            exit;
                        }
                    } else if($height>=190 && $height<=200)
                            {   
                                if(($weight>=0 && $weight<=70) || $weight>160){
                                    header("Location: ../View/admin.php?status=weightproblem");
                                    exit;
                                }
                            }

        $stmt = $conn->prepare("UPDATE details SET height = ?, weight = ? WHERE username = ?");
        $stmt->bind_param("iis",$height, $weight,$user);
        $stmt->execute();
        $stmt->close();

       
            header("Location: ../View/admin.php");
            exit;
        
}

mysqli_close($conn);
?>
