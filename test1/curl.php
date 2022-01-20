<?php
$url = "https://api.publicapis.org/entries"; 

$handle = curl_init();

curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($handle, CURLOPT_URL,$url);

$result = file_get_contents($url);
$ashlo = json_decode($result,true);
$result=curl_exec($handle);
$rows=$ashlo[entries];

$Category = array();

foreach($rows as $row) {
			if(!in_array($row[Category], $Category, true)){
        		array_push($Category, $row[Category]);
        		?>
	<html>
	<head>
		<h2><?php echo $row[Category];?></h2>
	<style>
		table, th, td {
  		background-color: lightgrey;
  		margin: auto;
  		border: 2px solid green;
  		padding: 10px;
  		text-align: center;
  		 margin-left: auto;
  		margin-right: auto;
		}
}

	</style>
	</head>
	<body>
<?php
    			}  
			} 

foreach($Category as $Cate){
	?>
<table>
	<br>
<td colspan="7" style="background-color: green;"><?php echo $Cate; ?></td>
	<tr>
    <th>API</th>
    <th>Description</th>
    <th>Auth</th>
    <th>HTTPS</th>
    <th>Cors</th>
    <th>Link</th>
    <th>Category</th> 
</tr>
		<?php
	foreach($rows as $row) {
	 if($Cate == $row[Category]){
	    ?>
	   
	    <tr>
	    <td><?php echo $row[API]; ?></td>
	    <td><?php echo $row[Description]; ?></td>
	    <td><?php echo $row[Auth]; ?></td>
	    <td><?php echo $row[HTTPS]; ?></td>
	    <td><?php echo $row[Cors]; ?></td>
	    <td><?php echo $row[Link]; ?></td>
	    <td><?php echo $row[Category]; ?></td></tr>	
		<?php
			 		}
				}
			}
		?>	
</table>
</body>
</html>


<?php
curl_close($handle);
?>


