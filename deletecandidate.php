<?php
$vid = $_GET['id'];
$link=mysqli_connect("localhost","root","","votingDB");
$qry = "delete from candidate where c_id=$vid";
mysqli_query($link,$qry);
mysqli_close($link);
header("location:candidate.php");
?>


