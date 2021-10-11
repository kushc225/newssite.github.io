<?php include "header.php";
if($_SESSION['role']==0){
    header("Location: http://localhost/index/news-site/admin/post.php");

}
include 'config.php';
if (isset($_POST['update'])) {
    $userid = mysqli_real_escape_string($conn, $_POST['user_id']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    // $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $sql = "UPDATE user SET first_name='$first_name', last_name='$last_name',  username='$username', role='$role' WHERE user_id='$userid'";
    $result = mysqli_query($conn, $sql) or die("Query Falied");
    if ($result) {
        header("Location: http://localhost/index/news-site/admin/users.php");
    } else {
        echo "Failed To Update Your Records";
    }
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <?php
                include_once 'config.php';
                $user_id = $_GET['id'];
                $sql = "SELECT * FROM user WHERE user_id='$user_id'";
                $result = mysqli_query($conn, $sql) or die('Query Falied');


                $num = mysqli_num_rows($result);
                if ($num > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                ?>
                <!-- Form Start -->
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="user_id" class="form-control" value='<?php echo $row['user_id']; ?>'
                            placeholder="">
                    </div>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" class="form-control"
                            value="<?php echo $row['first_name']; ?>" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" class="form-control"
                            value="<?php echo $row['last_name']; ?>" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>"
                            placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="role" value="<?php echo $row['role']; ?>">
                            <?php
                                    if ($row['role'] == 1) {
                                        echo "<option value='0'>normal User</option>
                            <option selected value='1'>Admin</option>";
                                    } else {
                                        echo "<option selected value='0'>normal User</option>
                            <option value='1'>Admin</option>";
                                    }
                                    ?>
                        </select>
                    </div>
                    <input type="submit" name="update" class="btn btn-primary" value="Update" required />
                </form>
                <!-- /Form -->
                <?php
                    }
                }

                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>