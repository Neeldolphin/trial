<?php
    include 'db_conn.php';  
    $id=$_POST['id'];
    $name=$_POST['name'];
    $check= "SELECT * FROM course WHERE name ='$name'";
    $data=mysqli_query($conn,$check);
    $rs= mysqli_fetch_array($data,MYSQLI_NUM);
    if ($rs[0] > 1) {
        echo json_encode(array("statusCode"=>201));
    }
    else{
    $sql = "UPDATE course SET name='$name' WHERE id=".$id;
    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("statusCode"=>200));
    }
}
?>