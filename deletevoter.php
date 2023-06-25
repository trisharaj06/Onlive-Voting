<?php
$vid = $_GET['id'];
$link=mysqli_connect("localhost","root","","votingDB");
$qry = "delete from voter where voter_id=$vid";
mysqli_query($link,$qry);
mysqli_close($link);
header("location:viewvoters.php");
?>
