<?php include "header.php" ?>

<div class="flexbox">
    <h4 class="new-title new-title-basic-underline">Students</h4>
    <a href="add_student.php" class="new-btn btn btn-sm">Add Student</a>
</div>

<?php
    $query = "SELECT roll_no, Student.name AS name, Branch.name AS branch, dob, email, IFNULL(phone, 'N/A') AS phone, IFNULL(tpr, 'N/A') AS tpr
                FROM Student JOIN Branch 
                ON SUBSTRING(roll_no, 1, 6)=Branch.branch_id";
    if (isset($_GET["branch"])) {
        $branch = $_GET['branch'];
        $query .= " AND Branch.branch_id = '$branch'";
    }
    $res = mysqli_query($conn, $query);
?>

<?php
    if (mysqli_num_rows($res)>0) { ?>
        <table class="table table-bordered table-light table-hover mt-3">
            <thead class="table-secondary">
                <tr>
                    <th>
                        <h6>Roll No</h6>
                    </th>
                    <th>
                        <h6>Name</h6>
                    </th>
                    <th>
                        <h6>Department</h6>
                    </th>
                    <th>
                        <h6>Date of Birth</h6>
                    </th>
                    <th>
                        <h6>Email</h6>
                    </th>
                    <th>
                        <h6>PhoneNo</h6>
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
                <?php
                    foreach ($res as $student) {
                        $current_roll_no = $student['roll_no'];
                ?>
                <tr>
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
                            <?php echo $student['branch']." (".substr($student['roll_no'], 0, 6).")"; ?>
                        </h6>
                    </td>
                    <td>
                        <h6>
                            <?php echo $student['dob']; ?>
                        </h6>
                    </td>
                    <td>
                        <h6>
                            <?php echo $student['email']; ?>
                        </h6>
                    </td>
                    <td>
                        <h6>
                            <?php echo $student['phone']; ?>
                        </h6>
                    </td>
                    <td>
                        <h6>
                            <?php 
                                $tpr = $student['tpr'];
                                $new_query = "SELECT name FROM Student WHERE roll_no='$tpr'";
                                $tpr = mysqli_fetch_array(mysqli_query($conn, $query))['name'];
                                echo $tpr;
                            ?>
                        </h6>
                    </td>
                    <td class="flexbox">
                        <a href="edit_student.php?roll=<?php echo $student['roll_no'] ?>" class="btn btn-sm btn-outline-success">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="remove_student.php?roll=<?php echo $student['roll_no'] ?>" class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-trash"></i>
                        </a>
                        <a href="add_student_tpr.php?roll=<?php echo $student['roll_no'] ?>" class="btn btn-sm btn-outline-primary">
                            TPR
                        </a>
                        
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <small class="bg-light bg-gradient"> <i class="bi bi-sticky"></i> Roll No is in the form of (department / admission year / serial no)</small>
    <?php } else {
            echo "<h5>No student available to show...</h5>";
    }
?>

<?php include "footer.php" ?>