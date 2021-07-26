<?php include "header.php" ?>

<h4 class="new-title-basic-underline mb-3">Add New Student Details</h4>
<form action="#" method="POST" class="my-2">
    <div class="flexbox">
        <div class="form-group ml-3">
            <label for="name" class="form-label">Enter Name:</label>
            <input type="text" name="name" placeholder="student name here" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="dob" class="form-label">Select Date of Birth:</label>
            <input type="date" name="dob" class="form-input" id="dobPop" data-bs-toggle="popover" title="Student must be at least 18 years old" data-bs-content="Select Date of Birth Again" onblur="validateDob(event)" required>
        </div>
        
    </div>
    <div class="flexbox">
        <div class="form-group mr-3">
            <label for="email" class="form-label">Enter Email:</label>
            <input type="email" name="email" placeholder="xyz@abc.pqr (must be unique)" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="phone" class="form-label">Enter Phone No: </label>
            <input type="text" name="phone" placeholder="phone no here (optional)" class="form-input">
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
            <select name="branch" required>
                <option hidden disabled selected value> -- select an option -- </option>
                <?php
                    $query = "SELECT * FROM Branch";
                    $res = mysqli_query($conn, $query);
                    foreach ($res as $branch) {
                ?>
                <option value="<?php echo $branch['branch_id'] ?>">
                    <?php echo $branch['branch_id']." (".ucwords(strtolower($branch['name'])).")" ?>
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
        $name = ucwords($_POST["name"]);
        $admission_year = $_POST["admission_year"];
        $branch = $_POST["branch"];
        $dob = $_POST['dob'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        // checking dob validation
        $temp = intval(date("Y"))-substr($dob, 0, 4);
        if ($temp<18) {
            // needs fixing...
            echo "<script>showPopover()</script>";
        } else {

            // creating the student_id
            $query = "SELECT roll_no FROM Student 
                        WHERE SUBSTRING(roll_no, 1, 6)='$branch' 
                        AND SUBSTRING(roll_no, 7, 10)='$admission_year' 
                        ORDER BY 1 DESC LIMIT 1";
            $res = mysqli_query($conn, $query);
            if (mysqli_num_rows($res)==0) {
                $slno = 1;
            } else {
                $slno = intval(substr(mysqli_fetch_array($res)['roll_no'], 11))+1;
            }
            $slno = ($slno<100) ? "0".$slno : $slno;
            $slno = ($slno<10) ? "0".$slno : $slno;
            $student_id = $branch.$admission_year.$slno;

            // adding the new student
            $query = "INSERT INTO Student(roll_no, name, admission_year, dob, email, phone) VALUES('$student_id', '$name', $admission_year, '$dob', '$email', '$phone')";
            if (mysqli_query($conn, $query)) {  ?>
                <div class="alert alert-success flexbox mt-3">
                    <h6>
                        New Student with <strong>Roll No: <?php echo $student_id;?></strong> Added Successfully
                    </h6>
                    <span>
                        <a href="student.php" class="btn btn-sm btn-outline-info">Go to Student Records</a>
                        <a href="add_student_tpr.php?roll=<?php echo $student_id; ?>" class="btn btn-sm btn-outline-info">Select TPR</a>
                    </span>
                </div>
                <?php } else { ?>
                <div class="alert alert-danger flexbox mt-3">
                    <?php echo "Something went wrong... Try Again..."; ?>
                    <a href="student.php" class="btn btn-info">Go to Student Records</a>
                </div>
            <?php } 
        }
    }
?>

<?php include "footer.php" ?>
