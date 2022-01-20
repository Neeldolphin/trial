<?php
	include 'db_conn.php';
	$name=$_POST['name'];
	$check= "SELECT * FROM course WHERE name ='$name'";
    $data=mysqli_query($conn,$check);
    $rs= mysqli_fetch_array($data,MYSQLI_NUM);
	if ($rs[0] > 1) {
        echo json_encode(array("statusCode"=>201));
    }
    else{
    $sql = "INSERT INTO course (name) VALUES ('$name')";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("statusCode"=>200));
    }
}
?>