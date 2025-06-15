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

if (isset($_POST['gender'],$_POST['height'],$_POST['weight'],$_POST['health'],$_POST['date'])) {
    $gender = trim($_POST['gender']);
    $height = (int)$_POST['height'];
    $weight = (int)$_POST['weight'];
    $health = trim($_POST['health']);
    $date = trim($_POST['date']);

    $today = date("Y-m-d");
    $diff = date_diff(date_create($date), date_create($today));

    if($diff->format('%y')<14){
         header("Location: ../View/mainpage.php?status=underage");
         exit;
    }

    if($height<160){
         header("Location: ../View/mainpage.php?status=underheight");
         exit;
    }

    if($height>=160 && $height<=170)
    {
        if(($weight>=0 && $weight<=45) || $weight>110){
            header("Location: ../View/mainpage.php?status=weightproblem");
            exit;
        }
    } else if($height>=170 && $height<=180)
            {   
                if(($weight>=0 && $weight<=50) || $weight>120){
                    header("Location: ../View/mainpage.php?status=weightproblem");
                    exit;
                }
            } else if($height>=180 && $height<=190)
                    {   
                        if(($weight>=0 && $weight<=65) || $weight>140){
                            header("Location: ../View/mainpage.php?status=weightproblem");
                            exit;
                        }
                    } else if($height>=190 && $height<=200)
                            {   
                                if(($weight>=0 && $weight<=70) || $weight>160){
                                    header("Location: ../View/mainpage.php?status=weightproblem");
                                    exit;
                                }
                            }

        $sql = "SELECT username FROM user WHERE status = 1";
        $result = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($result)) 
            $user = $row['username'];
        
        $stmt = $conn->prepare("UPDATE details SET gender = ?, height = ?, weight = ?, health = ?, birthday = ?
            WHERE username = ?");
        $stmt->bind_param("siisss", $gender, $height, $weight,$health,$date,$user);
        $stmt->execute();
        $stmt->close();

        $sql = "SELECT username,email FROM user WHERE status = 1";
        $result = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($result)) {
            $user = $row['username'];
            $email= $row['email'];
        }
        
        if($user=="Admin" && $email=="admin@yahoo.com"){
            header("Location: ../View/admin.php");
            exit;
        }

        header("Location: ../View/page.php");
        exit;
}

mysqli_close($conn);
?>
