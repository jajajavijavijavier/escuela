<?php 

@include 'config.php';

session_start();

if (isset($_POST['submit'])) {

	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pass = md5($_POST['password']);
	$cpass = md5($_POST['cpassword']);
	$pass = md5($_POST['password']);
	$user_type = $_POST['user_type'];

	$select = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass'";
	
	$result = mysqli_query($conn, $select);

	if (mysqli_num_rows($result) > 0 ) {
	
	$row = mysqli_fetch_array($result);	

	if($row['user_type'] == 'admin'){

		$_SESSION['admin_name'] = $row['name'];
		header('location:admin_page.php');

	}elseif ($row['user_type'] == 'Estudiante'){

		$_SESSION['admin_name'] = $row['name'];
		header('location:user_page.php');

	}elseif ($row['user_type'] == 'Aspirante'){

		$_SESSION['admin_name'] = $row['name'];
		header('location:aspirante_page.php');
	}


	}else{
		$error[] = 'contraseña o email incorrectos';
	}

	
};
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login form</title>

		<!--     css file      -->
	<link rel="stylesheet" href="css/style_login.css">

</head>
<body>
	
<div class="form-container">
	
	<form action="" method="post">
		<h3>Login form</h3>
		<?php 
		if (isset($error)) {
			foreach ($error as $error) {
				echo '<span class="error-msg">'.$error.'</span>';
				
			};
		};

		 ?>
		<input type="email" name="email" required placeholder="Ingresa tu email">
		<input type="password" name="password" required placeholder="Ingresa tu contraseña">
		<input type="submit" name="submit" value="Listo" class="form-btn">
		<p>No tienes una cuenta? - solicitala con un admin</p>
	</form>

</div>

</body>
</html>