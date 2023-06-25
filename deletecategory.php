<?php
$cdid = $_GET['id'];
$link=mysqli_connect("localhost","root","","votingDB");
$qry = "delete from category where cid=$cdid";
mysqli_query($link,$qry);
mysqli_close($link);
header("location:category.php");
?>

