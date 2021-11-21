 <?php 
   include "../conexion.php";   
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";?>
	<title>Lista de Clientes</title>
</head>
<body>
<?php include "includes/header.php";?>
	<section id="container">
<?php  /*strtolower() = funcion para convertir a minusculas*/
  $busquedas = strtolower( $_REQUEST['busqueda']);
  if (empty($busquedas)) {
      header("location: lista_Clientes.php");
  }
//--------
?>
		<h1>Lista de Clientes</h1>
        <a href="Registro_Clientes.php" class="btn_new">Nuevo Cliente</a>
        
        <form action="buscar_cliente.php" method="get" class="form_search">
          <input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
          <input type="submit" value="Buscar" class=" ">
        </form> 

        <table>
          <tr>   
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>            
            <th>Direccion</th>
            <th>NIT</th>
            <th>Teléfono</th>            
            <th>Acciones</th>
          </tr>

<?php 
$query = mysqli_query($conect,"SELECT id_Cliente, nombreCli, apellidoCli, direccionCli, nitCli,telefono FROM clientes WHERE (id_Cliente LIKE  '%$busquedas%' OR
        nombreCli  LIKE '%$busquedas%' OR 
        apellidoCli LIKE '%$busquedas%' OR 
        direccionCli LIKE '%$busquedas%' OR 
        nitCli LIKE '%$busquedas%' OR
        Telefono LIKE '%$busquedas%')");

$result = mysqli_num_rows($query);
if ($result > 0) {
    while($data = mysqli_fetch_array($query)){
?>
          <tr>
            <td><?php echo $data["id_Cliente"];?></td>
            <td><?php echo $data["nombreCli"];?></td>
            <td><?php echo $data["apellidoCli"];?></td>
            <td><?php echo $data["direccionCli"];?></td>
            <td><?php echo $data["nitCli"];?></td>
            <td><?php echo $data["telefono"];?></td>                       
            <td>
                <a class="link_edit" href="Editar_Clientes.php? id=<?php echo $data["id_Cliente"];?>">Editar</a>                 
                <?php echo "  |  ";?>
                <a class="link_delete" href="Eliminar_Clientes.php? id=<?php echo $data["id_Cliente"];?>">Eliminar</a>                
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