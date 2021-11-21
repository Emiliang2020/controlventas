 <?php 
   include "../conexion.php";   
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";?>
	<title>Lista de Usuarios</title>
</head>
<body>
<?php include "includes/header.php";?>
	<section id="container">
<?php  /*strtolower() = funcion para convertir a minusculas*/
  $busqueda = strtolower( $_REQUEST['busqueda']);
  if (empty($busqueda)) {
      header("location: lista_usuarios.php");
  }

?>
		<h1>Lista de Usuarios</h1>
        <a href="Registro_Usuario.php" class="btn_new">Crear Usuarios</a>
        
        <form action="buscar_usuario.php" method="get" class="form_search">
          <input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
          <input type="submit" value="Buscar" class=" ">
        </form> 

        <table>
          <tr>
            <th>ID</th>
            <th>Usuarios</th>            
            <th>Clave</th>            
            <th>Acciones</th>
          </tr>
<?php 
$query = mysqli_query($conect,"SELECT id_Usuario,nombreUsuario,claveUsuario 
                               FROM usuarios where (id_Usuario  LIKE '%$busqueda%' OR
                                                    nombreUsuario  LIKE '%$busqueda%' OR 
                                                    claveUsuario  LIKE '%$busqueda%')");


$result = mysqli_num_rows($query);
if ($result > 0) {
    while($data = mysqli_fetch_array($query)){
?>
          <tr>
            <td><?php echo $data["id_Usuario"];?></td>
            <td><?php echo $data["nombreUsuario"];?></td>
            <td><?php echo $data["claveUsuario"];?></td>                       
          <td>
                <a class="link_edit" href="Editar_Usuario.php? id=<?php echo $data["id_Usuario"];?>">Editar</a>                
                <a class="link_delete" href="Eliminar_Usuario.php? id=<?php echo $data["id_Usuario"];?>">Eliminar</a>                
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