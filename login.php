<?php 
$servername = "35.200.229.38";
$username = "root";
$password = "@techadmin123";
$dbname = "exchange4media";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$query = mysqli_query ($conn,"SELECT * FROM article ORDER BY article_id DESC limit");
$rows =  mysqli_fetch_array ($query);
  foreach($rows as $row) {
   echo $row['article_id'];die;
      
} 
?>