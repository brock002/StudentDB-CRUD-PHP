<?php include "header.php" ?>

<?php
    $roll=$_GET['roll'];
    $query = "SELECT * FROM Student WHERE student_id = '$roll'";
    $res = mysqli_query($conn, $query);
    foreach ($res as $s) {
        $name=$s['name'];
    }
?>

<h4 class="new-title-basic-underline mb-3">Update Student Details</h4>
<form action="#" method="POST" class="my-2">
            <label for="name" class="form-label">Update Name:</label> 
    <div class="flexbox">
        <div class="form-group mr-3">
            <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Name" class="form-input">
        </div>
        <button type="submit" name="submit" class="btn btn-success">Save</button>
    </div>
</form>

<?php 
    if (isset($_POST["submit"])) {
        $name = $_POST["name"];

        $query = "UPDATE Student SET name = '$name' WHERE student_id = '$roll'";
        if (mysqli_query($conn, $query)) { 
            header("Location:student.php");
        } else { ?>
            <div class="alert alert-danger flexbox mt-3">
                <?php echo "Something went wrong... Try Again..."; ?>
                <a href="student.php" class="btn btn-info">Go Back to Student Records</a>
            </div>
        <?php }
    }
?>

<?php include "footer.php" ?>
