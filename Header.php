<div class="row">
     
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" style="margin-left:150px;font-size:30px;color:yellow;font-family:Times New Roman;font-weight: bold;">e-Voting</a> 
                <label style='padding-left:90px;padding-top:10px;color:tomato;font-size:22px;font-family:cursive'>
                <?php
                if(isset($_SESSION['uname'])){
                echo "Welcome ".$_SESSION['uname'];
                }
                ?>
                </label>
             </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="index.php">Home</a></li>
                
                <?php
                if(isset($_SESSION['utype'])){
                    echo "<li class='active'><a href='vote.php'>Vote</a></li>";
                    if($_SESSION['utype']=='Admin'){
                   echo "<li class='active dropdown'>";
                   echo "<a class='dropdown-toggle' data-toggle='dropdown' href='#'>Admin";
                   echo "<span class='caret'></span></a>";    
                   echo "<ul class='dropdown-menu'>";   
                   echo "<li><a href='category.php'>Category List</a></li>";       
                   echo "<li><a href='votingList.php'>Voting List</a></li>";       
                   echo "<li><a href='viewVoters.php'>View Voters</a></li>";       
                   echo "<li><a href='newRegister.php'>Add New Voter</a></li>";        
                   echo "</ul>";     
                   echo "</li>";
                    }
                }
                        ?>
                <li class="active"><a href="result.php">View Result</a></li>
                <?php
                if(isset($_SESSION['uname'])){
                    echo"<li class='active'><a href='logout.php'>Logout</a></li>";
                }
                ?>
                
                <li>&nbsp;&nbsp;&nbsp;</li><li>&nbsp;&nbsp;&nbsp;</li><li>&nbsp;&nbsp;&nbsp;</li>
            </ul> 
        </div>
    </nav>
    <div>
