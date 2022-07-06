<?php 

@include 'config.php';

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
		$error[] = 'user ya existe ';


	}else{

	if ($pass != $cpass) {
			$error[] = 'contraseña no coincide';
		}else{
			$insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
			mysqli_query($conn, $insert);
			header('location:login_form.php');
		}


	}
 
	};

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register form</title>

		<!--     css file      -->
	<link rel="stylesheet" href="css/style_login.css">

</head>
<body>
	
<div class="form-container">
	
	<form action="" method="post">
		<h3>Registrate</h3>
		<?php 
		if (isset($error)) {
			foreach ($error as $error) {
				echo '<span class="error-msg">'.$error.'</span>';
				
			};
		};

		 ?>
		<input type="text" name="name" required placeholder="Ingresa tu usuario">
		<input type="email" name="email" required placeholder="Ingresa tu email">
		<input type="password" name="password" required placeholder="Ingresa tu contraseña">
		<input type="password" name="cpassword" required placeholder="Confirma tu contraseña">
		<select name="user_type">
			<option value="Estudiante">Estudiante</option>
			<option value="admin">admin</option>
			<option value="Aspirante">Aspirante</option>
		</select>
		<input type="submit" name="submit" value="Listo" class="form-btn">
		<p>Ya tiene una cuenta? <a href="login_form.php">Inicia sesión</a></p>
	</form>

</div>

</body>
</html>