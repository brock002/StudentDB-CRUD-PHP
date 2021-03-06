<?php include "header.php" ?>

<?php
    $query = "SELECT 
                    S1.roll_no AS roll_no, 
                    S1.name AS name, 
                    Branch.name AS branch, 
                    S1.dob AS dob, 
                    S1.email AS email, 
                    IFNULL(S1.phone, 'N/A') AS phone, 
                    IFNULL(S2.name, 'N/A') AS tpr
                FROM Student AS S1
                INNER JOIN Branch ON SUBSTRING(S1.roll_no, 1, 6)=Branch.branch_id
                LEFT JOIN Student AS S2 ON S1.tpr=S2.roll_no";
    if (isset($_GET["branch"])) {
        $branch = $_GET['branch'];
        $query .= " WHERE Branch.branch_id = '$branch'";
    }
    $res = mysqli_query($conn, $query);
?>

<div class="flexbox">
    <h4 class="new-title new-title-basic-underline">Students</h4>
    <a href="add_student.php?branch=<?php echo $branch; ?>" class="new-btn btn btn-sm">Add Student</a>
</div>

<?php
    if (mysqli_num_rows($res)>0) { ?>
    <div class="table-responsive">
        <table class="table table-bordered mt-3">
            <thead class="table-secondary">
                <tr>
                    <th>
                        <h6>Roll No</h6>
                    </th>
                    <th>
                        <h6>Name</h6>
                    </th>
                    <th>
                        <h6>Date of Birth</h6>
                    </th>
                    <th>
                        <h6>TPR</h6>
                    </th>
                    <th colspan="3">
                        <h6>Actions</h6>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($res as $key => $student) { 
                    $tr_class = $key%2==0 ? "table-light":"table-secondary"    
                ?>
                <tr class=<?php echo $tr_class; ?> >
                    <td>
                        <h6>
                            <?php echo substr($student['roll_no'], 0, 6)." / ".substr($student['roll_no'], 6, 4)." / ".substr($student['roll_no'], 10, 3); ?>
                        </h6>
                    </td>
                    <td>
                        <h6>
                            <strong>
                                <?php echo $student['name']; ?>
                            </strong>
                        </h6>
                    </td>
                    <td>
                        <h6>
                            <?php echo $student['dob']; ?>
                        </h6>
                    </td>
                    <td>
                        <h6>
                            <?php echo $student['tpr']; ?>
                        </h6>
                    </td>
                    <td class="flexbox">
                        <a href="edit_student.php?roll=<?php echo $student['roll_no'] ?>&branch=<?php echo $_GET['branch']?>" class="new-title-basic-underline">
                            <!-- <i class="bi bi-pencil-square"></i> -->
                            Update Student Details
                        </a>
                        <a href="remove_student.php?roll=<?php echo $student['roll_no'] ?>&branch=<?php echo $_GET['branch']?>" class="new-title-basic-underline">
                            <!-- <i class="bi bi-trash"></i> -->
                            Remove Student
                        </a>
                    </td>
                </tr>
                <tr class=<?php echo $tr_class; ?> >
                    <td colspan="4">
                        <h6>
                            Department: <?php echo $student['branch']." (".substr($student['roll_no'], 0, 6).")"; ?>
                            <br>
                            Email: <?php echo $student['email']; ?>
                            <br>
                            PhoneNo: <?php echo $student['phone']; ?>
                        </h6>
                    </td>
                    <td>
                        <a href="add_student_tpr.php?roll=<?php echo $student['roll_no'] ?>&branch=<?php echo $_GET['branch']?>" class="new-title-basic-underline">
                            Add/Update TPR
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <small class="bg-light bg-gradient"> <i class="bi bi-sticky"></i> Roll No is in the form of (department / admission year / serial no)</small>
    <?php } else {
            echo "<h5>No student available to show...</h5>";
    }
?>

<?php include "footer.php" ?>