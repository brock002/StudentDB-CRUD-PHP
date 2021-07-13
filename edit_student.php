<?php include "header.php" ?>

<?php
    $roll=$_GET['roll'];
    $query = "SELECT * FROM Student WHERE roll_no = $roll";
    $res = mysqli_query($conn, $query);
    foreach ($res as $s) {
        $name=$s['name'];
    }
?>

<h4 class="new-title-basic-underline mb-3">Edit Student: </h4>
<form action="#" method="POST" class="m-2">
    <div class="flexbox">
        <div class="form-group">
            <label for="name" class="form-label">Enter Name:</label>
            <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Name" class="form-input">
        </div>
        <div class="form-group">
            <label for="branch" class="form-label">Select Branch:</label>
            <select name="branch">
                <?php
                    $query = "SELECT * FROM Branch";
                    $res = mysqli_query($conn, $query);
                    foreach ($res as $branch) {
                ?>
                <option value="<?php echo $branch['branch_id'] ?>">
                    <?php echo $branch['name'] ?>
                </option>
                <?php } ?>
            </select>
        </div>
    </div>
    <button type="submit" name="submit" class="btn new-btn-block btn-success my-3">Save</button>
</form>

<?php 
    if (isset($_POST["submit"])) {
        $name = $_POST["name"];
        $branch = $_POST["branch"];

        $query = "UPDATE Student SET name = '$name', branch = $branch WHERE roll_no = $roll";
        if (mysqli_query($conn, $query)) {  ?>
        <div class="mt-3">
            <div class="alert alert-success flexbox">
                <?php echo "Record Updated Successfully..."; ?>
                <a href="student.php" class="btn btn-info">Go Back to Student Records</a>
            </div>
            <?php } else { ?>
            <div class="alert alert-danger flexbox">
                <?php echo "Something went wrong... Try Again..."; ?>
                <a href="student.php" class="btn btn-info">Go Back to Student Records</a>
            </div>
        </div>
        <?php } 
    }
?>

<?php include "footer.php" ?>
