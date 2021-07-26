<?php include "header.php" ?>

<h4 class="new-title new-title-basic-underline">Locations</h4>

<div class="flexbox mt-3">
    <!-- showing available locations -->
    <div class="flex-group">
        <fieldset>
            <legend>Available Locations</legend>
            <ul class="list-group loc-list">
                <?php 
                    $query = "SELECT loc_name AS name FROM Location ORDER BY loc_id DESC";
                    $res = mysqli_query($conn, $query);
                    if (mysqli_num_rows($res)==0) {
                    ?>
                        <li class="list-group-item">
                            <h5>No Organization available to show...</h5>
                        </li>
                    <?php
                    } else {
                        foreach ($res as $loc) {
                    ?>
                            <li class="list-group-item"><?php echo $loc['name']; ?></li>
                    <?php
                        }
                    }
                ?>
            </ul>
        </fieldset>
    </div>

    <!-- vertical line -->
    <div class="vl-8"></div>

    <!-- New location add form -->
    <div class="flex-group">
        <fieldset>
            <legend>Add New Location</legend>
            <form action="#" method="post">
                <label for="loc_name" class="form-label">Enter Location Name:</label>
                <input type="text" name="loc_name" class="form-input mb-2" placeholder="Location name" required>
                <input type="submit" name="add-loc" value="Add" class="btn btn-outline-success new-btn-block">
            </form>
        </fieldset>
    </div>
</div>

<?php
    if (isset($_POST["add-loc"])) {
        // getting user input
        $loc_name = strtoupper($_POST['loc_name']);

        // creating new ID
        $query = "SELECT loc_id FROM Location ORDER BY 1 DESC LIMIT 1";
        $res = mysqli_query($conn, $query);
        if (mysqli_num_rows($res)==0) {
            $loc_id = "01";
        } else {
            $row = mysqli_fetch_array($res);
            $loc_id = intval($row['loc_id'])+1;
            $loc_id = $loc_id<10 ? "0"."$loc_id" : strval($loc_id);
        }

        $query = "INSERT INTO Location(loc_id, loc_name) VALUES('$loc_id', '$loc_name')";
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
