<?php
include("connections.php");
include("bgcolor.php");
$id = $_GET["id"];
$get_recorda = mysqli_query($connections, "SELECT * FROM client_info WHERE id='$id'");
$get_record = mysqli_query($connections, "SELECT * FROM taxes WHERE id='$id'");
$check_get_recorda = mysqli_num_rows($get_recorda);
$check_get_record = mysqli_num_rows($get_record);
	if(($check_get_recorda > 0) and ($check_get_record > 0)){
		$row = mysqli_fetch_assoc($get_recorda);
		$dbfirst_name = $row["first_name"];
		$dbmiddle_name = $row["middle_name"];
		$dblast_name = $row["last_name"];
		$full_name = ucfirst($dbfirst_name) . " " . ucfirst($dbmiddle_name[0]) . ". " . ucfirst($dblast_name);
		if(isset($_POST["btnempty"])){
			mysqli_query($connections, "UPDATE taxes SET
				firstq= 0.00,
				secondq= 0.00,
				thirdq= 0.00,
				annual= 0.00
				WHERE id='$id'");
			header("Location: taxes.php");
		}
?>
<form method="POST">
	<h1>You are about to return tax record of <font color="white"><?php echo $full_name ?> to Zero(0)</font></h1>
	<h3>Are you sure?</h3>
	<input type="submit" name="btnempty" value="Empty Now" >
	&nbsp;
	<a href="taxes.php">Cancel</a>
</form>
<?php
	}else{
		echo "<h1>404 Page Not Found.</h1>";
	}
?>