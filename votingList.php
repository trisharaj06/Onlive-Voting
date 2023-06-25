<?php
session_start();
$msg="";
if(isset($_POST['sb'])){
    $title=$_POST['t'];
    
    $link=mysqli_connect("localhost","root","","votingDB");
    $qry="insert into election(title) values('$title')";
    mysqli_query($link,$qry);
    if(mysqli_affected_rows($link)>0)
        $msg = "Saved Successfully";
    else
        $msg = "Error in Saving your information....";
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
            <div class="row">
                <div class="col-sm-4" style="margin-left:10px;">
                    <h3 style="color:white;">Voting Form</h3>
                    <hr>
                    <div class="form-group">
                    <form method="post">
                        <label style="color:white;">Title</label>
                        <input required class="form-control" type="text" name="t" value=""/><br>
                        
                        <input class="btn btn-success" type="submit" name="sb" value="Save"/>
                        <br><br>
                        <?php
                        echo "<font color= #42f560>$msg</font>";
                        ?>
                    </form>
                    </div>
                </div>
                <div col-sm-1></div>
                <div class="col-sm-7" style="margin-left:20px;">
                    <h3 style="color:white;">View Voting List</h3>
                    <hr>
                    <br>
                    <?php
                $link = mysqli_connect("localhost","root","","votingDB");
                $qry="select * from election";
                $resultset=mysqli_query($link,$qry);
                if(mysqli_num_rows($resultset)>0){
                    echo "<div class='table-responsive'>";
                    echo "<table class='table table-bordered'>";
                    echo "<tr style='color:yellow'>";
                    echo "<th>Id</th><th>Name</th><th>Delete Records</th>";
                    echo "</tr>";
                    while($r=mysqli_fetch_array($resultset))
                    {
                        echo "<tr style='color:white'>";
                        echo "<td>$r[0]</td>";
                        echo "<td><a style='color:white;' href='candidate.php?id=$r[0]'>$r[1]</a></td>";
                        echo "<td><a class='btn btn-danger' href='deletevlist.php?id=$r[0]'>Delete</a></td>";
                       
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "</div>";
                }
                else{
                    echo "<h3 style='color:white;text-align:center;'>No Record Found</h3>";
                    
                }
                mysqli_close($link);
                ?>
                </div>
                
            </div>
        </div>
    </body>
</html>
