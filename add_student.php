<?php include "header.php" ?>

<h4 class="new-title-basic-underline mb-3">Add New Student Details</h4>
<form action="#" method="POST" class="my-2">
    <div class="flexbox">
        <div class="form-group">
            <label for="roll" class="form-label">Enter Roll Number:</label>
            <input type="number" name="roll" min="1" max="100" placeholder="Roll Number (between 1 to 100)" class="form-input" required>
        </div>
        <div class="form-group ml-3">
            <label for="name" class="form-label">Enter Name:</label>
            <input type="text" name="name" placeholder="Name" class="form-input" required>
        </div>
    </div>
    <div class="flexbox">
        <div class="form-group mr-3">
            <label for="admission_year" class="form-label">Select Year of Admission:</label>
            <select name="admission_year">
                <?php
                    for ($i=2000; $i <= date("Y"); $i++) { 
                ?>
                <option value="<?php echo $i ?>">
                    <?php echo $i ?>
                </option>
                <?php } ?>
            </select>
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
                    <?php echo $branch['code']." (".$branch['name'].")" ?>
                </option>
                <?php } ?>
            </select>
        </div>
    </div>
    <button type="submit" name="submit" class="btn new-btn-block btn-success my-3">Add</button>
</form>

<?php 
    if (isset($_POST["submit"])) {
        // getting user inputs
        $roll = $_POST["roll"];
        $name = $_POST["name"];
        $admission_year = $_POST["admission_year"];
        $branch = $_POST["branch"];

        // getting the branch code
        $query = "SELECT * FROM Branch WHERE branch_id = '$branch'";
        $res = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($res);
        $branch_code = $row['code'];

        // creating the student_id
        $roll = ($roll<100) ? "0".$roll : $roll;
        $roll = ($roll<10) ? "0".$roll : $roll;
        $student_id = $branch_code."/".$admission_year."/".$roll;

        // adding the new student
        $query = "INSERT INTO Student(student_id, name, admission_year, branch) VALUES('$student_id', '$name', $admission_year, '$branch')";
        if (mysqli_query($conn, $query)) {  ?>
            <div class="alert alert-success flexbox mt-3">
                <h6>
                    New Student with <strong>Roll No: <?php echo $student_id;?></strong> Added Successfully
                </h6>
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
