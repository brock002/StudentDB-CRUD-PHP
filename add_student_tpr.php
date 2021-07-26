<?php include "header.php" ?>

<?php
    $roll = $_GET['roll'];
    $branch = substr($roll, 0, 6);
    $admission_year = substr($roll, 6, 4);
    $query = "SELECT roll_no, name FROM Student 
                WHERE SUBSTRING(roll_no, 1, 6)='$branch' 
                AND admission_year='$admission_year'
                AND roll_no!='$roll'
                AND tpr IS NULL";
    $res = mysqli_query($conn, $query);
?>

<h5 class="new-title-basic-underline mb-3">Select/Update TPR</h5>
<form action="#" method="post">
    <div class="flexbox my-2">
        <select name="tpr">
            <option value="null" selected> -- Select this option to make this student a TPR -- </option>
            <?php
                if (mysqli_num_rows($res)==0) {
                ?>
                    <option disabled value> -- No other student available to show -- </option>
                <?php
                } else {
                    foreach ($res as $student) {
                ?>
                            <option value="<?php echo $student['roll_no'] ?>"><?php echo $student['name']?></option>
                <?php
                    }
                }
            ?>
        </select>
        <input type="submit" name="tpr" value="Submit" class="btn new-btn ms-3">
    </div>
</form>
<a href="student.php" class="btn btn-sm btn-outline-info">Go to Students List</a>
<?php
    if (isset($_POST['tpr'])) {
        $tpr = $_POST['tpr'];
        if ($tpr=="null") {
            $query = "UPDATE Student SET tpr = NULL WHERE roll_no = '$roll'";
        } else {
            $query = "UPDATE Student SET tpr = '$tpr' WHERE roll_no = '$roll'";
        }
        if (mysqli_query($conn, $query)) {
            header("Location:student.php");
        } else {
            echo "<h2>ERROR!!!</h2>";
        }
    }
?>

<?php include "footer.php" ?>
