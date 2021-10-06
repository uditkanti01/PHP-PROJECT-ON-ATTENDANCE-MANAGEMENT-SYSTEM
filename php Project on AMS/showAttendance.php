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
            <form action="index.php" method="Post">
                <table class="table table-striped">
                    <tr>
                    <th>Serial Number</th><th>Student Name</th><th>Roll Number</th><th>Attendance Status</th>
                    </tr>

                    <?php 
                    $date = $_POST['date'];
                    $result=mysqli_query($con,"SELECT * FROM `attendancerecords` WHERE `date`=STR_TO_DATE('$date','%Y-%m-%d')");
                    $serialnumber=0;
                    $counter=0;
                    while($row=mysqli_fetch_array($result))
                    {   
                        $serialnumber++;
                        
                        ?>
                        <tr><i class="mdi mdi-numeric-0-circle:"></i>
                        <td><?php echo $serialnumber; ?> </td>
                        <td><?php echo $row['student_name']; ?>
                        </td>
                        <td><?php echo $row['roll_number']; ?>
                        </td>
                        <td>
                            <?php 
                                if ($row['attendance_status']=="Present"){
                                    echo "Present";
                                } else {
                                    echo "Absent";
                                }
                            ?>
                        </td>
                        </tr>
                        <?php
                        $counter++;
                        }
                        ?>
                </table>
            </form>
        </div>
    </div>
</div>
