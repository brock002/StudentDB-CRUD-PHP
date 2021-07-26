<?php include "header.php" ?>

<?php
    $roll=$_GET['roll'];
    $query = "SELECT * FROM Student WHERE roll_no = '$roll'";
    $res = mysqli_query($conn, $query);
    foreach ($res as $s) {
        $name=$s['name'];
        $email=$s['email'];
        $phone=$s['phone'];
    }
?>

<h4 class="new-title-basic-underline mb-3">Update Student Details</h4>
<form action="#" method="POST" class="my-2">
    <div class="flexbox">
        <div class="form-group">
            <label for="name" class="form-label">Update Name:</label> 
            <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Name" class="form-input">
        </div>
        <div class="form-group mx-2">
            <label for="email" class="form-label">Update Email:</label> 
            <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Email" class="form-input">
        </div>
        <div class="form-group">
            <label for="phone" class="form-label">Enter Phone No: </label>
            <input type="text" name="phone" value="<?php echo $phone; ?>" placeholder="Phone" class="form-input">
        </div>
    </div>
    <button type="submit" name="submit" class="btn btn-success">Save</button>
</form>

<?php 
    if (isset($_POST["submit"])) {
        $name = $_POST["name"];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $query = "UPDATE Student SET name = '$name', email = '$email', phone = '$phone' WHERE roll_no = '$roll'";
        if (mysqli_query($conn, $query)) { 
            header("Location:student.php");
        } else { ?>
            <div class="alert alert-danger flexbox mt-3">
                <?php echo "Something went wrong... Try Again..."; ?>
                <a href="student.php" class="btn btn-info">Go Back to Student Records</a>
            </div>
        <?php }
    }
?>

<?php include "footer.php" ?>
