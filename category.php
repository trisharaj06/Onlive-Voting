<?php
session_start();
$msg="";
if(isset($_POST['sub'])){
    $cat=$_POST['catname'];
    $link=mysqli_connect("localhost","root","","votingDB");
    $qry="insert into category(cname) values('$cat')";
    mysqli_query($link,$qry);
    if(mysqli_affected_rows($link)>0)
        $msg = "Category added Successfully";
    else
        $msg = "Error while performing this action....";
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
            <div class="row" >
                <div class="col-sm-5" style="margin-left:18px;">
                    <h3 style="color:white;">Add New Category</h3>
                    <hr>
                    <div class="form-group">
                    <form method="post">
                        <div clas="row">
                            <div col-sm-5>
                                <label style="color:white;font-size:19px;">Category Name</label>
                            </div>
                            <div col-sm-7>
                        <input required class="form-control" type="text" name="catname" value=""/><br>
                            </div>
                        </div>
                        <input class="btn btn-success" type="submit" name="sub" value="Add Category"/>
                        <br><br>
                        <?php
                        echo "<font color= #42f560>$msg</font>";
                        ?>
                    </form>
                    </div>
                </div>
               
                <div class="col-sm-6">
                    <h3 style="color:white;margin-left:120px;"> category Lists</h3>
                    <hr>
                    <br>
                    <?php
                $link = mysqli_connect("localhost","root","","votingDB");
                $qry="select * from category";
                $resultset=mysqli_query($link,$qry);
                if(mysqli_num_rows($resultset)>0){
                    echo "<div class='table-responsive'>";
                    echo "<table class='table table-bordered'>";
                    echo "<tr style='color:yellow'>";
                    echo "<th>Category Id</th><th>Category Name</th><th>Delete Records</th>";
                    echo "</tr>";
                    while($r=mysqli_fetch_array($resultset))
                    {
                        echo "<tr style='color:white'>";
                        echo "<td>$r[0]</td>";
                        echo "<td>$r[1]</td>";
                        echo "<td><a class='btn btn-danger' href='deletecategory.php?id=$r[0]'>Delete</a></td>";
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
