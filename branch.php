<?php include "header.php" ?>

<h4 class="new-title new-title-basic-underline">Branches Available</h4>

<?php
    $query = "SELECT * FROM Branch";
    $res = mysqli_query($conn, $query);
?>


<table class="table table-striped table-borderless table-dark table-hover mt-3">
    <thead>
        <tr>
            <th>
                <h5>Branch ID</h5>
            </th>
            <th>
                <h5>Branch Name</h5>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($res as $branch) {
        ?>
        <tr>
            <td>
                <?php echo $branch['branch_id']; ?>
            </td>
            <td>
                <?php echo $branch['name']; ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php include "footer.php" ?>