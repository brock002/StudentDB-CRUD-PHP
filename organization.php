<?php include "header.php" ?>

<h4 class="new-title new-title-basic-underline">Organizations</h4>

<div class="flexbox mt-3">
    <!-- showing available Organizations -->
    <div class="flex-group">
        <fieldset>
            <legend>Available Organizations</legend>
            <ul class="list-group org-list">
                <?php 
                    $query = "SELECT org_id AS id, org_name AS name, Location.loc_name AS location 
                                FROM Organization LEFT JOIN Location 
                                ON Organization.location=Location.loc_id 
                                ORDER BY org_id";
                    $res = mysqli_query($conn, $query);
                    if (mysqli_num_rows($res)==0) {
                    ?>
                        <li class="list-group-item">
                            <h5>No Organization available to show...</h5>
                        </li>
                    <?php
                    } else {
                        foreach ($res as $org) {
                    ?>
                        <li class="list-group-item flexbox">
                            <span>
                                <?php echo ucwords(strtolower($org['name']))."(".$org['id'].")"; ?>
                            </span>
                            <small>
                                <?php echo ucwords(strtolower($org['location'])); ?>
                            </small>
                        </li>
                    <?php
                        }
                    }
                ?>
            </ul>
        </fieldset>
    </div>

    <!-- vertical line -->
    <div class="vl-18"></div>

    <!-- New Organization add form -->
    <div class="flex-group">
        <fieldset>
            <legend>Add New Organization</legend>
            <form action="#" method="post">
                <label for="org_id" class="form-label">Enter Organization ID:</label>
                <input type="text" name="org_id" minlength="3" maxlength="3" placeholder="3 letter Organization ID" class="form-input mb-2" required>
                <label for="org_name" class="form-label">Enter Organization Name:</label>
                <input type="text" name="org_name" class="form-input mb-2" placeholder="Organization name" required>
                <label for="org_loc" class="form-label">Select Organization Location (optional):</label>
                <select name="org_loc">
                    <option selected value="null">None</option>
                <?php 
                    $query = "SELECT loc_id AS id, loc_name AS name FROM Location ORDER BY 1";
                    $res = mysqli_query($conn, $query);
                    foreach ($res as $loc) { ?>
                        <option value=<?php echo $loc['id']; ?>><?php echo $loc['name']; ?></option>
                    <?php }
                ?>
                </select>
                <input type="submit" name="add-org" value="Add" class="btn btn-outline-success new-btn-block mt-3">
            </form>
        </fieldset>
    </div>
</div>

<?php
    if (isset($_POST["add-org"])) {
        // getting user inputs
        $org_name = strtoupper($_POST['org_name']);
        $org_id = strtoupper($_POST['org_id']);
        $org_loc = $_POST['org_loc'];

        // handling optional location field
        if ($org_loc=="null") {
            $query = "INSERT INTO Organization(org_id, org_name) VALUES('$org_id', '$org_name')";
        } else {
            $query = "INSERT INTO Organization(org_id, org_name, location) VALUES('$org_id', '$org_name', '$org_loc')";
        }

        if (mysqli_query($conn, $query)) {  
            header("Refresh:1"); ?>
            <div class="alert alert-success mt-3" role="alert">
                <span>Record Added Successfully...</span>
            </div>
        <?php } else { ?>
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <span>Something went wrong... Try Again...</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php }
    }
?>

<?php include "footer.php" ?>
