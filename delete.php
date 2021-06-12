<?php
include("title.php");
include("bgcolor.php");
include("connections.php");
$id = $_GET["id"];
$get_recorda = mysqli_query($connections, "SELECT * FROM client_info WHERE id='$id'");
$get_recordb = mysqli_query($connections, "SELECT * FROM bus_info WHERE id='$id'");
$get_recordc = mysqli_query($connections, "SELECT * FROM taxes WHERE id='$id'");
$check_get_recorda = mysqli_num_rows($get_recorda);
$check_get_recordb = mysqli_num_rows($get_recordb);
$check_get_recordc = mysqli_num_rows($get_recordc);
	if(($check_get_recorda > 0) or ($check_get_recordb > 0) or ($check_get_recordc > 0)){
		$row = mysqli_fetch_assoc($get_recorda);
		$dbfirst_name = $row["first_name"];
		$dbmiddle_name = $row["middle_name"];
		$dblast_name = $row["last_name"];
		$full_name = ucfirst($dbfirst_name) . " " . ucfirst($dbmiddle_name[0]) . ". " . ucfirst($dblast_name);
		if(isset($_POST["btndelete"])){
			mysqli_query($connections, "DELETE FROM client_info WHERE id='$id'");
			mysqli_query($connections, "DELETE FROM bus_info WHERE id='$id'");
			mysqli_query($connections, "DELETE FROM taxes WHERE id='$id'");
			header("Location: index.php");
		}
?>
<form method="POST">
	<h1>You are about to DELETE <font color="white"><?php echo $full_name ?></font></h1>
	<h3>Are you sure?</h3>
	<input type="submit" name="btndelete" value="Delete" >
	&nbsp;
	<a href="clientlist.php">Cancel</a>
</form>
<?php
	}else{
		echo "<h1>404 Page Not Found.</h1>";
	}
?>