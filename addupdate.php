<?php
if(count($_POST)>0)
{    
    include "db_conn.php";
     
     $fname = $_POST['fname'];
     $lname = $_POST['lname'];
     $birthdate = $_POST['birthdate'];
     $mobile_number =$_POST['mobile_number'];
     $email = $_POST['email'];
     $course = $_POST['course'];
     $da=date("Y/m/d");

     if(empty($_POST['id'])){
 
      $query = "INSERT INTO students (fname,lname,birthdate,mobile_number,email,course,Createddate)
      VALUES ('$fname','$lname','$birthdate','$mobile_number','$email',$course,'$da')";
      $result = mysqli_query($conn, $query); 
     echo 1;
     }else{ 
     echo 0;
     }
}
?>