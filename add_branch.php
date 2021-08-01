<?php include "header.php" ?>

<h4 class="new-title-basic-underline mb-3">Add New Department Details</h4>
<form action="#" method="POST" class="my-2">
    <div class="flexbox">
        <div class="form-group">
            <label for="dep-org" class="form-label">Select Organization:</label>
            <select name="dep-org" required>
            <?php 
                if (!isset($_GET['org'])) {
                    echo "<option hidden disabled selected value> -- select an option -- </option>";
                }
                $query = "SELECT org_id AS id, org_name AS name FROM Organization ORDER BY 1";
                $res = mysqli_query($conn, $query);
                foreach ($res as $org) { ?>
                    <?php
                        if (isset($_GET['org']) && $org['id']==$_GET['org']) {
                            ?>
                            <option value=<?php echo $org['id']; ?> selected><?php echo $org['name']; ?></option>
                            <?php
                        } else {
                            ?>
                            <option value=<?php echo $org['id']; ?>><?php echo $org['name']; ?></option>
                            <?php
                        }
                    ?>
                <?php }
            ?>
            </select>
        </div>
        <div class="form-group">
            <label for="dep-code" class="form-label">Enter Department Code:</label>
            <input type="text" minlength="3" maxlength="3" name="dep-code" placeholder="Department Code (3 digit code only)" class="form-input">
        </div>
    </div>
    <div class="form-group">
        <label for="dep-name" class="form-label">Enter Department Name:</label>
        <input type="text" name="dep-name" placeholder="name" class="form-input">
    </div>
    <button type="submit" name="submit" class="btn new-btn-block btn-outline-success my-3">Add</button>
</form>

<?php 
    if (isset($_POST["submit"])) {
        // getting user inputs
        $dep_org = $_POST["dep-org"];
        $name = strtoupper($_POST["dep-name"]);
        $dep_code = strtoupper($_POST["dep-code"]);

        // creating the department ID
        $dep_num = ($dep_num<10) ? "0".$dep_num : $dep_num;
        $dep_id = $dep_org.$dep_code;

        // adding the new department
        $query = "INSERT INTO Branch(branch_id, name) VALUES('$dep_id', '$name')";
        if (mysqli_query($conn, $query)) {  ?>
            <div class="alert alert-success flexbox mt-3">
                <span>
                    <?php echo "New Department with ID <strong>$dep_id</strong> Added Successfully..."; ?>
                </span>
                <a href="branch.php?org=<?php echo $_GET['org']; ?>" class="btn btn-sm btn-outline-info">Go to Department Records</a>
            </div>
        <?php } else { ?>
            <div class="alert alert-danger flexbox mt-3">
                <?php echo "Something went wrong... Try Again..."; ?>
                <a href="branch.php?org=<?php echo $_GET['org']; ?>" class="btn btn-sm btn-outline-info">Go to Department Records</a>
            </div>
        <?php } 
    }
?>

<?php include "footer.php" ?>
