 <?php 
   include "../conexion.php";   
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";?>
	<title>Lista de Proveedores</title>
</head>
<body>
<?php include "includes/header.php";?>
	<section id="container">
<?php  /*strtolower() = funcion para convertir a minusculas*/
  $busqueda = strtolower( $_REQUEST['busqueda']);
  if (empty($busqueda)) {
      header("location: Lista_Proveedores.php");
  }

?>
		<h1>Lista de Usuarios</h1>
        <a href="Registro_Proveedor.php" class="btn_new">Crear Usuarios</a>
        
        <form action="buscar_proveedor.php" method="get" class="form_search">
          <input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
          <input type="submit" value="Buscar" class=" ">
        </form> 

        <<table>
          <tr>
            <th>ID</th>
            <th>Nombre</th>            
            <th>Apellido</th>            
            <th>Empresa</th>
            <th>Direccion</th>            
            <th>Telefono</th>            
            <th>Acciones</th>
          </tr>
<?php 
$query = mysqli_query($conect,"SELECT id_Proveedor, nombreProv, apellidoProv, empresaProv, direccionProv, telefono 
                               FROM PROVEEDORES where(id_Proveedor   LIKE '%$busqueda%' OR
                                                       nombreProv    LIKE '%$busqueda%' OR
                                                       apellidoProv  LIKE '%$busqueda%' OR
                                                       empresaProv   LIKE '%$busqueda%' OR
                                                       direccionProv LIKE '%$busqueda%' OR
                                                       telefono      LIKE '%$busqueda%')");

$result = mysqli_num_rows($query);
if ($result > 0) {
    while($data = mysqli_fetch_array($query)){
?>
          <<tr>
            <td><?php echo $data["id_Proveedor"];?></td>
            <td><?php echo $data["nombreProv"];?></td>
            <td><?php echo $data["apellidoProv"];?></td>
            <td><?php echo $data["empresaProv"];?></td>
            <td><?php echo $data["direccionProv"];?></td>
            <td><?php echo $data["telefono"];?></td>                       
            <td>
                <a class="link_edit" href="Editar_Proveedor.php? id=<?php echo $data["id_Proveedor"];?>">Editar</a>                
                <a class="link_delete" href="Eliminar_Proveedor.php? id=<?php echo $data["id_Proveedor"];?>">Eliminar</a>                
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