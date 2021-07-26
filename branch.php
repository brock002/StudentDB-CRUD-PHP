<?php include "header.php" ?>

<div class="flexbox">
    <h4 class="new-title new-title-basic-underline">Departments</h4>
    <a href="add_branch.php" class="new-btn btn btn-sm">Add New Department</a>
</div>

<?php
    $query = "SELECT * FROM Branch ORDER BY 1";
    $res = mysqli_query($conn, $query);
?>


<table class="table table-bordered table-light table-hover mt-3">
    <tbody>
        <?php
            if (mysqli_num_rows($res)<1) {
                echo "<h5>No Department available to show...</h5>";
            } else {
                foreach ($res as $branch) {
        ?>
                <tr>
                    <td>
                        <a href="student.php?branch=<?php echo $branch['branch_id']; ?>">
                            <?php echo $branch['branch_id']; ?>
                        </a>
                    </td>
                    <td class="text-end">
                        <a href="student.php?branch=<?php echo $branch['branch_id']; ?>">
                            <?php echo $branch['name']; ?>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="remove_branch.php?id=<?php echo $branch['branch_id']; ?>" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-trash">Remove</i>
                        </a>
                    </td>
                </tr>
        <?php }
            } 
        ?>
    </tbody>
</table>
<small class="bg-light bg-gradient"> <i class="bi bi-sticky"></i> Click on a department to see students listed under that department</small>

<?php include "footer.php" ?>