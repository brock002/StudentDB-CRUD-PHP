<?php include "header.php" ?>

<div class="flexbox">
    <h4 class="new-title new-title-basic-underline">Students</h4>
    <a href="add_student.php" class="new-btn btn btn-sm">Add Student</a>
</div>

<?php
    $query = "SELECT student_id AS 'roll_no', Student.name AS name, Branch.name AS branch, Branch.code AS code
                FROM Student JOIN Branch 
                WHERE Student.branch=Branch.branch_id";
    if (isset($_GET["branch"])) {
        $branch = $_GET['branch'];
        $query .= " AND Branch.branch_id = '$branch'";
    }
    $res = mysqli_query($conn, $query);
?>

<table class="table table-bordered table-light table-hover mt-3">
    <thead class="table-secondary">
        <tr>
            <th>
                <h5>Roll No</h5>
            </th>
            <th>
                <h5>Name</h5>
            </th>
            <th>
                <h5>Branch</h5>
            </th>
            <th colspan="2">
                <h5>Actions</h5>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($res as $student) {
        ?>
        <tr>
            <td>
                <h6>
                    <?php echo $student['roll_no']; ?>
                </h6>
            </td>
            <td>
                <h5>
                    <strong>
                        <?php echo $student['name']; ?>
                    </strong>
                </h5>
            </td>
            <td>
                <h6>
                    <?php echo $student['branch']." (".$student['code'].")"; ?>
                </h6>
            </td>
            <td class="flexbox">
                <a href="edit_student.php?roll=<?php echo $student['roll_no'] ?>" class="btn btn-sm btn-outline-success">
                    <i class="bi bi-pencil-square">Update</i>
                </a>
                <a href="remove_student.php?roll=<?php echo $student['roll_no'] ?>" class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-trash">Remove</i>
                </a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php include "footer.php" ?>