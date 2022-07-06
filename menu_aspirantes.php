<?<?php 


@include 'config.php';

if (isset($_POST['Añadir_alumno'])){
	$matricula = $_POST['matricula'];
	$nombre = $_POST['nombre'];
	$AP_Paterno = $_POST['AP_Paterno'];
	$AP_Materno = $_POST['AP_Materno'];
	$Curp = $_POST['Curp'];
	$Fecha_Nac = $_POST['Fecha_Nac'];
	$Direccion = $_POST['Direccion'];
	$Genero = $_POST['Genero'];
	$Edad = $_POST['Edad'];
	$Email = $_POST['Email'];
	$Carrera = $_POST['Carrera'];
	$Periodo = $_POST['Periodo'];
	$Estatus = $_POST['Estatus'];

	$insert_query = mysqli_query($conn,"insert into `aspirante`(PK_Aspirante , nombre, AP_Paterno, AP_Materno, Curp, Fecha_Nac, FK_Direccion, Genero, Edad, Email, FK_Carrera, FK_Periodo, Estatus ) 

		VALUES('$matricula','$nombre', '$AP_Paterno', '$AP_Materno', '$Curp', '$Fecha_Nac', '$Direccion','$Genero',' $Edad', '$Email','$Carrera', '$Periodo', '$Estatus')") or die('query failed');

	if ($insert_query) {
		$message[] = 'Alumno agregado';
		// code...
	}else{
		$message[] = 'Error no fue agregado';
	}
};

if (isset($_GET['delete'])) {
	$delete_id = $_GET['delete'];
	$delete_query = mysqli_query($conn,"delete from `aspirante` where PK_Aspirante = $delete_id");
	if ($delete_query) {	
		header('location:menu.php');
		$message[] = 'Alumno elminado ';

	}else{
		header('location:menu.php');
		$message[]='no se pudo eliminar';

	};
};

if (isset($_POST['update_alumno'])) {
	$update_matricula = $_POST['update_matricula'];
	$update_nombre = $_POST['update_nombre'];
	$update_ap_p = $_POST['update_ap_p'];
	$update_ap_m = $_POST['update_ap_m'];
	$update_Curp = $_POST['update_Curp'];
	$update_fecha = $_POST['update_fecha'];
	$update_direccion = $_POST['update_direccion'];
	$update_genero = $_POST['update_genero'];
	$update_edad = $_POST['update_edad'];
	$update_email = $_POST['update_email'];
	$update_carrera = $_POST['update_carrera'];
	$update_periodo = $_POST['update_periodo'];
	$update_estatus = $_POST['update_estatus'];

	$update_query = mysqli_query($conn, "UPDATE `aspirante` SET  nombre = '$update_nombre', AP_Paterno = '$update_ap_p', AP_Materno = '$update_ap_m', Curp = '$update_Curp',Fecha_Nac = '$update_fecha',FK_Direccion = '$update_direccion',Genero = '$update_genero', Edad = '$update_edad', Email = '$update_email', FK_Carrera = '$update_carrera',FK_Periodo  = '$update_periodo',Estatus  = '$update_estatus'  WHERE PK_Aspirante = '$update_matricula'");

	if ($update_query) {
		header('location:menu.php');
		$message[] = 'Alumno actualizado';
		
	}else{
		$message[] = 'Alumno no se actualizo';
		header('location:menu.php');
	}
		
}

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin page_Aspirante</title>

	<!---font cdn link  -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

	<!--- custom css file link   -->
	<link rel="stylesheet"  href="http://localhost:8080/escuela/css/style.css">

</head>
<body>

<?php 

	if (isset($message)) {
		foreach($message as $message){
			echo '<div class="message"><span>' .$message. '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i>  </div>';
		}
	}
 ?>

<?php include 'header.php'  ?>

<div class="container">

<section >
<form action="" method="post" class="add-product-form" enctype="multipart/form-data">
	<h3>Añade nuevo Aspirante</h3>
	<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); type="number" name="matricula" maxlength="6"  placeholder="Matricula" class="box" required>
	<input type="text" name="nombre" placeholder="Nombre" class="box" required>
	<input type="text" name="AP_Paterno" placeholder="Apellido paterno" class="box" required>
	<input type="text" name="AP_Materno" placeholder="Apellido materno" class="box" required>
	<input type="text" name="Curp" maxlength="18" placeholder="Curp" class="box" required>
	<input type="date" name="Fecha_Nac"  class="box" required>
	<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); type="number" name="Direccion" maxlength="2"  placeholder="Codigo Direccion" class="box" required>
	<input type="text" multiple list="sexo" name="Genero" placeholder="Genero" class="box" required>
	<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); type="number" name="Edad" maxlength="2" placeholder="Edad" class="box" required>
	<input type="text" name="Email" placeholder="Correo" class="box" required>
	<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); type="number" name="Carrera" maxlength="3" placeholder="Codigo Carrera" class="box" required>
	<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); type="number" name="Periodo" maxlength="3" placeholder="Codigo Perido" class="box" required>
	<input type="text" multiple list="estatus" name="Estatus" placeholder="Estatus" class="box" required>

	<input type="submit"  value="Añadir Aspirante" name="Añadir_alumno" class="btn">


	<datalist  id="estatus">
		<option>Aceptado</option>
		<option>Pendiente</option>
		<option>En espera</option>
		<option>Activo</option>
		<option>Otro</option>
	</datalist>

	<datalist  id="sexo">
		<option>Femenino</option>
		<option>Masculino</option>
		<option>Otro</option>
	</datalist>
