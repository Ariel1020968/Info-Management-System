<?php
include("title.php");
include("bgcolor.php");
include("connections.php");
	$first_name = $middle_name = $last_name = $address = $gender = $status = $birthday = $bus_name = $nature_of_business = $bus_address = $date_of_registration = $TIN = $mobile = "";
	$first_nameErr = $middle_nameErr = $last_nameErr = $addressErr = $genderErr = $statusErr = $birthdayErr = $bus_nameErr = $nature_of_businessErr = $bus_addressErr = $date_of_registrationErr = $TINErr = $mobileErr = "";
	if(isset($_POST["btn_save"])){
		if(empty($_POST["first_name"])){
			$first_nameErr = "First Name Required!";
		}else{
			$first_name = $_POST["first_name"];
		}
		if(empty($_POST["middle_name"])){
			$middle_nameErr = "Middle Name Required!";
		}else{
			$middle_name = $_POST["middle_name"];
		}
		if(empty($_POST["last_name"])){
			$last_nameErr = "Last Name Required!";
		}else{
			$last_name = $_POST["last_name"];
		}
		if(empty($_POST["address"])){
			$addressErr = "Address Required!";
		}else{
			$address = $_POST["address"];
		}
		if(empty($_POST["gender"])){
			$genderErr = "Gender Required!";
		}else{
			$gender = $_POST["gender"];
		}
		if(empty($_POST["status"])){
			$statusErr = "Status Required!";
		}else{
			$status = $_POST["status"];
		}
		if(empty($_POST["birthday"])){
			$birthdayErr = "Birthday Required!";
		}else{
			$birthday = $_POST["birthday"];
		}
		if(empty($_POST["bus_name"])){
			$bus_nameErr = "Business Name Required!";
		}else{
			$bus_name = $_POST["bus_name"];
		}
		if(empty($_POST["nature_of_business"])){
			$nature_of_businessErr = "Business Nature Required!";
		}else{
			$nature_of_business = $_POST["nature_of_business"];
		}
		if(empty($_POST["bus_address"])){
			$bus_addressErr = "Business Address Required!";
		}else{
			$bus_address = $_POST["bus_address"];
		}
		if(empty($_POST["date_of_registration"])){
			$date_of_registrationErr = "DOR Required!";
		}else{
			$date_of_registration = $_POST["date_of_registration"];
		}
		if(empty($_POST["TIN"])){
			$TINErr = "TIN Number Required!";
		}else{
			$TIN = $_POST["TIN"];
		}
		if(empty($_POST["mobile"])){
			$mobileErr = "Mobile Number Required!";
		}else{
			$mobile = $_POST["mobile"];
		}
		if($first_name && $middle_name && $last_name && $address && $gender && $status && $birthday
			&& $bus_name && $nature_of_business && $bus_address && $date_of_registration && $TIN && $mobile){
			$c_first_name = strlen($first_name);
			if($c_first_name < 2){
				$first_nameErr = "Your first name is too short.";
			}else{
				$c_middle_name = strlen($middle_name);
			if($c_middle_name < 2){
				$middle_nameErr = "Your middle name is too short.";
			}else{	
				$c_last_name = strlen($last_name);
			if($c_last_name < 2){
				$last_nameErr = "Your last name is too short.";
			}else{
				$c_address = strlen($address);
			if($c_address < 5){
				$addressErr = "Your address is too short.";
			}else{
				$c_bus_name = strlen($bus_name);
			if($c_bus_name < 5){
				$bus_nameErr = "Your business name is too short.";
			}else{	
				$c_TIN = strlen($TIN);
			if($c_TIN < 11){
				$TINErr = "Your TIN number is too short.";
			}else{
				$c_mobile = strlen($mobile);
			if($c_mobile < 11){
				$mobileErr = "Your mobile number is too short.";
			}else{
				$insert = "INSERT INTO bus_info(bus_name,bus_nature,bus_address,bus_DOR)
					VALUES('$bus_name','$nature_of_business','$bus_address','$date_of_registration')";
				$query = mysqli_query($connections,$insert) or die(mysqli_error($connections));
				if($query){
					$ins = "INSERT INTO client_info(first_name,middle_name,last_name,address,gender,status,birthday,tin,mobile)
						VALUES('$first_name','$middle_name','$last_name','$address','$gender','$status','$birthday','$TIN','$mobile')";
					$query = mysqli_query($connections,$ins) or die(mysqli_error($connections));
					if($query){
						$in = "INSERT INTO taxes(firstq,secondq,thirdq,annual)
							VALUES('','','','')";
						$query = mysqli_query($connections,$in) or die(mysqli_error($connections));
						header("Location: index.php");
					}
				}
			}
			}
			}
			}
			}
			}
			}
		}
	}
