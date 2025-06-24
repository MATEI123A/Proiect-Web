<?php
header('Content-Type: application/rss+xml; charset=utf-8');

$servername = "localhost";
$username = "root";
$password = "";
$database_name = "utilizator";

$conn = mysqli_connect($servername,$username,$password);

if(! $conn)
    die("Connection error" . mysqli_connect_error);

mysqli_select_db($conn,$database_name);

$sql = "SELECT username FROM user WHERE status = 1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc())
    $user = $row['username'];

$sql = "SELECT count,total_points FROM user_points WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s",$user);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()){
    $count = $row['count'];
    $total_points = $row['total_points'];
}
?>

<rss version="2.0">
  <channel>
    <title>User stats - <?php echo $user; ?></title>
    <link>http://localhost/myproject/View/PHP/page.php</link>
    <description>Stats for <?php echo $username; ?></description>
 
    <item>
      <title>Total exercices <?php echo $count; ?></title>
      <description>You did <?php echo $count; ?></description>
    </item>

    <item>
      <title>Total points gained: <?php echo $total_points; ?></title>
      <description>All points: <?php echo $total_points; ?></description>
    </item>
  </channel>
</rss>
