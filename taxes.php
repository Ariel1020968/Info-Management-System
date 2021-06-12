<?php
include("title.php");
include("bgcolor.php");
include("nav.php");
include("connections.php");
?>
<table border="0" width="100%">
	<brs>
	<br>
	<br>
	<tr>
		<td colspan='2'><center><b>Client Information</center></td>
		<td colspan='2'><center><b>Business Information</center></td>
		<td colspan='4'><center><b>Taxes</center></td>
	</tr>
	<tr>
		<td colspan="9"><hr></td>
	</tr>
	<tr>
		<td><b>Name</b></td>
		<td><b>Address</b></td>
		<td><b>Business Name</b></td>	
		<td><b>Business Address</b></td>
		<td><b>First Quarter</b></td>	
		<td><b>Second Quarter</b></td>	
		<td><b>Third Quarter</b></td>	
		<td><b>Annual</b></td>	
		<td colspan='1'><center><b>Options</center></td>
	</tr>
	<tr>
		<td colspan="9"><hr></td>
	</tr>
<?php
	$count_query = mysqli_query($connections,"SELECT COUNT(*) AS total FROM client_info");
	$row_count = mysqli_fetch_assoc($count_query);
	$count = $row_count["total"];
	$full_name = "";
	$view_query = mysqli_query($connections, "SELECT * FROM client_info");
	while($row = mysqli_fetch_assoc($view_query)){
		$id = $row["id"];
		$querya = mysqli_query($connections, "SELECT * FROM client_info WHERE id='$id'");
		while($row = mysqli_fetch_assoc($querya)){
			$dbfirst_name = $row["first_name"];
			$dbmiddle_name = $row["middle_name"];
			$dblast_name = $row["last_name"];
			$dbaddress = $row["address"];
			$full_name = $full_name = ucfirst($dbfirst_name) . " " . ucfirst($dbmiddle_name[0]) . ". " . ucfirst($dblast_name);
		}
		$queryb = mysqli_query($connections, "SELECT * FROM bus_info WHERE id='$id'");
		while($row = mysqli_fetch_assoc($queryb)){
			$dbbus_name = $row["bus_name"];
			$dbbus_address = $row["bus_address"];
		}
		$queryc = mysqli_query($connections, "SELECT * FROM taxes WHERE id='$id'");
		while($row = mysqli_fetch_assoc($queryc)){
			$dbfirstq = $row["firstq"];
			$dbsecondq = $row["secondq"];
			$dbthirdq = $row["thirdq"];
			$dbannual = $row["annual"];
		}
		echo "
			<tr>
				<td>$full_name</td>
				<td>$dbaddress</td>
				<td>$dbbus_name</td>
				<td>$dbbus_address</td>
				<td>$dbfirstq</td>
				<td>$dbsecondq</td>
				<td>$dbthirdq</td>
				<td>$dbannual</td>
				<td>
					<center>
							<a href='updatetaxes.php? id=$id'><b><font color='black'>Update</font></b></a>
							|
							<a href='emptytax.php? id=$id'><b><font color='black'>Empty</font></b></a>
					</center>
				</td>
			</tr>
			<tr>
				<td colspan='9'><hr></td>
			</tr>
		";
	}
	
	echo "<tr>
			<td colspan='8'><center><b>Number of Record is $count</center></td>
		<tr>";
?>
</table>