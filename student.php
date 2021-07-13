<?php include "header.php" ?>

<div class="flexbox">
    <h4 class="new-title new-title-basic-underline">Students</h4>
    <a href="add_student.php" class="new-btn">Add Student</a>
</div>

<?php
    $query = "SELECT roll_no, Student.name AS name, Branch.name AS branch
                FROM Student JOIN Branch 
                WHERE Student.branch=Branch.branch_id";
    $res = mysqli_query($conn, $query);
?>

<table class="table table-striped table-borderless table-dark table-hover mt-3">
    <thead>
        <tr>
            <th>
                <h5>Student ID</h5>
            </th>
            <th>
                <h5>Student Name</h5>
            </th>
            <th>
                <h5>Student Branch</h5>
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
                <h5>
                    <?php echo $student['roll_no']; ?>
                </h5>
            </td>
            <td>
                <h5>
                    <?php echo $student['name']; ?>
                </h5>
            </td>
            <td>
                <h5>
                    <?php echo $student['branch']; ?>
                </h5>
            </td>
            <td class="flexbox">
                <a href="edit_student.php?roll=<?php echo $student['roll_no'] ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                <a href="remove_student.php?roll=<?php echo $student['roll_no'] ?>" class="btn btn-sm btn-outline-danger">
                    Remove
                </a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php include "footer.php" ?>