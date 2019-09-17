<?php include('functions.php') ?>

<!DOCTYPE html>
<html>
<head>
	<title>Online mechanic appointment</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
	<h2>Welcome to Excellent mechanics </h2><br>
	<h2><a href="login.php" style="color: yellow;">Sign In</a></h2>
	<span style="color: inherit;">OR</span><br>
	<h2>Make appointment</h2><br>
	

</div>
<form method="post" action="register.php">
	<?php echo display_error(); ?>
	<div class="input-group">
		<label>Username</label>
		<input type="text" name="username" value="<?php echo $username; ?>">
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
		<button type="submit" class="btn" name="register_btn">Register</button>
	</div>
	<p>
		Already made appointment? <a href="login.php">Sign in</a>
	</p>
</form>
</body>
</html>