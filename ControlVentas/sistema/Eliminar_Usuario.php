<?php
include "../conexion.php";
if (!empty($_POST)) {
    //Validación para no eliminar usuario cuyo rol sea 1 = administrador
    if ($_POST['idusuario']==1) {
        header('Location: Lista_Usuarios.php');
        exit;
    }
//----------------------------------------------
    $idusuario = $_POST['idusuario'];
    //query para eliminar un registro de la base de datos.
    //$query_delete = mysqli_query($conect,"DELETE FROM usuario WHERE idusuario = $idusuario");
    //query para cambiar de estatus un registro de la base de datos, sin eliminar.
    $query_delete = mysqli_query($conect,"UPDATE usuarios SET condicion = 0 WHERE id_Usuario = $idusuario");

    if ($query_delete) {
        header('Location: Lista_Usuarios.php');
    }else {
        echo "Error al eliminar";
    }
}

//-------------------------

if (empty($_REQUEST['id'])) {
    header('Location: Lista_Usuarios.php');
} 
$idusuario = $_REQUEST['id'];

$sql= mysqli_query($conect,"SELECT id_Usuario,nombreUsuario,claveUsuario,condicion,id_Empleado 
                            FROM usuarios 
                            WHERE id_Usuario = $idusuario");

$result_sql = mysqli_num_rows($sql);

if ($result_sql > 0) {
    while($data = mysqli_fetch_array($sql)){       
        $usuario    = $data['nombreUsuario'];        
        $clave      = $data['claveUsuario'];        
        $condic     = $data['condicion'];
        $emple      = $data['id_Empleado'];
        }
} else {
    header('Location: Lista_Usuarios.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";?>
	<title>ELIMINAR USUARIO</title>
</head>
<body>
<?php include "includes/header.php";?>
	<section id="container">
        <div class="data_delete"> 
            <h2>¿Esta seguro?</h2>
            <p>Usuario:  <span><?php echo $usuario; ?></span></p>
            <p>Clave:    <span><?php echo $clave;   ?></span></p>
            <p>Condicion:<span><?php echo $condic;  ?></span></p>            
            <p>Cod Empleado: <span><?php echo $emple;   ?></span></p>
        </div>
        <form method="post" action="">
            <input type="hidden" name="idusuario" value="<?php echo $idusuario;?>">
            <a href="Lista_Usuarios.php" class="btn_Cancelar">Cancelar</a>
            <input type="submit" value="Aceptar" class="btn_Aceptar">
        </form>

	</section>
	<?php include "includes/footer.php";?>	
</body>
</html>