<?php include('functions.php') ?>

<!DOCTYPE html>
<html>
<head>
	<title>Online mechanic appointment</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
	<h2>Make appointment</h2><br>
	

</div>
<form method="post" action="registerNew.php">
	<?php echo display_error(); ?>

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
		<button type="submit" class="btn" name="registerNew_btn">Register</button>
	</div>
	<p>
		Already made appointment? <a href="login.php">Sign in</a>
	</p>
</form>
</body>
</html>