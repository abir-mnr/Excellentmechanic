<?php  
	include('functions.php');
?>
	<head>
		<title>Online mechanic appointment-Update</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<div class="header">
		Update
	</div>
	<div class="content">

		
		
		<?php 
			global $db,$errors,$message;
			$id = $_GET['id'];
			$query = "SELECT * FROM users WHERE id=$id";
			$getData = mysqli_fetch_assoc(select($query));

			if(isset($_POST['submit'])){

				$address = $_POST['address'];
				$phone = $_POST['phone'];
				$carnumber = $_POST['carnumber'];
				$appointmentdate = $_POST['appointmentdate'];
				$mechanic = $_POST['mechanic'];
				if($address==null||$phone==null||$carnumber==null||$appointmentdate==null||$mechanic==null){
					array_push($errors, "Field must not be empty");
				}
				if (mechanicEnrollment($mechanic,$appointmentdate)>=4){
					array_push($errors, "Mechanic has no empty slot for that day");
				}
				if(count($errors)==0){
					$query = "UPDATE users SET 
					address = '$address',phone = '$phone',carnumber = '$carnumber',appointmentdate = '$appointmentdate',mechanic = '$mechanic' WHERE id=$id";
					$update = update($query);
				}
			}
		?>


		<form action="update.php?id=<?php echo $id;?>" method="post">
			<?php echo display_error(); ?>
			<?php echo display_message(); ?>
		<table class="tblone">
			<tr>
				<td>Name</td>
				<td><p><?php echo $getData['username'];?></p></td>
			</tr>
			<tr>
				<td>Address</td>
				<td><input type="text" name="address" value="<?php echo $getData['address'];?>"</td>
			</tr>
			<tr>
				<td>Phone</td>
				<td><input type="number" name="phone" value="<?php echo $getData['phone'];?>"</td>
			</tr>
			<tr>
				<td>Car Plate Number</td>
				<td><input type="number" name="carnumber" value="<?php echo $getData['carnumber'];?>"</td>
			</tr>
			<tr>
				<td>Appointment Date</td>
				<td><input type="date" name="appointmentdate" value="<?php echo $getData['appointmentdate'];?>"</td>
			</tr>
			<tr>
				<td><label>Mechanic</label></td>
				<td><select name="mechanic" id="user_type" value="<?php echo $getData['mechanic']; ?>" >
					<option value="<?php echo $getData['mechanic']; ?>"></option>
					<option value="mechanic1"<?php if($getData['mechanic']=="mechanic1") echo 'selected ="selected"' ?>>Mechanic1</option>
					<option value="mechanic2"<?php if($getData['mechanic']=="mechanic2") echo 'selected ="selected"' ?>>Mechanic2</option>
					<option value="mechanic3"<?php if($getData['mechanic']=="mechanic3") echo 'selected ="selected"' ?>>Mechanic3</option>
					<option value="mechanic4"<?php if($getData['mechanic']=="mechanic4") echo 'selected ="selected"' ?>>Mechanic4</option>
				</select></td>
			</tr>
			
			<tr>
				<td>
					<input type="submit" class="btn" name="submit" value="Submit">
					<a href="<?php if(isAdmin()){echo "admin/home.php";}else{echo "index.php";}?>"><input type="button" class="btn" value="Cancel"></a>
				</td>
			</tr>
		</table>
		</form>
		<a href="<?php if(isAdmin()){echo "admin/home.php";}else{echo "index.php";}?>">Home</a>

		
	</div>

