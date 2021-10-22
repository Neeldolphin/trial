<?php
	include 'db_conn.php';
	$sql = "SELECT * FROM course";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
?>	
		<tr>
			<td><?=$row['name'];?></td>
			<td><button type="button" class="btn btn-success btn-sm update" data-toggle="modal" data-keyboard="false" data-backdrop="static" data-target="#update_country"
			data-id="<?=$row['id'];?>"data-name="<?=$row['name'];?>">Edit</button>
			<button type="button" class="btn btn-success btn-sm delete" data-toggle="modal" data-keyboard="false" data-backdrop="static" data-target="#delete_country"
			data-id="<?=$row['id'];?>"data-name="<?=$row['name'];?>">Delete</button></td>
		</tr>
<?php	
	}
	}
	else {
		echo "<tr >
		<td colspan='5'>No Result found !</td>
		</tr>";
	}
	mysqli_close($conn);
?>
