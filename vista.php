

<?<?php 


@include 'config.php';


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin page</title>

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

<?php include 'header_alumno.php'  ?>



<section class="display-alumnos-table-vista">
	<h3>Vista Alumnos</h3>
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
			<th>Celular</th>
			<th>Email</th>
		</thead>

		<tbody>
			<?php 

				$select_alumno = mysqli_query($conn, "Select * from `alumno`");
				if (mysqli_num_rows($select_alumno)>0) {
					while($row = mysqli_fetch_assoc($select_alumno)){
			 ?>

			 <tr>
			 	<td><?php echo $row['PK_Alumno']; ?></td>
			 	<td><?php echo $row['Nombre']; ?></td>
			 	<td><?php echo $row['AP_Paterno']; ?></td>
			 	<td><?php echo $row['AP_Materno']; ?></td>
			 	<td><?php echo $row['Curp']; ?></td>
				<td><?php echo $row['Fecha_Nac']; ?></td>
				<td><?php echo $row['FK_Direccion']; ?></td>
				<td><?php echo $row['Genero']; ?></td>
				<td><?php echo $row['Celular']; ?></td>
				<td><?php echo $row['Email']; ?></td>
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




			











<script type="text/javascript" src="http://localhost:8080/escuela/js/script.js"></script>

</body>
</html>

