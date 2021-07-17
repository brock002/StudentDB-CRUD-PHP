<?php include "header.php" ?>

<?php
    $roll = $_GET["roll"];
    $query = "DELETE FROM Student WHERE student_id = '$roll'";
    mysqli_query($conn, $query);
    header("Location:student.php");
?>

<?php include "footer.php" ?>
