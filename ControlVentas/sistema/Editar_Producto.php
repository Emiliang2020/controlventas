<?php
include "../conexion.php";
if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['nombre']) || empty($_POST['precioCosto']) || empty($_POST['precioVenta']) || empty($_POST['existenciaProd']) 
    || empty($_POST['no_stad']) || empty($_POST['condicion']) || empty($_POST['id_Categoria']) || empty($_POST['id_Proveedor'])) {
        $alert = '<p class="msg_error">No lleno todos los campos</p>';
    } else {   

        $idProducto  =  $_POST["idProducto"];
        $nombre      =  $_POST["nombre"];
        $precioCosto =  $_POST["precioCosto"];
        $precioVenta =  $_POST["precioVenta"];
        $existencia  =  $_POST["existenciaProd"];
        $ubicacion   =  $_POST["no_stad"];
        $condicion   =  $_POST["condicion"];
        $Categoria   =  $_POST["id_Categoria"];
        $Proveedor   =  $_POST["id_Proveedor"]; 
        
        $sql_update = mysqli_query($conect, "UPDATE productos
                                             SET   nombreProd       = '$nombre',
                                                   precioCosto      = '$precioCosto',
                                                   precioVenta      = '$precioVenta',
                                                   existenciaProd   = '$existencia',
                                                   no_stad          = '$ubicacion', 
                                                   condicion        = '$condicion',
                                                   id_Categoria     = '$Categoria',
                                                   id_Proveedor     = '$Proveedor' 
                                             WHERE id_Productos     = $idProducto");
        }
            
          /* id_Productos =
          nombreProd  =
          precioCosto =
          precioVenta =
          existenciaProd =
          no_stad =
          condicion =
          id_Categoria =
          id_Proveedor = 

        $idProducto 
        $nombre     
        $precioCosto
        $precioVenta
        $existencia 
        $ubicacion  
        $condicion 
        $Categoria 
        $Proveedor   */

        if($sql_update){
                $alert = '<p class="msg_save">Modificación exitosa</p>';
            }else {               
                $alert = '<p class="msg_error">Error no se actualizó el usuario</p>';
            }
        }    
// Mostrar datos
if (empty($_GET['id'])) {
    header('Location: Lista_Creditos.php');
} 

$idProducto = $_GET['id'];
$sql= mysqli_query($conect,"SELECT id_Productos, nombreProd, precioCosto, precioVenta, 
                            existenciaProd, no_stad, condicion, id_Categoria, 
                            id_Proveedor FROM productos where id_Productos = $idProducto");

$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
    header('Location: Lista_Productos.php');
}else{   
    while($data = mysqli_fetch_array($sql)){        

        $idProducto  =  $data["id_Productos"];
        $nombre     =  $data["nombreProd"];
        $precioCosto   =  $data["precioCosto"];
        $precioVenta  =  $data["precioVenta"];
        $existencia  =  $data["existenciaProd"];
        $ubicacion     =  $data["no_stad"];
        $condicion   =  $data["condicion"];
        $Categoria  =  $data["id_Categoria"];
        $Proveedor        =  $data["id_Proveedor"];        
    }
} 
?>
              
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Actualizar Producto</title>
</head>

<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        <div class="form_register">
            <h1>Actualizar Cliente</h1>
            <hr>
            <div class="alert"> <?php echo isset($alert) ? $alert : ''; ?></div>
            <form action="" method="post">
                
                <input type="hidden" name="idProducto" value="<?php echo $idProducto; ?>"  < -- Oculta este valor -->
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombreP" placeholder="NOMBRE PROD" value="<?php print_r($nombre); ?>">
                <label for="precioCosto">Precio Costo</label>
                <input type="text" name="precioCosto" id="precioCosto" placeholder="PRECIO COSTO" value="<?php print_r($precioCosto); ?>">
                <label for="precioVenta">Precio Venta</label>
                <input type="text" name="precioVenta" id="precioVenta" placeholder="PRECIO VENTA" value="<?php echo  $precioVenta; ?>">
                <label for="existencia">EXISTENCIA</label>
                <input type="text" name="existenciaProd" id="existenciaProd" placeholder="EXISTENCIA" value="<?php echo $existencia; ?>">
                <label for="monto">UBICACIÓN</label>
                <input type="text" name="no_stad" id="no_stad" placeholder="UBICACIÓN" value="<?php echo $ubicacion;?>"> 
                <label for="monto">CONDICION</label>
                <input type="text" name="condicion" id="condicion" placeholder="ESTADO" value="<?php echo $condicion;?>">
                <label for="monto">CATEGORIA</label>
                <input type="text" name="id_Categoria" id="id_Categoria" placeholder="CATEGORIA" value="<?php echo $Categoria;?>">
                <label for="monto">PROVEEDOR</label>
                <input type="text" name="id_Proveedor" id="id_Proveedor" placeholder="PROVEEDOR" value="<?php echo $Proveedor;?>">
                <input type="submit" value="ACTUALIZAR" class="btn-save">
            </form>
        </div>
    </section>
    <?php include "includes/footer.php"; ?>
</body>

</html>