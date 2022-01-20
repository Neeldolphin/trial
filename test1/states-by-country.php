<?php
include_once "db_conn.php";
$country_id = $_POST["country_id"];
$result = mysqli_query($conn,"SELECT * FROM state where same = $country_id");
?>
<option value="">Select State</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row["id"];?>"><?php echo $row["state"];?></option>
<?php
}
?>