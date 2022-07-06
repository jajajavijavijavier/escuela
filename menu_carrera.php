<?<?php 


@include 'config.php';

if (isset($_POST['Añadir_carrera'])){
	$matricula = $_POST['matricula'];
	$Nombre = $_POST['Nombre'];
	$Creditos = $_POST['Creditos'];
	

	$insert_query = mysqli_query($conn,"insert into `carrera`(PK_Carrera, Nombre, Creditos) 

		VALUES('$matricula','$Nombre', '$Creditos')") or die('query failed');

	if ($insert_query) {
		$message[] = 'carrera agregada';
		// code...
	}else{
		$message[] = 'Error no fue agregada';
	}
};

if (isset($_GET['delete'])) {
	$delete_matricula = $_GET['delete'];
	$delete_query = mysqli_query($conn,"delete from `carrera` where PK_Carrera = $delete_matricula")or die('query failed');
	if ($delete_query) {	
		header('location:menu_carrera.php');
		$message[] = 'Carrera elminado ';

	}else{
		header('location:menu_carrera.php');
		$message[]='no se pudo eliminar';

	};
};

if (isset($_POST['update_alumno'])) {
	$update_matricula = $_POST['update_matricula'];
	$update_nombre = $_POST['update_nombre'];
	$update_Creditos= $_POST['update_Creditos'];
	

	$update_query = mysqli_query($conn, "UPDATE `carrera` SET  Nombre = '$update_nombre', Creditos = '$update_Creditos' WHERE PK_Carrera = '$update_matricula'");

	if ($update_query) {
		header('location:menu_carrera.php');
		$message[] = 'Carrera actualizada';
		
	}else{
		$message[] = 'Carrera no se actualizo';
		header('location:menu_carrera.php');
	}
		
}

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="wmatriculath=device-wmatriculath, initial-scale=1">
	<title>Admin page_carrera</title>

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
	<h3>Añade nueva carrera</h3>
	<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); type="number" name="matricula" maxlength="6"  placeholder="matricula" class="box" required>
	<input type="text" name="Nombre" placeholder="Nombre" class="box" required>
	<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); type="number" name="Creditos" maxlength="10" placeholder="Creditos" class="box" required>
	<input type="submit" value="Añadir Carrera" name="Añadir_carrera" class="btn">
	
</form>


</section>


<section class="display-alumnos-table">
	
	<table>
		<thead>
			<th>matricula</th>
			<th>Nombre</th>
			<th> Creditos</th>
		</thead>

		<tbody>
			<?php 

				$select_alumno = mysqli_query($conn, "Select * from `carrera`");
				if (mysqli_num_rows($select_alumno)>0) {
					while($row = mysqli_fetch_assoc($select_alumno)){
			 ?>

			 <tr>
			 	<td><?php echo $row['PK_Carrera']; ?></td>
			 	<td><?php echo $row['Nombre']; ?></td>
			 	<td><?php echo $row['Creditos']; ?></td>
				<td>
					<a href="menu_carrera.php?delete=<?php echo $row['PK_Carrera']; ?>" class="delete-btn" onclick="return confirm('estas seguro?');"> <i class="fas fa-trash"></i>Eliminar</a>
					<a href="menu_carrera.php?edit=<?php echo $row['PK_Carrera']; ?>" class="option-btn"> <i class="fas fa-edit"></i>Editar</a>
				</td>
			 </tr>


			 <?php 
					};
				}else{
					echo"<div class='empty'> no hay carreras </div>"	;

				}

			  ?>
			

		</tbody>

	</table>

</section>

<section class="edit-form-container">

		<?php 

	if(isset($_GET['edit'])){
		$edit_mat = $_GET['edit'];
		$edit_query = mysqli_query($conn,"SELECT * fROM `carrera` WHERE PK_Carrera = $edit_mat ");
		if (mysqli_num_rows($edit_query) > 0) {
			while($fetch_edit = mysqli_fetch_assoc($edit_query)){

		?>	

	<form action="" method="post" enctype="multipart/form-data">
		<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); type="number" maxlength="6"  class="box" required name="update_matricula" value="<?php echo $fetch_edit ['PK_Carrera']; ?>" readonly>
		<input type="text" class="box" required name="update_nombre" value="<?php echo $fetch_edit ['Nombre']; ?>">
		<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); type="number" class="box" maxlength="10" required name="update_Creditos" value="<?php echo $fetch_edit ['Creditos']; ?>">
		<input type="submit" value="Actualizar" name="update_alumno" class="btn">
		<input type="reset" value="cancel" id="close-edit"  class="option-btn">

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