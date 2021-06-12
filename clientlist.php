<?php
include("title.php");
include("bgcolor.php");
include("nav.php");
include("connections.php");
?>
<table border="0" width="100%">
	<tr>
		<td colspan='8'><center><b>Client Information</b> &nbsp; &nbsp;&nbsp; <a href="bus_info.php"><font color='black'>>>></font></a></center></td>
	</tr>
	<tr>
		<td colspan="8"><hr></td>
	</tr>
	<tr>
		<td><b>TIN</b></td>
		<td><b>Name</b></td>
		<td><b>Address</b></td>
		<td><b>Gender</b></td>
		<td><b>Status</b></td>
		<td><b>Birthday</b></td>
		<td><b>Mobile Number</b></td>
		<td><center><b>Options</b></center></td>
	</tr>
	<tr>
		<td colspan="8"><hr></td>
	</tr>
<?php
	$count_query = mysqli_query($connections,"SELECT COUNT(*) AS total FROM client_info");
	$row_count = mysqli_fetch_assoc($count_query);
	$count = $row_count["total"];
	$full_name = "";
	$view_query = mysqli_query($connections, "SELECT * FROM client_info");
	while($row = mysqli_fetch_assoc($view_query)){
		$id = $row["id"];
		$dbfirst_name = $row["first_name"];
		$dbmiddle_name = $row["middle_name"];
		$dblast_name = $row["last_name"];
		$dbaddress = $row["address"];
		$dbgender = $row["gender"];
		$dbstatus = $row["status"];
		$dbbirthday = $row["birthday"];
		$dbtin = $row["tin"];
		$dbmobile = $row["mobile"];
		$full_name = ucfirst($dbfirst_name) . " " . ucfirst($dbmiddle_name[0]) . ". " . ucfirst($dblast_name);
		echo "
			<tr>
				<td>$dbtin</td>
				<td>$full_name</td>
				<td>$dbaddress</td>
				<td>$dbgender</td>
				<td>$dbstatus</td>
				<td>$dbbirthday</td>
				<td>$dbmobile</td>
				<td>
					<center>
							<a href='update.php? id=$id'><b><font color='black'>Update</font></b></a>
							|
							<a href='delete.php? id=$id'><b><font color='black'>Delete</font></b></a>
					</center>
				</td>
			</tr>
			<tr>
				<td colspan='8'><hr></td>
			</tr>
		";
	}
	echo "<tr>
				<td colspan='8'><center><b>Number of Records: $count</center></td>
		<tr>
		";
?>
</table>