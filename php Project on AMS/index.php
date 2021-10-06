<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ams</title>

</head>
<body>
    <?php 
    include('header.php');
    include('db.php');
        $flag=0;
        $update=0;
        if(isset($_POST['submit']))
        {
            $date=date("Y-m-d");
            $records=mysqli_query($con,"SELECT * FROM `attendancerecords` WHERE `date`='$date'");
            
            $num=mysqli_num_rows($records);

            if($num){
                foreach($_POST['attendance_status'] as $id=>$attendance_status)
                {
                    $student_name=$_POST['student_name'][$id];
                    $roll_number=$_POST['roll_number'][$id];
                    $date=date("Y-m-d");

                    $result=mysqli_query($con,"update attendancerecords set student_name='$student_name', roll_number='$roll_number', attendance_status='$attendance_status' where date='$date' AND roll_number='$roll_number'");
                    if($result)
                    {
                        $update=1;
                    }
                }
            }
            else
            {

                foreach($_POST['attendance_status'] as $id=>$attendance_status)
                {
                    $student_name=$_POST['student_name'][$id];
                    $roll_number=$_POST['roll_number'][$id];
                    $date=date("Y-m-d");

                    $result=mysqli_query($con,"INSERT INTO attendancerecords(student_name,roll_number,attendance_status,date) VALUES('$student_name','$roll_number','$attendance_status','$date')");
                    if($result)
                    {
                        $flag=1;
                    }
                }
            }
        }
    ?>
    
<div class="panel panel-default">    
    <div class="panel panel-heading">
        <h2>
            <a href="add.php" class="btn btn-success">Add Student</a>
            <a href="viewall.php" class="btn btn-info pull-right">Veiw All </a>
        </h2>

        <?php if ($flag){ ?>
        <div class="alert alert-success">
            Student Attendance recorded Successfully.
        </div>
        <?php } ?>

        <?php if ($update){ ?>
        <div class="alert alert-success">
            Student Attendance updated Successfully.
        </div>
        <?php } ?>
        <h3>
            <div class="well text-center">
                Date: <?php echo date("Y-m-d"); ?>
            </div>
        </h3>
        <div class="panel panel-body">
            <form action="index.php" method="Post">
                <table class="table table-striped">
                    <tr>
                    <th>Serial Number</th><th>Student Name</th><th>Roll Number</th><th>Attendance Status</th>
                    </tr>

                    <?php $result=mysqli_query($con,"select * from attendance");
                    $serialnumber=0;
                    $counter=0;
                    while($row=mysqli_fetch_array($result))
                    {   
                        $serialnumber++;
                        
                        ?>
                        <tr><i class="mdi mdi-numeric-0-circle:"></i>
                        <td><?php echo $serialnumber; ?> </td>
                        <td><?php echo $row['student_name']; ?>
                        <input type="hidden" value="<?php echo $row['student_name']; ?>" name="student_name[]">
                        </td>
                        <td><?php echo $row['roll_number']; ?>
                        <input type="hidden" value="<?php echo $row['roll_number']; ?>" name="roll_number[]">    
                        </td>
                        <td>
                            <input type="radio" name="attendance_status[<?php echo $counter; ?>]" value="Present">Present
                            <input type="radio" name="attendance_status[<?php echo $counter; ?>]" value="Absent">Absent

                        </td>
                        </tr>
                        <?php
                        $counter++;
                        }
                        ?>
                </table>

                <input type="submit" name="submit" value="submit" class="btn btn">
            </form>
        </div>
    </div>
</div>


    
</body>
</html>