
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
	<h3>Vista Carrera</h3>
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


<script type="text/javascript" src="http://localhost:8080/escuela/js/script.js"></script>

</body>
</html>