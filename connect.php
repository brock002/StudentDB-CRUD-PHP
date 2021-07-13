<?php 

$conn = new mysqli("localhost", "root", "", "student_management");
if ($conn -> connect_errno) {
    echo "Failed to connect to database" . $conn->connect_errno;
}

?>
