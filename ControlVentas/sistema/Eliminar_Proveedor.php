<?php
include "../conexion.php";
if (!empty($_POST)) {
    //Validación para no eliminar usuario cuyo rol sea 1 = administrador
    if ($_POST['idprovee']==1) {
        header('Location: Lista_Proveedores.php');
        exit;
    }
//----------------------------------------------
    $idproveedores = $_POST['idprovee'];
    //query para eliminar un registro de la base de datos.
     $query_delete = mysqli_query($conect,"DELETE FROM PROVEEDORES WHERE id_Proveedor = $idproveedores");
    //query para cambiar de estatus un registro de la base de datos, sin eliminar.
    //$query_delete = mysqli_query($conect,"UPDATE usuarios SET condicion = 0 WHERE id_Usuario = $idusuario");

    if ($query_delete) {
        header('Location: Lista_Proveedores.php');
    }else {
        echo "Error al eliminar";
    }
}

//-------------------------

if (empty($_REQUEST['id'])) {
    header('Location: Lista_Proveedores.php');
} 
$idproveedor = $_REQUEST['id'];
//id_Proveedor, nombreProv, apellidoProv, empresaProv, direccionProv, telefono
$sql= mysqli_query($conect,"SELECT id_Proveedor, nombreProv, apellidoProv, empresaProv, direccionProv, telefono
                            FROM PROVEEDORES 
                            WHERE id_Proveedor = $idproveedor");

$result_sql = mysqli_num_rows($sql);

if ($result_sql > 0) {
    while($data = mysqli_fetch_array($sql)){ 

        $idproveedor = $data['id_Proveedor'];
        $NOMBRE    = $data['nombreProv'];
        $APELLIDO  = $data['apellidoProv'];
        $EMPRESA   = $data['empresaProv'];        
        $DIREC     = $data['direccionProv'];        
        $TEL       = $data['telefono']; }

        } else {
            header('Location: Lista_Proveedores.php');
                }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";?>
	<title>ELIMINAR PROVEEDOR</title>
</head>
<body>
<?php include "includes/header.php";?>
	<section id="container">
        <div class="data_delete"> 
            <h2>¿Esta seguro?</h2>


            <p>Nombre:   <span><?php echo $NOMBRE;  ?></span></p>
            <p>Apellido: <span><?php echo $APELLIDO;?></span></p>
            <p>Empresa:  <span><?php echo $EMPRESA; ?></span></p>
            <p>Dirección:<span><?php echo $DIREC;   ?></span></p>            
            <p>Teléfono: <span><?php echo $TEL;     ?></span></p>

        </div>
        <form method="post" action="">
            <input type="hidden" name="idprovee" value="<?php echo $idproveedor;?>">
            <a href="Lista_Proveedores.php" class="btn_Cancelar">Cancelar</a>
            <input type="submit" value="Aceptar" class="btn_Aceptar">
        </form>

	</section>
	<?php include "includes/footer.php";?>	
</body>
</html>