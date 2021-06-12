<?php
include("title.php");
include("bgcolor.php");
include("nav.php");
include("connections.php");
?>
<table border="0" width="100%">
	<tr>
		<td colspan='5'><center><a href="clientlist.php"><font color='black'><<<</font></a>&nbsp;&nbsp;&nbsp;<b>Business Information</b></center></td>
	</tr>
	<tr>
		<td colspan='5'><hr></td>
	</tr>
	<tr>
		<td><b>Business Name</b></td>	
		<td><b>Business Address</b></td>
		<td><b>Nature of Business</b></td>
		<td><b>Date of Registration</b></td>
		<td><center><b>Options</b></center></td>
	</tr>
	<tr>
		<td colspan="5"><hr></td>
	</tr>
<?php
	$count_query = mysqli_query($connections,"SELECT COUNT(*) AS total FROM bus_info");
	$row_count = mysqli_fetch_assoc($count_query);
	$count = $row_count["total"];
	$view_query = mysqli_query($connections, "SELECT * FROM bus_info");
	while($row = mysqli_fetch_assoc($view_query)){
		$id = $row["id"];
		$dbbus_name = $row["bus_name"];
		$dbnature_of_business = $row["bus_nature"];
		$dbbus_address = $row["bus_address"];
		$dbdate_of_registration = $row["bus_DOR"];
		echo "
			<tr>
				<td>$dbbus_name</td>
				<td>$dbbus_address</td>
				<td>$dbnature_of_business</td>
				<td>$dbdate_of_registration</td>
				<td>
					<center>
							<a href='update.php? id=$id'><b><font color='black'>Update</font></b></a>
							|
							<a href='delete.php? id=$id'><b><font color='black'>Delete</font></b></a>
					</center>
				</td>
			</tr>
			<tr>
				<td colspan='5'><hr></td>
			</tr>
		";
	}
	echo "<tr>
				<td colspan='5'><center><b>Number of Records: $count</center></td>
		<tr>
		";
?>
</table>