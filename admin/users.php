<?php

if($_SESSION['role']==0){
    header("Location: http://localhost/index/news-site/admin/post.php");

}
include "header.php";
include_once 'config.php';
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Users</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-user.php">add user</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>User-Name</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }
                        $limit = 3;
                        $offset = ($page - 1) * $limit;
                        $sql = "SELECT * FROM user ORDER By user_id DESC LIMIT $offset,$limit ";
                        $result = mysqli_query($conn, $sql) or die('Query Falied');

                        $num = mysqli_num_rows($result);
                        if ($num > 0) {
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $count++;

                                echo "<tr>
                                    <td class='id'>" . $count . "</td>
                                    <td>" . $row['first_name'] . "</td>
                                    <td>" . $row['last_name'] . "</td>
                                    <td>" . $row['username'] . "</td>
                                    <td>" . $row['role'] . "</td>
                                    <td class='edit'><a href='update-user.php?id=" . $row['user_id'] . ";'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-user.php?id=" . $row['user_id'] . ";'><i class='fa fa-trash-o'></i></a></td>
                                </tr>";
                            }
                        }

                        ?>
                    </tbody>
                </table>
                <?php
                $sql1 = "SELECT * FROM user";
                $result1 = mysqli_query($conn, $sql1) or die("Query Falied");
                if (mysqli_num_rows($result) > 0) {
                    $total_records = mysqli_num_rows($result1);

                    $total_page = ceil($total_records / $limit);
                    echo "  <ul class='pagination admin-pagination'>";
                    if($page>1){
                        echo '<li><a href="users.php?page='.($page-1).'">Prev</a></li>';
                    }
                    for ($i = 1; $i <= $total_page; $i++) {
                        if($i==$page){
                            $active="active";
                        }else{
                            $active="";
                        }
                        echo "<li class=".$active."><a href='users.php?page={$i}'>{$i}</a></li>";
                    }
                    if($total_page>$page)
                    echo '<li><a  href="users.php?page='.($page+1).'">Next</a></li>';
                }
                echo "</ul>";
                ?>
                </div>
            </div>
        </div>
    </div>