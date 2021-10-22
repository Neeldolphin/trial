<?php    
include "db_conn.php";
if(!empty($_POST['id'])){
     $fname = $_POST['fname'];
     $lname = $_POST['lname'];
     $birthdate = $_POST['birthdate'];
     $mobile_number =$_POST['mobile_number'];
     $email = $_POST['email'];
     $course = $_POST['course'];
    $da=date("Y/m/d");
    $query = "UPDATE students SET fname='" . $_POST['fname'] . "', lname='". $_POST['lname'] . "', birthdate='" .$_POST['birthdate']."', mobile_number='" .$_POST['mobile_number']."', email='" . $_POST['email'] . "',course='" .$_POST['course']."',updatedate='$da' WHERE id=".$_POST['id'];
    $result = mysqli_query($conn, $query);
    }
if($result) {
     echo 1;
    } else {
     echo "Error: " . $sql . "" . mysqli_error($conn);
    }

?>