<?php
include("title.php");
include("bgcolor.php");
include("nav.php");
include("connections.php");
	$search = $type = $namesearch = "";
	$searchErr = "";
	$query = $count_query = "";
	if(isset($_POST["btnsearch"])){
		if(empty($_POST["search"])){
			$searchErr = "This field must not be empty.";
		}else{
			$search = $_POST["search"];
		}
		if($search){
			$c_search = strlen($search);
			if($c_search < 3){
				$searchErr = "ERROR(must have atleast three(3) characters long.).";
			}else{
				if($_POST["type"] == "Name Search"){
					$query = mysqli_query($connections,"SELECT * FROM client_info
						WHERE first_name LIKE '%$search%' OR middle_name LIKE '%$search%' OR last_name LIKE '%$search%'");
					$count_query = mysqli_query($connections,"SELECT COUNT(*) AS total FROM client_info
						WHERE first_name LIKE '%$search%' OR middle_name LIKE '%$search%' OR last_name LIKE '%$search%'");
				}
				if($_POST["type"] == "TIN Search"){
					$query = mysqli_query($connections,"SELECT * FROM client_info
						WHERE tin LIKE '%$search%'");
					$count_query = mysqli_query($connections,"SELECT COUNT(*) AS total FROM client_info
						WHERE tin LIKE '%$search%'");
				}
				if($_POST["type"] == "Business Search"){
					$query = mysqli_query($connections,"SELECT * FROM bus_info
						WHERE bus_name LIKE '%$search%' OR bus_nature LIKE '%$search%'");
					$count_query = mysqli_query($connections,"SELECT COUNT(*) AS total FROM bus_info
						WHERE bus_name LIKE '%$search%' OR bus_nature LIKE '%$search%'");
				}
				$rowcount = mysqli_fetch_assoc($count_query);
				$count = $rowcount["total"];
				if($count > 0){
					echo "
						<h3><b>Search Result(s) $count</h3>
						";	
?>
<table border="0" width="100%">
	<tr>
		<td><b>TIN</b></td>
		<td><b>Name</b></td>
		<td><b>Mobile Number</b></td>
		<td><b>Business Name</b></td>
		<td><b>Nature of Business</b></td>
		<td><b>Business Address</b></td>
		<td><center><b>Options</b></td>
	</tr>
	<tr>
		<td colspan="7"><hr></td>
	</tr>
<?php
				}else{
					echo "<center>
							<h2><b>No Result Found!</h2>
						</center>
					";
				}
				$full_name = "";
				while($row = mysqli_fetch_assoc($query)){
					$id = $row["id"];
					$querya = mysqli_query($connections, "SELECT * FROM client_info WHERE id='$id'");
					while($row = mysqli_fetch_assoc($querya)){
						$dbfirst_name = $row["first_name"];
						$dbmiddle_name = $row["middle_name"];
						$dblast_name = $row["last_name"];
						$dbtin = $row["tin"];
						$dbmobile = $row["mobile"];
						$full_name = ucfirst($dbfirst_name) . " " . ucfirst($dbmiddle_name[0]) . ". " . ucfirst($dblast_name);
					}
					$queryb = mysqli_query($connections, "SELECT * FROM bus_info WHERE id='$id'");
					while($row = mysqli_fetch_assoc($queryb)){
						$dbbus_name = $row["bus_name"];
						$dbnature = $row["bus_nature"];
						$dbbus_address = $row["bus_address"];
					}
					echo "
					<tr>
						<td>$dbtin</td>
						<td>$full_name</td>
						<td>$dbmobile</td>
						<td>$dbbus_name</td>
						<td>$dbnature</td>
						<td>$dbbus_address</td>
						<td>
							<a href='update.php? id=$id'><b><font color='black'>Update</font></b></a>
							|
							<a href='delete.php? id=$id'><b><font color='black'>Delete</font></b></a>
						</td>
					</tr>
					<tr>
						<td colspan='7'><hr></td>
					</tr>
					";
				}
			}
		}
	}
?>
</table>
<style>
.error{
	color:white;
}
</style>
<form method="POST">
<br>
<br>
<br>
<br>
	<center>
		<select name="type">
			<option name="type" <?php if ($type == "TIN Search"){ echo "selected"; } ?> value="TIN Search">TIN Search</option>
			<option name="type" <?php if ($type == "Name Search"){ echo "selected"; } ?> value="Name Search">Name Search</option>
			<option name="type" <?php if ($type == "Business Search"){ echo "selected"; } ?> value="Business Search">Business Search</option>
		</select><br>
		<input type="text" name="search" value="<?php $search ?>" placeholder="Search..."><span class="error"><br><?php echo $searchErr;?></span> <br>
		<input type="submit" name="btnsearch" value="Search">
	</center>
</form>