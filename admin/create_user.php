<?php include('../functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Online mechanic appointment- Create user</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<style>
		.header {
			background: #003366;
		}
		button[name=register_btn] {
			background: #003366;
		}
	</style>
</head>
<body>
	<div class="header">
		<h2>Admin - create user</h2>
	</div>
	
	<form method="post" action="create_user.php">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div class="input-group">
			<label>User type</label>
			<select name="user_type" id="user_type" >
				<option value=""></option>
				<option value="admin">Admin</option>
				<option value="user">User</option>
			</select>
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label>Confirm password</label>
			<input type="password" name="password_2">
		</div>
		<div class="input-group">
			<label>Address</label>
			<input type="text" name="address" value="<?php echo $address; ?>">
		</div>
		<div class="input-group">
			<label>Phone</label>
			<input type="number" name="phone" value="<?php echo $phone; ?>">
		</div>
		<div class="input-group">
			<label>Car Plate Number</label>
			<input type="number" name="carnumber" value="<?php echo $carnumber; ?>">
		</div>
		<div class="input-group">
			<label>Car Engine Number</label>
			<input type="number" name="carengineno" value="<?php echo $carengineno; ?>">
		</div>
		<div class="input-group">
			<label>Appointment Date</label>
			<input type="date" name="appointmentdate" value="<?php echo $appointmentdate; ?>">
		</div>
		<div class="input-group">
				<label>Mechanic</label>
				<select name="mechanic" id="user_type" value="<?php echo $mechanic; ?>" >
					<option value=""></option>
					<option value="mechanic1">Mechanic1</option>
					<option value="mechanic2">Mechanic2</option>
					<option value="mechanic3">Mechanic3</option>
					<option value="mechanic4">Mechanic4</option>
				</select>
			</div>
		
		<div class="input-group">
			<button type="submit" class="btn" name="register_btn"> Create user</button>
		</div>
	</form>
</body>
</html>