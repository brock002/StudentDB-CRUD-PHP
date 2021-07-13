<?php include "header.php" ?>

<h4 class="new-title-basic-underline mb-3">Add New Student: </h4>
<form action="#" method="POST" class="m-2">
    <div class="flexbox">
        <div class="form-group">
            <label for="roll" class="form-label">Enter Roll Number:</label>
            <input type="number" name="roll" placeholder="Roll Number" class="form-input">
        </div>
        <div class="form-group mx-3">
            <label for="name" class="form-label">Enter Name:</label>
            <input type="text" name="name" placeholder="Name" class="form-input">
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
    <button type="submit" name="submit" class="btn new-btn-block btn-success my-3">Add</button>
</form>

<?php 
    if (isset($_POST["submit"])) {
        $roll = $_POST["roll"];
        $name = $_POST["name"];
        $branch = $_POST["branch"];

        $query = "INSERT INTO Student(roll_no, name, branch) VALUES('$roll', '$name', '$branch')";
        if (mysqli_query($conn, $query)) {  ?>
            <div class="alert alert-success flexbox mt-3">
                <?php echo "Record Added Successfully..."; ?>
                <a href="student.php" class="btn btn-info">Go to Student Records</a>
            </div>
            <?php } else { ?>
            <div class="alert alert-danger flexbox mt-3">
                <?php echo "Something went wrong... Try Again..."; ?>
                <a href="student.php" class="btn btn-info">Go to Student Records</a>
            </div>
        <?php } 
    }
?>

<?php include "footer.php" ?>
