<?php include "header.php" ?>

<!-- getting the branch to be deleted... -->
<?php
    $id = $_GET["id"];
    $query = "SELECT * FROM Branch WHERE branch_id='$id'";
    $res = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($res);
?>
<strong>
    Are you sure You Want to Delete the following Branch? <br>
</strong>
<?php echo $row["branch_id"]." - ".$row['name'] ?>

<br>
<br>

<!-- getting count of students under the selected branch -->
<?php
    $query = "SELECT COUNT(*) AS total_count FROM Student WHERE Student.branch='$id'";
    $res = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($res);
    $total_count = $row['total_count'];
?>

<!-- showing the students that will be deleted -->
<?php   if ($total_count>0) {   ?>
    <strong>It will also delete the following students:</strong>
    <?php
        $query = "SELECT student_id AS id, Student.name as name 
                    FROM Student 
                    WHERE Student.branch='$id'";
        $res = mysqli_query($conn, $query);
    ?>
    <ol>
        <?php foreach ($res as $student) { ?>
            <li><?php echo $student['id']." - ".$student['name'] ?></li>
        <?php } ?>
    </ol>
<?php   }   ?>

<!-- yes no buttons -->
<form action="#" method="POST">
    <input type="submit" name="submit" value="&#10004; Yes" class="btn btn-sm btn-success">
    <a href="branch.php" class="btn btn-sm btn-danger">&#10006; No</a>
</form>
<br>
<br>

<!-- after deletion -->
<?php
    if (isset($_POST["submit"])) {
        $query = "DELETE FROM Branch WHERE branch_id = '$id'";
        if (mysqli_query($conn, $query)) { 
            header("Location:branch.php");
        } else { ?>
            <div class="alert alert-danger flexbox mt-3">
                <?php echo "Something went wrong... Try Again..."; ?>
                <a href="branch.php" class="btn btn-info">Go Back to Branch Records</a>
            </div>
        <?php }
    }
?>

<?php include "footer.php" ?>
