<?php
session_start();
$msg="";
if(isset($_POST['save'])){
    $name=$_POST['candname'];
    $path="";
    if($_FILES['candimg']['error']==0){
        $from=$_FILES['candimg']['tmp_name'];
        $to=$_SERVER['DOCUMENT_ROOT']."/OnlineVoting/pics/".$_FILES['candimg']['name'];
        move_uploaded_file($from,$to);
        $path="pics/".$_FILES['candimg']['name'];
    }
      $catg=$_POST['categ'];
    $pid=$_POST['pid'];
    $link=mysqli_connect("localhost","root","","votingDB");
    $qry="insert into candidate(c_name,c_image,cid,pid) values('$name','$path',$catg,$pid)";
    mysqli_query($link,$qry);
    if(mysqli_affected_rows($link)>0)
        $msg="Candidate Register Successfully";
    else
        $msg="Error in Registration";
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
                    <h3 style="color:white;">Candidate Form</h3>
                    <hr>
                    <div class="form-group">
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="pid" value="<?php echo $_GET['id']; ?>" />
                        <label style="color:white;">Candidate Name</label>
                        <input required class="form-control" type="text" name="candname" value=""/><br>
                        <label style="color:white;">Candidate Image</label>
                        <input required class="form-control" type="file" name="candimg" value=""/><br>
                        <label style="color:white;">Select Category</label>
                        <select required class="form-control" name="categ">
                            <option></option>
                        <?php
                        
                        $link = mysqli_connect("localhost","root","","votingDB");
                        $qry="select * from category";
                        $resultset=mysqli_query($link,$qry);
                        if(mysqli_num_rows($resultset)>0){
                        while($r=mysqli_fetch_array($resultset)){
        
                            echo "<option value='$r[0]'>$r[1]</option>";
                        }
                        }
                        mysqli_close($link);
                        ?>
                       </select>
                        
                       
                        <br>
                        <input class="btn btn-success" type="submit" name="save" value="Save"/>
                        <br><br>
                        <?php
                        echo "<font color= #42f560>$msg</font>";
                        ?>
                    </form>
                    </div>
                </div>
                <div col-sm-1></div>
                <div class="col-sm-7" style="margin-left:20px;">
                    <h3 style="color:white;">View Candidates</h3>
                    <hr>
                    <br>
                    <?php
                $link = mysqli_connect("localhost","root","","votingDB");
                $qry="select * from candidate";
                $resultset=mysqli_query($link,$qry);
                if(mysqli_num_rows($resultset)>0){
                    echo "<div class='table-responsive'>";
                    echo "<table class='table table-bordered'>";
                    echo "<tr style='color:yellow'>";
                    echo "<th>Candidate Id</th><th>Candidate Name</th><th>Candidate Image</th><th>CId</th><th>PId</th><th>Delete Records</th>";
                    echo "</tr>";
                    while($r=mysqli_fetch_array($resultset))
                    {
                        echo "<tr style='color:white'>";
                        echo "<td>$r[0]</td>";
                        echo "<td>$r[1]</td>";
                        echo "<td>$r[2]</td>";
                        echo "<td>$r[3]</td>";
                        echo "<td>$r[4]</td>";
                        echo "<td><a class='btn btn-danger' href='deletecandidate.php?id=$r[0]'>Delete</a></td>";
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
