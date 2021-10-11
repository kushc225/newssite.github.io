<?php 
if($_SESSION['role']==0){
    header("Location: http://localhost/index/news-site/admin/post.php");

}
include 'config.php';
$userid=$_GET['id'];

$sql="DELETE FROM user WHERE user_id={$userid}";
$result=mysqli_query($conn,$sql);
if($result){
    header("Location: http://localhost/index/news-site/admin/users.php");

}else{
    echo "Failed To Delete The User";
}