</form>


</section>


<section class="display-alumnos-table">
	
	<table>
		<thead>
			<th>Matricula</th>
			<th>Alumno</th>
			<th>Apellido paterno</th>
			<th>Apellido materno</th>
			<th>Curp</th>
			<th>Fecha de nacimiento</th>
			<th>Codigo Direccion</th>
			<th>Genero</th>
			<th>Edad</th>
			<th>Email</th>
			<th>Codigo Carrera</th>
			<th>Codigo Periodo</th>
			<th>Estatus</th>
		</thead>

		<tbody>
			<?php 

				$select_alumno = mysqli_query($conn, "Select * from `aspirante`");
				if (mysqli_num_rows($select_alumno)>0) {
					while($row = mysqli_fetch_assoc($select_alumno)){
			 ?>

			 <tr>
			 	<td><?php echo $row['PK_Aspirante']; ?></td>
			 	<td><?php echo $row['Nombre']; ?></td>
			 	<td><?php echo $row['AP_Paterno']; ?></td>
			 	<td><?php echo $row['AP_Materno']; ?></td>
			 	<td><?php echo $row['Curp']; ?></td>
				<td><?php echo $row['Fecha_Nac']; ?></td>
				<td><?php echo $row['FK_Direccion']; ?></td>
				<td><?php echo $row['Genero']; ?></td>
				<td><?php echo $row['Edad']; ?></td>
				<td><?php echo $row['Email']; ?></td>
				<td><?php echo $row['FK_Carrera']; ?></td>
				<td><?php echo $row['FK_Periodo']; ?></td>
				<td><?php echo $row['Estatus']; ?></td>

				<td>
					<a href="menu_aspirantes.php?delete=<?php echo $row['PK_Aspirante']; ?>" class="delete-btn" onclick="return confirm('estas seguro?');"> <i class="fas fa-trash"></i>Eliminar</a>
					<a href="menu_aspirantes.php?edit=<?php echo $row['PK_Aspirante']; ?>" class="option-btn"> <i class="fas fa-edit"></i>Editar</a>
				</td>
			 </tr>


			 <?php 
					};
				}else{
					echo"<div class='empty'> Alunmos no añadidos </div>"	;

				}

			  ?>
			

		</tbody>

	</table>

</section>

<section class="edit-form-container">

		<?php 

	if(isset($_GET['edit'])){
		$edit_mat = $_GET['edit'];
		$edit_query = mysqli_query($conn,"SELECT * fROM `aspirante` WHERE PK_Aspirante  = $edit_mat ");
		if (mysqli_num_rows($edit_query) > 0) {
			while($fetch_edit = mysqli_fetch_assoc($edit_query)){

		?>	

	<form action="" method="post" enctype="multipart/form-data">
		<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); type="hidden" readonly maxlength="1"  class="box"  name="update_matricula" value="<?php echo $fetch_edit ['PK_Aspirante']; ?>">
		<input type="text" class="box" required name="update_nombre" value="<?php echo $fetch_edit ['Nombre']; ?>">
		<input type="text" class="box" required name="update_ap_p" value="<?php echo $fetch_edit ['AP_Paterno']; ?>">
		<input type="text" class="box" required name="update_ap_m" value="<?php echo $fetch_edit ['AP_Materno']; ?>">
		<input type="text" class="box" maxlength="18" required name="update_Curp" value="<?php echo $fetch_edit ['Curp']; ?>">
		<input type="date" class="box" required name="update_fecha" value="<?php echo $fetch_edit ['Fecha_Nac']; ?>">
		<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); type="number" class="box" maxlength="3" required name="update_direccion" value="<?php echo $fetch_edit ['FK_Direccion']; ?>">
		<input type="text" class="box" multiple list="sexo" required name="update_genero" value="<?php echo $fetch_edit ['Genero']; ?>">
		<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); type="number" class="box" maxlength="3" required name="update_edad" value="<?php echo $fetch_edit ['Edad']; ?>">
		<input type="text" class="box" required name="update_email" value="<?php echo $fetch_edit ['Email']; ?>">
		<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); type="number" class="box" maxlength="3" required name="update_carrera" value="<?php echo $fetch_edit ['FK_Carrera']; ?>">
		<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); type="number" class="box" maxlength="3" required name="update_periodo" value="<?php echo $fetch_edit ['FK_Periodo']; ?>">
		<input type="text" multiple list="estatus" class="box" required name="update_estatus" value="<?php echo $fetch_edit ['Estatus']; ?>">

		<input type="submit" value="Actualizar" name="update_alumno" class="btn">
		<input type="reset" value="cancel" id="close-edit"  class="option-btn">


	<datalist  id="estatus">
		<option>Aceptado</option>
		<option>Pendiente</option>
		<option>En espera</option>
		<option>Activo</option>
		<option>Otro</option>
	</datalist>

	<datalist  id="sexo">
		<option>Femenino</option>
		<option>Masculino</option>
		<option>Otro</option>
	</datalist>

	</form>

		<?php 
		};
			};
				echo "<script>document.querySelector('.edit-form-container').style.display = 'flex' </script>";

				};	
		?>	
	
</section>

</dv>













<script type="text/javascript" src="http://localhost:8080/escuela/js/script.js"></script>

</body>
</html>