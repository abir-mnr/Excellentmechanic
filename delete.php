<?php  
	include('functions.php');
?>
	<head>
		<title>Online mechanic appointment-Delete</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<div class="header">
		Delete
	</div>
	<div class="content">

		
		
		<?php 
			global $db,$errors,$message;
			$id = $_GET['id'];
			$query = "SELECT * FROM users WHERE id=$id";
			$getData = mysqli_fetch_assoc(select($query));

			if(isset($_POST['delete'])){

				$dquery = "DELETE FROM users WHERE id=$id";
				$deleteData = mysqli_query($db,$dquery);
				header('location: index.php');
			}
		?>


		<form action="delete.php?id=<?php echo $id;?>" method="post">
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
					<input type="submit" class="btn" name="delete" value="Delete">
					<a href="<?php if(isAdmin()){echo "admin/home.php";}else{echo "index.php";}?>"><input type="button" class="btn" value="Cancel"></a>
				</td>
			</tr>
		</table>
		</form>
		<a href="index.php">Home</a>

		
	</div>

