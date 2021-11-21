<?php
include "../conexion.php";
if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['empresa']) || empty($_POST['direccion']) ||empty($_POST['telefono'])) {
        $alert = '<p class="msg_error">No lleno todos los campos</p>';
        
    } else {    

        $iduser    = $_POST['idprov']; // este no se utiliza en las lineas de arriba
        $nombre    = $_POST['nombre'];
        $apellido  = $_POST['apellido'];       
        $empresa   = $_POST['empresa'];
        $direc     = $_POST['direccion'];
        $telefono  = $_POST['telefono'];
                                            
        $sql_update = mysqli_query($conect, "UPDATE PROVEEDORES
                                             SET    nombreProv    = '$nombre', 
                                                    apellidoProv  = '$apellido', 
                                                    empresaProv   = '$empresa', 
                                                    direccionProv = '$direc',
                                                    telefono      = '$telefono'
                                             WHERE  id_Proveedor  =  $iduser");
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
$idproveedor = $_GET['id'];
//echo $idusuario;
$sql= mysqli_query($conect,"SELECT id_Proveedor, nombreProv, apellidoProv, empresaProv, direccionProv, telefono FROM PROVEEDORES WHERE id_Proveedor = $idproveedor");
$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
    header('Location: Lista_Proveedores.php');    
}else{
    $option = '';
    while($data = mysqli_fetch_array($sql)){
        
        $idproveedor  = $data['id_Proveedor'];
        $name         = $data['nombreProv'];
        $lastname     = $data['apellidoProv'];       
        $empresa      = $data['empresaProv'];
        $direc        = $data['direccionProv'];       
        $telefono     = $data['telefono'];       
    
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
               
                <input type="hidden" name="idprov" value="<?php echo $idproveedor; ?>"  < -- Oculta este valor -->
                
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombres" value="<?php print_r($name); ?>">
                
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" id="apellido" placeholder="Apellidos" value="<?php echo $lastname; ?>">
                
                <label for="empresa">Empresa</label>
                <input type="text" name="empresa" id="empresa" placeholder="Empresa" value="<?php echo $empresa; ?>">

                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" id="direccion" placeholder="Dirección" value="<?php echo $direc ; ?>">
                
                <label for="telefono">Telefono</label>
                <input type="text" name="telefono" id="telefono" placeholder="ó Celular" value="<?php echo $telefono;?>">                                
                
                <input type="submit" value="Actualizar" class="btn-save">
            </form>
        </div>
    </section>
    <?php include "includes/footer.php"; ?>
</body>

</html>