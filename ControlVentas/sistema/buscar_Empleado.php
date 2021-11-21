<?php 
   include "../conexion.php";   
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";?>
	<title>Lista de Empleados</title>
</head>
<body>
<?php include "includes/header.php";?>
	<section id="container">
<?php  /*strtolower() = funcion para convertir a minusculas*/
  $busquedas = strtolower( $_REQUEST['busqueda']);
  if (empty($busquedas)) {
      header("location: lista_empleados.php");
  }
//--------
?>
		<h1>Lista de Empleados</h1>
        <a href="Registro_Empleados.php" class="btn_new">Nuevo Empleado</a>
        
        <form action="buscar_Empleado.php" method="get" class="form_search">
          <input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
          <input type="submit" value="Buscar" class=" ">
        </form> 

        <table>
          <tr>   
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th> 
            <th>Fecha Nacimiento</th>           
            <th>Fecha Inicio</th>
            <th>Fecha Despido</th>
            <!-- <th>Rol</th>             -->
            <th>Acciones</th>
          </tr>

<?php 

$query = mysqli_query($conect,"SELECT id_Empleado, nombreEmpleado, apellidoEmpleado, fechaNacimiento, inicio_laboral, cese_laboral
                              FROM empleados
                              WHERE (id_Empleado      LIKE '%$busquedas%' OR
                                     nombreEmpleado   LIKE '%$busquedas%' OR 
                                     apellidoEmpleado LIKE '%$busquedas%' OR 
                                     fechaNacimiento  LIKE '%$busquedas%' OR 
                                     inicio_laboral   LIKE '%$busquedas%' OR
                                     cese_laboral     LIKE '%$busquedas%' )");

$result = mysqli_num_rows($query);
if ($result > 0) {
    while($data = mysqli_fetch_array($query)){
?>
          <tr>
            <td><?php echo $data["id_Empleado"];?></td>
            <td><?php echo $data["nombreEmpleado"];?></td>
            <td><?php echo $data["apellidoEmpleado"];?></td>
            <td><?php echo $data["fechaNacimiento"];?></td>
            <td><?php echo $data["inicio_laboral"];?></td>
            <td><?php echo $data["cese_laboral"];?></td>                       
            <td>
                <a class="link_edit" href="Editar_Clientes.php? id=<?php echo $data["id_Empleado"];?>">Editar</a>                 
                <?php echo "  |  ";?>
                <a class="link_delete" href="Eliminar_Clientes.php? id=<?php echo $data["id_Empleado"];?>">Eliminar</a>                
            </td>          
          </tr>
<?php
  }
}
?> 
        </table>
	</section>
	<?php include "includes/footer.php";?>	
</body>
</html> 