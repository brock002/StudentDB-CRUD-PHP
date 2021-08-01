<?php include "header.php" ?>

<?php
    $roll = $_GET["roll"];
    $query = "DELETE FROM Student WHERE roll_no = '$roll'";
    mysqli_query($conn, $query);
    $br = $_GET['branch'];
    header("Location:student.php?branch=$br");
?>

<?php include "footer.php" ?>
