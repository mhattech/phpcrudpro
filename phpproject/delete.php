<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php_project";
  



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
// sql to delete a record
$sql = "DELETE  FROM student_table WHERE reg_id=" . $_GET['reg_id'];
if ($conn->query($sql) === TRUE) {
  header('location: user.php');
} else {
  echo "Error deleting record:" . $conn->error;
}
header("location: user.php");
exit;
}
$conn->close();
?>