<?php 
   include "../conexion.php";   
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";?>
	<title>Lista de Productos</title>
</head>
<body>
<?php include "includes/header.php";?>
	<section id="container">
<?php  /*strtolower() = funcion para convertir a minusculas*/
  $busquedas = strtolower( $_REQUEST['busqueda']);
  if (empty($busquedas)) {
      header("location: lista_Productos.php");
  }
//--------
?>
		<h1>Lista de Productos</h1>
        <a href="Registro_Clientes.php" class="btn_new">Nuevo Producto</a>
        
        <form action="buscar_Producto.php" method="get" class="form_search">
          <input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
          <input type="submit" value="Buscar" class=" ">
        </form> 

        <table>
          <tr>   
            <th>ID</th>
            <th>Nombre</th>
            <th>Costo</th>            
            <th>Venta</th>
            <th>Existencia</th>
            <th>No_Stand</th> 
            <th>Categoría</th>           
            <th>Proveedor</th>
            <th>Acción</th>

          </tr>

<?php 
$query = mysqli_query($conect,"SELECT id_Productos, nombreProd, precioCosto, precioVenta, existenciaProd, no_stad, condicion, id_Categoria, id_Proveedor 
                               FROM productos where (id_Productos LIKE  '%$busquedas%' OR
                                                     nombreProd  LIKE '%$busquedas%' OR 
                                                     precioCosto LIKE '%$busquedas%' OR 
                                                     precioVenta LIKE '%$busquedas%' OR 
                                                     existenciaProd LIKE '%$busquedas%' OR 
                                                     no_stad LIKE '%$busquedas%' OR 
                                                     condicion LIKE '%$busquedas%' OR 
                                                     id_Categoria LIKE '%$busquedas%' OR 
                                                     id_Proveedor LIKE '%$busquedas%')");
$result = mysqli_num_rows($query);
if ($result > 0) {
    while($data = mysqli_fetch_array($query)){
?>
          <tr>            
            <td><?php echo  $data["id_Productos"];?></td>
            <td><?php echo $data["nombreProd"];?></td>
            <td><?php echo $data["precioCosto"];?></td>
            <td><?php echo $data["precioVenta"];?></td>
            <td><?php echo $data["existenciaProd"];?></td>
            <td><?php echo $data["no_stad"];?></td>            
            <td><?php echo $data["id_Categoria"];?></td>
            <td><?php echo $data["id_Proveedor"];  ?></td>                              
            <td>
                <a class="link_edit" href="Editar_Clientes.php? id=<?php echo $data["id_Producto"];?>">Editar</a>                 
                <?php echo "  |  ";?>
                <a class="link_delete" href="Eliminar_Clientes.php? id=<?php echo $data["id_Producto"];?>">Eliminar</a>                
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