?>
<style>
.error{
	color:black;
}
</style>
<form method="POST" >
	<b>Personal Information</b><br>
	<input type="text" name="first_name" placeholder="First Name" value="<?php echo $first_name; ?>"> <span class="error"><?php echo $first_nameErr;?></span> <br>
	<input type="text" name="middle_name" placeholder="Middle Name" value="<?php echo $middle_name; ?>"> <span class="error"><?php echo $middle_nameErr;?></span> <br>
	<input type="text" name="last_name" placeholder="Last Name" value="<?php echo $last_name; ?>"> <span class="error"><?php echo $last_nameErr;?></span>  <br>
	<input type="text" name="address" placeholder="Address" value="<?php echo $address; ?>">  <span class="error"><?php echo $addressErr;?></span> <br>
<select name="gender">
	<option name="gender" value="">Select Gender</option>
	<option name="gender" <?php if ($gender == "Male"){ echo "selected"; } ?> value="Male">Male</option>
	<option name="gender" <?php if ($gender == "Female"){ echo "selected"; } ?> value="Female">Female</option>
</select> <span class="error"><?php echo $genderErr; ?> </span>  
<br>
<select name="status">
	<option name="status" value="">Status</option>
	<option name="status" <?php if ($status == "Single"){ echo "selected"; } ?> value="Single">Single</option>
	<option name="status" <?php if ($status == "Married"){ echo "selected"; } ?> value="Married">Married</option>
</select> <span class="error"><?php echo $statusErr; ?> </span><br>
	<font color="white">Birthday</font><br>
	<input type="date" name="birthday" value="<?php echo $birthday; ?>"> <span class="error"><?php echo $birthdayErr;?></span>  <br>
	<br><b>Business Information</b><br>
	<input type="text" name="bus_name" placeholder="Business Name" value="<?php echo $bus_name; ?>"> <span class="error"><?php echo $bus_nameErr;?></span>  <br>
	<input type="text" name="nature_of_business" placeholder="Nature of Business" value="<?php echo $nature_of_business; ?>"> <span class="error"><?php echo $nature_of_businessErr;?></span>  <br>
	<input type="text" name="bus_address" placeholder="Business Address" value="<?php echo $bus_address; ?>"> <span class="error"><?php echo $bus_addressErr;?></span>  <br>
	<font color="white">Date of Registration</font><br>
	<input type="date" name="date_of_registration" placeholder="Date of Registration" value="<?php echo $date_of_registration; ?>"> <span class="error"><?php echo $date_of_registrationErr;?></span>  <br>
	<input type="text" name="TIN" placeholder="TIN Number" value="<?php echo $TIN; ?>"> <span class="error"><?php echo $TINErr;?></span>  <br>
	<input type="number_format" name="mobile" placeholder="Mobile Number" value="<?php echo $mobile; ?>"> <span class="error"><?php echo $mobileErr;?></span>  <br>
	<br>
	<input type="submit" name="btn_save" value="Save"> &nbsp;<a href="index.php"><font color="black">Cancel</font></a>
	<hr></hr>
</form>