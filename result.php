<?php
session_start();
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
            
                <h4 style="color:white; margin-top:25px;font-size:25px;margin-left:12px;">View Result</h4>
                <hr style="width:97%;">
                <form method="post" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="color:white">Choose Election</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="etype">
                                        <option>Choose Election Type</option>
                                        <?php
                                            $link=mysqli_connect("localhost","root","","votingdb");
                                            $qry = "select * from election";
                                            $result = mysqli_query($link, $qry);
                                            while($r = mysqli_fetch_array($result))
                                            {
                                                echo "<option value='$r[0]'>$r[1]</option>";
                                            }
                                            mysqli_close($link);
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <input type="submit" name="btnshow" value="Show" class="btn btn-danger"/>      
                                </div>
                            </div>    
                        </form>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <?php
                        
                        
                        if(isset($_POST['btnshow']))
                        {
                            $link=mysqli_connect("localhost","root","","votingdb");
                          
                            $qry = "select x,y,cname from (select count(voting_result.c_id) as x, (select c_name from candidate where c_id=voting_result.c_id) as y, (select cid from candidate where c_id=voting_result.c_id) as z from voting_result where pid=5 GROUP BY c_id) xy join category on category.cid=xy.z";
                            $resultset = mysqli_query($link,$qry);
                            echo "<table class='table table-hover' style='background-color:white'>";
                            echo "<tr><th>Candidate Name</th><th>Total Votes</th><th>Category</th></tr>";
                            while($r = mysqli_fetch_array($resultset))
                            {
                                echo "<tr></tr>";
                                echo "<td>$r[1]</td>";
                                echo "<td>$r[0]</td>";
                                echo "<td>$r[2]</td>";
                            }
                            
                            
                            echo "</table>";
                            mysqli_close($link);
                        }
                        ?>
                    </div>
                    <div class="col-sm-4"></div>
                </div>
           
        </div>
    </body>
</html>
