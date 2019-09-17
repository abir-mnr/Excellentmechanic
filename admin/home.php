<?php 
include('../functions.php');

if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Online mechanic appointment</title>
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
		<h2>Admin - Home Page</h2>
	</div>
	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<!-- logged in user information -->
		<div class="profile_info">
			<img src="../images/admin_profile.png"  >

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<a href="home.php?logout='1'" style="color: red;">logout</a>
                       &nbsp; <a href="create_user.php"> + add user</a>
					</small>


					<table class="tblone">
						<?php 
							global $db;
							$query = "SELECT * FROM users";
							$read = select($query);
						 ?>
						<h3>Appointment List</h3>

						<tr>
							
							<th>Name</th>
							<th>Address</th>
							<th>Phone</th>
							<th>Car Number</th>
							<th>Date</th>
							<th>Mechanic</th>
							<th colspan="2">Action</th>
						</tr>
						<?php if($read){ ?>
							<?php while($row = $read->fetch_assoc()){ ?>

								<tr>
									
									<td><?php echo $row['username']; ?></td>
									<td><?php echo $row['address'] ?></td>
									<td><?php echo $row['phone']; ?></td>
									<td><?php echo $row['carnumber']; ?></td>
									<td><?php echo $row['appointmentdate']; ?></td>
									<td><?php echo $row['mechanic']; ?></td>
									<td><a href="../update.php?id=<?php echo urlencode($row['id']); ?>">Edit</a></td>
									<td><a href="delete.php?id=<?php echo urlencode($row['id']); ?>">Delete</a></td>
								</tr>

							<?php } ?>
						<?php } else{ ?>
							<p>Data is not available!!</p>
						<?php } ?>
					</table>
					
				<?php endif ?>
			</div>
		</div>
	</div>
</body>
</html>