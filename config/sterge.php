<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "utilizator"; 

$conn = mysqli_connect($servername, $username, $password);
if (!$conn) {
    die("Conexiunea a picat: " . mysqli_connect_error());
}

$sql = "DROP DATABASE IF EXISTS $database";
setcookie("username","",time()-3600);

if (mysqli_query($conn, $sql)) {
    echo "Baza de date '$database' a fost stearsa";
} else {
    echo "Eroare la stergerea bazei de date: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
