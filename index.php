<?php
session_start();
$msg="";
if(isset($_POST['login'])){
    $id=$_POST['vid'];
    $pwd=$_POST['pass'];
    $link=mysqli_connect("localhost","root","","votingDB");
    $qry="select * from voter where voter_id = $id and voter_pwd = '$pwd'";
    $result = mysqli_query($link,$qry);
    if(mysqli_num_rows($result)>0){
        $r = mysqli_fetch_assoc($result);
        $_SESSION['uname']=$r['voter_name'];
        $_SESSION['utype']=$r['voter_type'];
        $_SESSION['vid']=$r['voter_id'];
        header("location:vote.php");
    }
    else{
        $msg="<font color='red'>Invalid Username or Password</font>";
    }
        
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-Voting System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>
  <style>
      div.transbox {
  margin: 30px;
  background-color: #f2f8fa;
  border: 1px solid black;
  opacity: 0.8;
  
  padding:28px 28px 28px 28px;
  width:500px;
  height:290px;
  box-shadow: 6px 6px 5px black;
}
  </style>
  <body style="background-color:#2d7291";>
    
    <div class="container-fluid">
        <?php
    include("Header.php");
       ?>
    <div class="row" style="margin-top:0px;margin-left:55px;">
        
        <div class="col-sm-6 text-left" >
            <h1 style="color:white;margin-top:120px;margin-left: 30px;">Online Voting System</h1>   
            <div class="transbox" style="border-radius:10px;">
            <p style="text-align:justify;font-size:13.5px;padding-top:19px;color:black;">
                In <b>"ONLINE VOTING SYSTEM"</b> a voter can use his/her voting
                right online without any difficulty. He/She has to be registered first
                for him/her to vote. Registration is mainly done by the system administrator
                for security reasons. The System Administrator registers the voters on a spacial
                site of the system visited by him only by simply filling a registration form to
                regular voter.<br>
                After registration, the voter is assigned a secret Voter ID with which he/she
                can use to log into the system and enjoy services provided by the system such as 
                voting. If invalid/wrong details are submitted, then the citizen is not registered
                to vote.
            </p>
            </div>
                
        </div>
        <div class="col-sm-6">
            <div class="transbox" style="border-radius:10px;margin-top:188px;padding:37px;padding-top:25px;">
                <div class="row">
                <div class="form-group">
            <form method="POST">
                <label>Voter ID</label>
                <input required class="form-control" type="number" name="vid" value=""></input>
                
                <br>
                <label>Password</label>
                <input required class="form-control" type="password" name="pass" value=""></input>
                 <br>
                 <input type ="checkbox" name="check"></input>
                 <label>Remember me</label>
                 <br>
                 <input  class="btn btn-info" type="submit" name="login" value="LOGIN"/>
                 <br>
                 <?php echo $msg; ?> 
               
            </form>
                </div>
                </div>
            </div>
        </div>
    </div>
    </div>
  </body>
</html>