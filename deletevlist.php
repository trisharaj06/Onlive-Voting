<?php
$listid = $_GET['id'];
$link=mysqli_connect("localhost","root","","votingDB");
$qry = "delete from election where pid=$listid";
mysqli_query($link,$qry);
mysqli_close($link);
header("location:votingList.php");
?>

