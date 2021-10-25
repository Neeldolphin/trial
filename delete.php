<?php
include "db_conn.php";

$id = $_POST['id'];
$query = "DELETE FROM students WHERE id=".$id;
$result =mysqli_query($conn,$query);
echo 1;
// if($result) {
//  echo json_encode($result);
// } else {
//  echo "Error: " . $sql . "" . mysqli_error($conn);
// }
?>
