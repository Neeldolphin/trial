<!DOCTYPE html>
<html>
<head>
  <title>Display all records from Database</title>
</head>
<body>
<table width = "100%" border = "1" cellspacing = "1" cellpadding = "1">
  <tr>    
                <td>Id</td>    
                <td>First Name</td>       
                <td>Last Name</td>    
                <td>Birthdate</td>    
                <td>Mobile Number</td>    
                <td>Email</td>    
                <td>Course</td>        
                <td>Created Date</td>    
                <td>Updated Date</td>    
                <td colspan = "2">Action</td>    
            </tr> 
<?php    
include_once "db_conn.php"; 
if(isset($_POST))
{    
    $fname = $_POST['fname'];
     $lname = $_POST['lname'];
     $date = $_POST['date'];
     $m_number =$_POST['m_number'];
     $email = $_POST['email'];
     $course = $_POST['course'];
     $sql = "INSERT INTO STUDENTS (FirstName,LastName,Birthdate,MobileNumber,Email,Course) VALUES ('$fname','$lname','$date','$m_number','$email','$course')"; 
     $d = mysqli_query($conn, $sql); 
     $e = mysqli_query($conn,"SELECT * FROM STUDENTS");
     while($f = mysqli_fetch_array($e))
      {
?>   
<tr>
    <td><?php echo $f['Id']; ?></td>
    <td><?php echo $f['FirstName']; ?></td>
    <td><?php echo $f['LastName']; ?></td>
    <td><?php echo $f['Birthdate']; ?></td>
    <td><?php echo $f['MobileNumber']; ?></td>
    <td><?php echo $f['Email']; ?></td>
    <td><?php echo $f['Course']; ?></td>
    <td><?php echo $f['Createddate']; ?></td>
    <td><?php echo $f['updatedate']; ?></td>
    <td><a href='' onclick="return confirm('Are You Sure')">Edit</a> |<a href=''onclick="return confirm('Are You Sure')">Delete</a> </td>
  </tr> 
<?php 
}
}
?>
</table>
</body>
</html>