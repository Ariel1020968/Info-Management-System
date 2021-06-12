<?php 
include("title.php");
include("bgcolor.php");
include("connections.php");
$id = $_GET["id"];
$get_record = mysqli_query($connections, "SELECT * FROM taxes WHERE id='$id'");
$get_record_num = mysqli_num_rows($get_record);
if($get_record_num > 0){
	while($row = mysqli_fetch_assoc($get_record)){
		$dbfirst = $row["firstq"];
		$dbsecond = $row["secondq"];
		$dbthird = $row["thirdq"];
		$dbannual = $row["annual"];
	}
	$full_name ="";
	$view_query = mysqli_query($connections, "SELECT * FROM client_info  WHERE id='$id'");
	while($row = mysqli_fetch_assoc($view_query)){
		$id = $row["id"];
		$dbfirst_name = $row["first_name"];
		$dbmiddle_name = $row["middle_name"];
		$dblast_name = $row["last_name"];
		$full_name = ucfirst($dbfirst_name) . " " . ucfirst($dbmiddle_name[0]) . ". " . ucfirst($dblast_name);
		echo "<center>
			<tr>
				<td><h2>$full_name</h2></td>
			</tr>
			</center>";
	}
	$newfirst = $newsecond = $newthird = $newannual = "";
	$newfirstErr = $newsecondErr = $newthirdErr = "";
?>
<style>
.error{
	color:white;
}
</style>
<form method="POST" >
	<table border="0" width="60%" align="center">
	<br>
	<br>
	<br>
		<tr>
			<td><center>First Quarter</center></td>
			<td><center>Second Quarter</center></td>
			<td><center>Third Quarter</center></td>
			<td><center>Annual</center></td>
		</tr>
		<tr>
			<td><center><input type="number_format" name="first" value="<?php echo $dbfirst ?>"><span class="error"><?php echo $newfirstErr;?></span></center></td>
			<td><center><input type="number_format" name="second" value="<?php echo $dbsecond ?>"><span class="error"><?php echo $newsecondErr;?></span></center></td>
			<td><center><input type="number_format" name="third" value="<?php echo $dbthird ?>"></td>
			<td><center><input type="number_format" name="annual" value="<?php echo $dbannual ?>"></center></td>
		</tr>
		<?php
		if(isset($_POST["btnsave"])){
			if (($_POST["third"]) > 0){
				$newthird = $_POST["third"];
				$dbthird = $newthird;
				if($_POST["second"] > 0){
					$newsecond = $_POST["second"];
					$dbsecond = $newsecond;
					if($_POST["first"] > 0){
						$newfirst = $_POST["first"];
						$dbfirst = $newfirst;
					}else{
						$newfirstErr = "This Field is Empty.";
					}
				}else{
					$newsecondErr = "This Field is Empty.";
				}
				if (($newfirst > 0) && ($newsecond > 0) && ($newthird > 0)){
					$newannual = $dbfirst + $dbsecond + $dbthird;
					$dbannual = $newannual;
					mysqli_query($connections, "UPDATE taxes SET
						firstq='$dbfirst',
						secondq='$dbsecond',
						thirdq='$dbthird',
						annual='$dbannual'
						WHERE id='$id'");
					header("Location: taxes.php");
				}else{
					$dbannual = 0;
				}
			}else{
				if(($_POST["second"]) > 0){
					$newsecond = $_POST["second"];
					$dbsecond = $newsecond;
					if($_POST["first"] > 0 ){
						$newfirst = $_POST["first"];
						$dbfirst = $newfirst;
					}else{
						$newfirstErr = "This Field is Empty.";
					}
					$dbthird = 0;
					$dbannual = 0;
					if(($newfirst > 0) && ($newsecond > 0)){
						mysqli_query($connections, "UPDATE taxes SET
						firstq='$dbfirst',
						secondq='$dbsecond',
						thirdq='$dbthird',
						annual='$dbannual'
						WHERE id='$id'");
					header("Location: taxes.php");
					}
				}else{
					if($_POST["first"] > 0 ){
						$dbannual = 0;
						$newfirst = $_POST["first"];
						$dbfirst = $newfirst;
						$newsecond = $_POST["second"];
						$dbsecond = $newsecond;
						mysqli_query($connections, "UPDATE taxes SET
							firstq='$dbfirst',
							secondq='$dbsecond',
							thirdq='$dbthird',
							annual='$dbannual'
							WHERE id='$id'");
						header("Location: taxes.php");
					}
				}
			}
		}
		echo "<tr>
				<td>
					<center>
						<span class='error'>
							$newfirstErr
						</span>
					</center>
				</td>
				<td>
					<center>
						<span class='error'>
							$newsecondErr
						</span>
					</center>
				</td>
			</tr>";
		?>
	</table>
		<br>
		<center>
			<input type="submit" name="btnsave" value="	Save	"> &nbsp;
			<a href="taxes.php">Cancel</a>
		</center>
</form>
<?php
}else{
	echo "<h1>No Record Found.</h1>";
}
?>