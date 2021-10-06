<?php
include('header.php');
include('db.php');

?>
<div class="panel panel-default">
<div class="panel panel-heading">
        <h2>
            <a href="add.php" class="btn btn-success">Add Student</a>
            <a href="index.php" class="btn btn-info pull-right"> Back </a>
        </h2>
        
        <div class="panel panel-body">
            b  
                <table class="table table-striped">
                    <tr>
                    <th>Serial Number</th> <th>Dates</th> <th>Show Attendance</th>
                    </tr>

                    <?php $result=mysqli_query($con,"select distinct date from attendancerecords");
                    $serialnumber=0;
                    $counter=0;
                    while($row=mysqli_fetch_array($result))
                    {   
                        $serialnumber++;
                        
                        ?>
                        <tr>
                        <td><?php echo $serialnumber; ?> </td>
                        <td><?php echo $row['date']; ?>
                        </td>
                        <td>
                        <form action="showAttendance.php" method="POST">
                        <input type="hidden"value="<?php echo $row['date'] ?>" name= "date">
                        <input type="submit" value="Show Attendance" class="btn btn-primary">
                        </form>
                        </td>
                        </tr>
                        <?php
                        }
                        ?>
                </table>
            </form>
        </div>
    </div>
</div>


    
