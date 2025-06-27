<?php
$servername = "localhost";
$username = "root";
$password = "";     
$dbname = "utilizator";

$conn = mysqli_connect($servername, $username, $password,$dbname);
if (!$conn) 
    die("Connection error: " . mysqli_connect_error());

$user=$_COOKIE["username"];

if (isset($_POST['height'],$_POST['weight'],$_POST['preference'])) {
    $height = (int)$_POST['height'];
    $weight = (int)$_POST['weight'];
    $preference = trim($_POST['preference']);
  
    if($height<160){
         header("Location: ../View/HTML/admin.html?status=underheight");
         exit;
    }

    if($height>=160 && $height<=170)
    {
        if(($weight>=0 && $weight<=45) || $weight>110){
            header("Location: ../View/HTML/admin.html?status=weightproblem");
            exit;
        }
    } else if($height>=170 && $height<=180)
            {   
                if(($weight>=0 && $weight<=50) || $weight>120){
                    header("Location: ../View/HTML/admin.html?status=weightproblem");
                    exit;
                }
            } else if($height>=180 && $height<=190)
                    {   
                        if(($weight>=0 && $weight<=65) || $weight>140){
                            header("Location: ../View/HTML/admin.html?status=weightproblem");
                            exit;
                        }
                    } else if($height>=190 && $height<=200)
                            {   
                                if(($weight>=0 && $weight<=70) || $weight>160){
                                    header("Location: ../View/HTML/admin.html?status=weightproblem");
                                    exit;
                                }
                            }

        $stmt = $conn->prepare("UPDATE details SET height = ?, weight = ?, preferences = ? WHERE BINARY username = ?");
        $stmt->bind_param("iiss",$height, $weight,$preference,$user);
        $stmt->execute();
        $stmt->close();

        header("Location: ../View/HTML/admin.html");
        exit;
}

mysqli_close($conn);
?>
