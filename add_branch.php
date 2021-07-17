<?php include "header.php" ?>

<h4 class="new-title-basic-underline mb-3">Add New Branch Details</h4>
<form action="#" method="POST" class="my-2">
    <div class="flexbox">
        <div class="form-group">
            <label for="dep-num" class="form-label">Enter Branch Number:</label>
            <input type="number" min="1" max="99" name="dep-num" placeholder="Branch Number (1 to 99)" class="form-input">
        </div>
        <div class="form-group">
            <label for="dep-code" class="form-label">Enter Branch Code:</label>
            <input type="text" minlength="3" maxlength="3" name="dep-code" placeholder="Branch Code (3 digit code only)" class="form-input">
        </div>
    </div>
    <div class="form-group">
        <label for="dep-name" class="form-label">Enter Branch Name:</label>
        <input type="text" name="dep-name" placeholder="name" class="form-input">
    </div>
    <button type="submit" name="submit" class="btn new-btn-block btn-success my-3">Add</button>
</form>

<?php 
    if (isset($_POST["submit"])) {
        // getting user inputs
        $dep_num = $_POST["dep-num"];
        $name = $_POST["dep-name"];
        $dep_code = strtoupper($_POST["dep-code"]);

        // creating the department ID
        $dep_num = ($dep_num<10) ? "0".$dep_num : $dep_num;
        $dep_id = "AEC/".$dep_num."/".$dep_code;

        // adding the new branch
        $query = "INSERT INTO Branch(branch_id, name, code) VALUES('$dep_id', '$name', '$dep_code')";
        if (mysqli_query($conn, $query)) {  ?>
            <div class="alert alert-success flexbox mt-3">
                <?php echo "Record Added Successfully..."; ?>
                <a href="branch.php" class="btn btn-info">Go to Branch Records</a>
            </div>
        <?php } else { ?>
            <div class="alert alert-danger flexbox mt-3">
                <?php echo "Something went wrong... Try Again..."; ?>
                <a href="branch.php" class="btn btn-info">Go to Branch Records</a>
            </div>
        <?php } 
    }
?>

<?php include "footer.php" ?>
