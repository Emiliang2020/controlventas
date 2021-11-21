<?php
include "../conexion.php";
if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['condicion']) || empty($_POST['empleado'])) {
        $alert = '<p class="msg_error">No lleno todos los campos</p>';
        
    } else {    

        $iduser     = $_POST['idUsuario']; // este no se utiliza en las lineas de arriba
        $usuario    = $_POST['usuario'];
        $clave      = $_POST['clave'];       
        $condic     = $_POST['condicion'];
        $emple      = $_POST['empleado'];

        $sql_update = mysqli_query($conect, "UPDATE usuarios
                                             SET nombreUsuario  = '$usuario', 
                                                 claveUsuario   = '$clave', 
                                                 condicion      = '$condic', 
                                                 id_Empleado    = '$emple'
                                             WHERE id_Usuario    = $iduser");
            if($sql_update){
                $alert = '<p class="msg_save">Modificación exitosa</p>';
            }else {               
                $alert = '<p class="msg_error">Error no se actualizó el usuario</p>';
            }
        }
    }

// Mostrar datos
if (empty($_GET['id'])) {
    header('Location: Lista_Usuarios.php');    
} 
$idusuario = $_GET['id'];
//echo $idusuario;
$sql= mysqli_query($conect,"SELECT id_Usuario,nombreUsuario,claveUsuario,condicion,id_Empleado FROM usuarios WHERE id_usuario = $idusuario");
$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
    header('Location: Lista_Usuarios.php');    
}else{
    $option = '';
    while($data = mysqli_fetch_array($sql)){
        $iduser  = $data['id_Usuario'];
        $usuario  = $data['nombreUsuario'];
        $clave   = $data['claveUsuario'];       
        $condic   = $data['condicion'];
        $emple     = $data['id_Empleado'];
        
/*id_Usuario
nombreUsuario
claveUsuario
condicion 
id_Empleado */

        /*
        //validando el rol
        if ($idrol == 1) {
            $option = '<option value"'.$idrol.'"select>'.$rol.'</option>';
        } elseif ($idrol == 2) {
            $option = '<option value"'.$idrol.'"select>'.$rol.'</option>';
        } elseif ($idrol == 3) {
            $option = '<option value"'.$idrol.'"select>'.$rol.'</option>';
        } */        
    }
} 
?>
              
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Actualizar Usuarios</title>
</head>
<body>    
    <?php include "includes/header.php"; ?>
    <section id="container">
        <div class="form_register">
            <h1>Actualizar Usuario</h1>
            <hr>
            <div class="alert"> <?php echo isset($alert) ? $alert : ''; ?></div>
            <form action="" method="post">
               
                <input type="hidden" name="idUsuario" value="<?php echo $iduser; ?>"  < -- Oculta este valor -->
                
                <label for="nombre">Usuario</label>
                <input type="text" name="usuario" id="nombre" placeholder="Nombre completo" value="<?php print_r($usuario); ?>">
                
                <label for="clave">Clave</label>
                <input type="clave" name="clave" id="clave" placeholder="password" value="<?php echo $clave; ?>">
                
                <label for="condicion">Condición</label>
                <input type="text" name="condicion" id="condicion" placeholder="condicion" value="<?php echo $condic; ?>">
                
                <label for="empleado">Código Empleado</label>
                <input type="text" name="empleado" id="empleado" placeholder="codigo Empleado" value="<?php echo $emple;?>">                                
                
                <input type="submit" value="Actualizar" class="btn-save">
            </form>
        </div>
    </section>
    <?php include "includes/footer.php"; ?>
</body>

</html>