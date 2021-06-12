<?php 
include("title.php");
include("bgcolor.php");
include("connections.php");
	$id = $_GET["id"];
	$get_recorda = mysqli_query($connections, "SELECT * FROM client_info WHERE id='$id'");
	$get_recordb = mysqli_query($connections, "SELECT * FROM bus_info WHERE id='$id'");
	$get_record_numa = mysqli_num_rows($get_recorda);
	$get_record_numb = mysqli_num_rows($get_recordb);
	if(($get_record_numa > 0) or ($get_record_numb > 0)){
		while($row = mysqli_fetch_assoc($get_recorda)){
			$dbfirst_name = $row["first_name"];
			$dbmiddle_name = $row["middle_name"];
			$dblast_name = $row["last_name"];
			$dbaddress = $row["address"];
			$dbgender = $row["gender"];
			$dbstatus = $row["status"];
			$dbbirthday = $row["birthday"];
			$dbTIN = $row["tin"];
			$dbmobile = $row["mobile"];
		}
		while($row = mysqli_fetch_assoc($get_recordb)){
			$dbbus_name = $row["bus_name"];
			$dbbus_address = $row["bus_address"];
			$dbbus_nature = $row["bus_nature"];
			$dbbus_DOR = $row["bus_DOR"];
		}
		$newfirst_name = $newmiddle_name = $newlast_name = $newaddress = $newgender = $newstatus = $newbirthday = 
		$newbus_name = $newbus_nature = $newbus_address = $newbus_DOR = $newTIN = $newmobile = "";
		$newfirst_nameErr = $newmiddle_nameErr = $newlast_nameErr = $newaddressErr = $newgenderErr = $newstatusErr = $newbirthdayErr = 
		$newbus_nameErr = $newbus_natureErr = $newbus_addressErr = $newbus_DORErr = $newTINErr = $newmobileErr = "";
		if(isset ($_POST["btn_update"])){
			if (empty($_POST["newfirst_name"])){
				$newfirst_nameErr = "This field must not be empty!";
			}else{
				$newfirst_name = $_POST["newfirst_name"];
				$dbfirst_name = $newfirst_name;
			}
			if (empty($_POST["newmiddle_name"])){
				$newmiddle_nameErr = "This field must not be empty!";
			}else{
				$newmiddle_name = $_POST["newmiddle_name"];
				$dbmiddle_name = $newmiddle_name;
			}
				if (empty($_POST["newlast_name"])){
				$newlast_nameErr = "This field must not be empty!";
			}else{
				$newlast_name = $_POST["newlast_name"];
				$dblast_name = $newlast_name;
			}
				if (empty($_POST["newaddress"])){
				$newaddressErr = "This field must not be empty!";
			}else{
				$newaddress = $_POST["newaddress"];
				$dbaddress = $newaddress;
			}
				if (empty($_POST["newgender"])){
				$newgenderErr = "This field must not be empty!";
			}else{
				$newgender = $_POST["newgender"];
				$dbgender = $newgender;
			}
				if (empty($_POST["newstatus"])){
				$newstatusErr = "This field must not be empty!";
			}else{
				$newstatus = $_POST["newstatus"];
				$dbstatus = $newstatus;
			}
				if (empty($_POST["newbirthday"])){
				$newbirthdayErr = "This field must not be empty!";
			}else{
				$newbirthday = $_POST["newbirthday"];
				$dbbirthday = $newbirthday;
			}
				if (empty($_POST["newbus_name"])){
				$newbus_nameErr = "This field must not be empty!";
			}else{
				$newbus_name = $_POST["newbus_name"];
				$dbbus_name = $newbus_name;
			}
				if (empty($_POST["newbus_nature"])){
				$newbus_natureErr = "This field must not be empty!";
			}else{
				$newbus_nature = $_POST["newbus_nature"];
				$dbbus_nature = $newbus_nature;
			}
				if (empty($_POST["newbus_address"])){
				$newbus_addressErr = "This field must not be empty!";
			}else{
				$newbus_address = $_POST["newbus_address"];
				$dbbus_address = $newbus_address;
			}
				if (empty($_POST["newbus_DOR"])){
				$newbus_DORErr = "This field must not be empty!";
			}else{
				$newbus_DOR = $_POST["newbus_DOR"];
				$dbbus_DOR = $newbus_DOR;
			}
				if (empty($_POST["newTIN"])){
				$newTINErr = "This field must not be empty!";
			}else{
				$newTIN = $_POST["newTIN"];
				$dbTIN = $newTIN;
			}
				if (empty($_POST["newmobile"])){
				$newmobileErr = "This field must not be empty!";
			}else{
				$newmobile = $_POST["newmobile"];
				$dbmobile = $newmobile;
			}
			if($newfirst_name && $newmiddle_name && $newlast_name && $newaddress && $newgender && $newstatus && $newbirthday && $newbus_name && $newbus_nature && $newbus_address && $newbus_DOR && $newTIN && $newmobile){
				$c_newfirst_name = strlen($newfirst_name);
				if($c_newfirst_name < 2){
					$newfirst_nameErr = "Your first name is too short.";
				}else{
					$c_newmiddle_name = strlen($newmiddle_name);
				if($c_newmiddle_name < 2){
					$newmiddle_nameErr = "Your middle name is too short.";
				}else{
					$c_newlast_name = strlen($newlast_name);
				if($c_newlast_name < 2){
					$newlast_nameErr = "Your last name is too short.";
				}else{
					$c_newaddress = strlen($newaddress);
				if($c_newaddress < 5){
					$newaddressErr = "Your address is too short.";
				}else{
					$c_newbus_name = strlen($newbus_name);
				if($c_newbus_name < 5){
					$newbus_nameErr = "Your Business Name is too short.";
				}else{
					$c_newbus_nature = strlen($newbus_nature);
				if($c_newbus_nature < 5){
					$newbus_natureErr = "Your business Nature is too short.";
				}else{
					$c_newbus_address = strlen($newbus_address);
				if($c_newbus_address < 5){
					$newbus_addressErr = "Your Business Address is too short.";
				}
					$c_newTIN = strlen($newTIN);
				if($c_newTIN < 11){
					$newTINErr = "Your TIN number is too short.";
				}else{
					$c_newmobile = strlen($newmobile);
				if($c_newmobile < 11){
					$newmobileErr = "Your mobile number is too short.";
				}else{
					mysqli_query($connections, "UPDATE client_info SET
					first_name='$dbfirst_name',
					middle_name='$dbmiddle_name',
					last_name='$dblast_name',
					address='$dbaddress',
					gender='$dbgender',
					status='$dbstatus',
					birthday='$dbbirthday',
					tin='$dbTIN',
					mobile='$dbmobile'
					WHERE id='$id'
					");
					mysqli_query($connections, "UPDATE bus_info SET
					bus_name='$dbbus_name',
					bus_nature='$dbbus_nature',
					bus_address='$dbbus_address',
					bus_DOR='$dbbus_DOR'
					WHERE id='$id'
					");
					header("Location: clientlist.php");
				}}}}}}}}
			}
		}
?>
<style>
.error{
	color:black;
}
</style>
	<form method="POST" align="center">
	<br>
	<br>
	<input type="text" name="newfirst_name" placeholder="First Name" value="<?php echo $dbfirst_name; ?>"> <br><span class="error"><?php echo $newfirst_nameErr;?></span> <br>
	<br>
	<input type="text" name="newmiddle_name" placeholder="Middle Name" value="<?php echo $dbmiddle_name; ?>"> <br><span class="error"><?php echo $newmiddle_nameErr;?></span> <br>
	<br>
	<input type="text" name="newlast_name" placeholder="Last Name" value="<?php echo $dblast_name; ?>"> <br><span class="error"><?php echo $newlast_nameErr;?></span>  <br>
	<br>
	<input type="text" name="newaddress" placeholder="Address" value="<?php echo $dbaddress; ?>">  <br><span class="error"><?php echo $newaddressErr;?></span> <br>
	<br>
	<select name="newgender" >
		<option name="newgender" <?php if ($dbgender == "Male"){ echo "selected"; } ?> value="Male">Male</option>
		<option name="newgender" <?php if ($dbgender == "Female"){ echo "selected"; } ?> value="Female">Female</option>
	</select> <span class="error"><?php echo $newgenderErr; ?> </span>  
	<br>
	<br>
	<select name="newstatus">
		<option name="newstatus" <?php if ($dbstatus == "Single"){ echo "selected"; } ?> value="Single">Single</option>
		<option name="newstatus" <?php if ($dbstatus == "Married"){ echo "selected"; } ?> value="Married">Married</option>
	</select> <span class="error"><?php echo $newstatusErr; ?> </span><br>
	<br>
	<input type="date" name="newbirthday" value="<?php echo $dbbirthday; ?>"> <br><span class="error"><?php echo $newbirthdayErr;?></span>  <br>
	<br>
	<input type="text" name="newbus_name" placeholder="Business Name" value="<?php echo $dbbus_name; ?>"> <br><span class="error"><?php echo $newbus_nameErr;?></span>  <br>
	<br>
	<input type="text" name="newbus_nature" placeholder="Nature of Business" value="<?php echo $dbbus_nature; ?>"> <br><span class="error"><?php echo $newbus_natureErr;?></span>  <br>
	<br>
	<input type="text" name="newbus_address" placeholder="Business Address" value="<?php echo $dbbus_address; ?>"> <br><span class="error"><?php echo $newbus_addressErr;?></span>  <br>
	<br>
	<input type="date" name="newbus_DOR" placeholder="Date of Registration" value="<?php echo $dbbus_DOR; ?>"> <br><span class="error"><?php echo $newbus_DORErr;?></span>  <br>
	<br>
	<input type="text" name="newTIN" placeholder="TIN Number" value="<?php echo $dbTIN; ?>"> <br><span class="error"><?php echo $newTINErr;?></span>  <br>
	<br>
	<input type="number_format" name="newmobile" placeholder="Mobile Number" value="<?php echo $dbmobile; ?>"> <br><span class="error"><?php echo $newmobileErr;?></span>  <br>
	<br>
	<input type="submit" name="btn_update" value="Update">&nbsp;
	<a href="clientlist.php">Cancel</a>
	</form>
<?php
}else{
	echo "<h1>No Record Found.</h1>";
}
?>