<?php
$servername = "localhost";
$username = "root";
$password = "";     
$dbname = "utilizator";

$conn = mysqli_connect($servername, $username, $password,$dbname);
if (!$conn) 
    die("Connection error: " . mysqli_connect_error());

$sql = "SELECT username FROM user WHERE status=1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc())
    $user = $row['username'];
   
$sql = "SELECT health,preferences FROM details WHERE BINARY username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()){
    $health = $row['health'];
    $preference = $row['preferences'];
}

$path = '../data/exercices.json';
$jsonString = file_get_contents($path);
$data = json_decode($jsonString, true);

$group = $_COOKIE["group"];
$exercises = $data[$health][$preference][$group];
    
$exerciseList = [];
foreach ($exercises as $exercise) {
    $exerciseList[] = [
        'name' => $exercise['name'],
        'link' => $exercise['link'],
        'description' => $exercise['description']
    ];
}

echo json_encode($exerciseList, JSON_PRETTY_PRINT);

$conn->close();

?>
