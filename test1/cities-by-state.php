<?php
include_once "db_conn.php";
$state_id = $_POST["state_id"];
$result = mysqli_query($conn,"SELECT * FROM city where same = $state_id");
?>
<option value="">Select City</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row["id"];?>"><?php echo $row["city"];?></option>
<?php
}
?>