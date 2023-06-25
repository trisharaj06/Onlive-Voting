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
            <div>
                <h3 style="color:white;font-size:22px;margin-top:40px;margin-left:18px;">View Registered Voters</h3>
                <hr style="width:97%;">
                <br>
                <?php
                $link = mysqli_connect("localhost","root","","votingDB");
                $qry="select * from voter";
                $resultset=mysqli_query($link,$qry);
                if(mysqli_num_rows($resultset)>0){
                    echo "<div class='table-responsive'>";
                    echo "<table class='table table-bordered'>";
                    echo "<tr style='color:yellow'>";
                    echo "<th>Voter Id</th><th>Name</th><th>Password</th><th>Aadhar No</th><th>Gender</th><th>Type</th><th>Delete Records</th>";
                    echo "</tr>";
                    while($r=mysqli_fetch_array($resultset))
                    {
                        echo "<tr style='color:white'>";
                        echo "<td>$r[0]</td>";
                        echo "<td>$r[1]</td>";
                        echo "<td>$r[2]</td>";
                        echo "<td>$r[3]</td>";
                        echo "<td>$r[4]</td>";
                        echo "<td>$r[5]</td>";
                        echo "<td><a class='btn btn-danger' href='deletevoter.php?id=$r[0]'>Delete</a></td>";
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
    </body>
</html>
