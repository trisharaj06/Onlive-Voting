<?php
session_start();
$msg="";
if(isset($_POST['reg'])){
    $name=$_POST['nm'];
    $pwd=$_POST['ps'];
    $aadhar=$_POST['an'];
    $gend=$_POST['gdr'];
    $type=$_POST['usertype'];
    $link=mysqli_connect("localhost","root","","votingDB");
    $qry="insert into voter(voter_name,voter_pwd,voter_aadhar,voter_gender,voter_type) values('$name','$pwd',$aadhar,'$gend','$type')";
    mysqli_query($link,$qry);
    if(mysqli_affected_rows($link)>0)
        $msg = "Voter Registered Successfully";
    else
        $msg = "Error in Voter Registration....";
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        
    </head>
    
    <body style="background-color: #2d7291;">
        <div class="container-fluid">
        <?php
         include("./Header.php");
        ?>
            <div class="container-fluid" style="text-align: center;">
                <h3 style="color:white;">New Voter Registration</h3>
                <hr>
                <div class="form-group row">
                    <div class="col-sm-5" >
                        
                <form method="post" onsubmit="return ValidateForm()" style="text-align:justify;font-size:14px;">
                    <div class="row">
                        <div class="col-sm-6"> <label style="color:white;">Name</label></div>
                        <div class="col-sm-6"><input class="form-control" type="text" name="nm" value=""></div>
                    </div><br>
                    <div class="row">
                        <div class="col-sm-6">  <label style="color:white;">Password</label></div>
                        <div  class="col-sm-6">  <input id="q1" class="form-control" type="password" name="ps" value="">
                         <label id="a1" style="color:red"></label>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-sm-6"> <label style="color:white;">Aadhar Number</label></div>
                        <div class="col-sm-6"> <input id="q2" onchange="ValidateAadhar()" class="form-control" type="text" name="an" value="">
                            <label id="a2" style="color:red"></label>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-sm-6"> <label style="color:white;">Gender</label></div>
                    <div class="col-sm-6"> 
                    <input type="radio" name="gdr" value="Male">
                    <label style="color:white;">Male</label>
                    <input type="radio" name="gdr" value="Female">
                    <label style="color:white;">Female</label></div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-6"> <label style="color:white;">User type</label></div>
                        <div class="col-sm-6">
                            <select class="form-control" name="usertype">
                                <option> </option>
                                <option>Admin</option>
                                <option>Voter</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-6"> </div>
                        <div class="col-sm-6"> 
                            
                            <input  type="submit" class="btn btn-danger" value="Register" name="reg"></input></div>
                    </div>
                    <br>
                    <?php echo "<font color= #42f560>$msg</font>"; ?>
                </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
           function ValidateForm(){
               flag = true;
               pwd = document.getElementById("q1").value;
               if(pwd.length < 8)
               {
                 document.getElementById("a1").innerHTML = "weak password(must contain atleast 8 characters)";
                 flag = false;
               }
               else if(pwd.length >= 8){
                  alpha=0;
                  digit=0;
                  symbol=0;
                  for(i=0;i<pwd.length;i++){
                      ch = pwd.charAt(i);
                      if((ch>='A' && ch<='Z') || (ch>='a' && ch<='z'))
                         alpha++;
                     else if(ch>='0' && ch<='9')
                         digit++;
                     else
                         symbol++;
             
                  }
                  if(digit>=1 && alpha>=1 && symbol>=1){
                  }
                  else{
                      document.getElementById("a1").innerHTML = "Password must contain atleast 1 alphabet 1 number and 1 special character";
                      flag=false;
                  }
               }
               else
                   document.getElementById("a1").innerHTML = "";
               aadhar = document.getElementById("q2").value;
               if(aadhar.length!=12){
                   document.getElementById("a2").innerHTML = "Invaid Aadhar Number";
                   flag=false;
               }
               else
                   document.getElementById("a2").innerHTML = "";
               return flag;
           }
           function ValidateAadhar(){
           id = document.getElementById("q2").value;
           obj = new XMLHttpRequest();
           obj.open("get","ValidateAadhar.php?an="+id,true);
           obj.send();
           obj.onreadystatechange=function(){
               if(obj.readystate==4 && obj.status==200)
               {
                   document.getElementById("a2").innerHTML=obj.responseText;
                }
           }
           }
         </script>
</html>
