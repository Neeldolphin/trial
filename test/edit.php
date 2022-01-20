<?php
    include "db_conn.php";
 
    $id = $_POST['id'];
    $query="SELECT * from students WHERE id =".$id;
    $result = mysqli_query($conn,$query);
    $data = array();
    while ($cust = mysqli_fetch_assoc($result)) {
        $data[] = $cust;
    } 
    if($data) {
     echo json_encode($data);
    } else {
     echo "Error: " . $sql . "" . mysqli_error($conn);
    }
 
?>