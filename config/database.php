<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "utilizator";

$conn = mysqli_connect($servername, $username, $password);
if ($conn->connect_error) 
    die("Connection error: " . mysqli_connect_error());

$sql = "CREATE DATABASE IF NOT EXISTS utilizator";
if ($conn->query($sql) === true) 
    echo "Database utilizator created succesfully";
 else 
    echo "Error creating database utilizator: " . mysqli_error($conn);

mysqli_select_db($conn, $dbname);

$table1 = "CREATE TABLE IF NOT EXISTS user (
    username VARCHAR(50) NOT NULL,
    email VARCHAR(40) NOT NULL,
    password VARCHAR(30) NOT NULL,
    status Integer
)";

if ($conn->query($table1) === true) 
    echo "Table user created succesfully";
 else 
    echo "Error creating table user" . mysqli_error($conn);

$table2 = "CREATE TABLE IF NOT EXISTS details (
    username VARCHAR(50) NOT NULL,
    height Integer,
    weight Integer,
    birthday DATE,
    gender VARCHAR(10),
    health VARCHAR(40),
    preferences VARCHAR(30) 
)";

if ($conn->query($table2) === true) 
    echo "Table details created succesfully";
 else 
    echo "Error creating table details " . mysqli_error($conn);

$table3 = "CREATE TABLE IF NOT EXISTS user_points (
    username VARCHAR(50) NOT NULL,
    total_points Integer,
    abs_points Integer,
    legs_points Integer,
    push_points Integer,
    pull_points Integer
)";

if ($conn->query($table3) === true) 
    echo "Table user_points created succesfully";
 else 
    echo "Error creating table user_points " . mysqli_error($conn);

mysqli_close($conn);
?>
