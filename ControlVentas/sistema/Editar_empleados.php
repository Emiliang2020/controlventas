<?php
include "../conexion.php";
if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['nombreEmpleado']) || empty($_POST['apellidoEmpleado']) || empty($_POST['fechaNacimiento']) || empty($_POST['direccion']) || empty($_POST['inicio_laboral']) || empty($_POST['cese_laboral']) || empty($_POST['id_Rol'])) {
        $alert = '<p class="msg_error">No lleno todos los campos</p>';
    } else {                      
        $idEmpleado  =  $_POST["id_Empleado"];
        $nombre      =  $_POST["nombreEmpleado"];
        $apellido    =  $_POST["apellidoEmpleado"];
        $FechaNac    =  $_POST["fechaNacimiento"];
        $Direccion   =  $_POST["direccion"];
        $InicioLab   =  $_POST["inicio_laboral"];
        $FinalLab    =  $_POST["cese_laboral"];       
        $condicion   = "1";
        $Rol         =  $_POST["id_Rol"]; 

        

        $sql_update = mysqli_query($conect, "UPDATE empleados
                                             SET 
                                                 nombreEmpleado   = '$nombre',
                                                 apellidoEmpleado = '$apellido',
                                                 fechaNacimiento  = '$FechaNac',
                                                 direccion        = '$Direccion',
                                                 inicio_laboral   = '$InicioLab',
                                                 cese_laboral     = '$FinalLab', 
                                                 condicion        = '$condicion',
                                                 id_Rol           = '$Rol' 
                                                                                          
                                             WHERE id_Empleado    = $idEmpleado");
        }
            
        if($sql_update){
                $alert = '<p class="msg_save">Modificación exitosa</p>';
            }else {               
                $alert = '<p class="msg_error">Error no se actualizó el usuario, verifique</p>';
            }
        }    
// Mostrar datos
if (empty($_GET['id'])) {
    header('Location: Lista_Creditos.php');
} 

$idEmpleado = $_GET['id'];
$sql= mysqli_query($conect,"SELECT id_Empleado, nombreEmpleado, apellidoEmpleado, fechaNacimiento, direccion, inicio_laboral,cese_laboral,id_Rol 
                            FROM empleados  
                            WHERE id_Empleado = $idEmpleado");

$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
    header('Location: Lista_empleados.php');
}else{   
    while($data = mysqli_fetch_array($sql)){        

        $idEmpleado  =  $data["id_Empleado"];
        $nombre      =  $data["nombreEmpleado"];
        $apellido    =  $data["apellidoEmpleado"];
        $FechaNac    =  $data["fechaNacimiento"];
        $Direccion   =  $data["direccion"];
        $InicioLab   =  $data["inicio_laboral"];
        $FinalLab    =  $data["cese_laboral"];       
        $Rol         =  $data["id_Rol"]; 
    }
} 

/* id_Empleado 
nombreEmpleado
apellidoEmpleado
fechaNacimiento 
inicio_laboral
cese_laboral 
condicion 
id_Rol  */


?>
              
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Actualizar Empleados</title>
</head>

<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        <div class="form_register">
            <h1>Actualizar Empleados</h1>
            <hr>
            <div class="alert"> <?php echo isset($alert) ? $alert : ''; ?></div>
            <form action="" method="post">
                
                <input type="hidden" name="id_Empleado" value="<?php echo $idEmpleado; ?>"  < -- Oculta este valor -->
                <label for="nombre">Nombre</label>
                <input type="text" name="nombreEmpleado" id="nombre" placeholder="NOMBRES" value="<?php print_r($nombre); ?>">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellidoEmpleado" id="apellido" placeholder="APELLIDOS" value="<?php print_r($apellido); ?>">
                <label for="nacimiento">Nacimiento</label>
                <input type="text" name="fechaNacimiento" id="Nacimiento" placeholder="Fecha de Nacido" value="<?php echo $FechaNac; ?>">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" id="Direccion" placeholder="Direccion" value="<?php echo $Direccion; ?>">
                <label for="fecha">Inicio de labores</label>
                <input type="text" name="inicio_laboral" id="Inicio_Labor" placeholder="NIT" value="<?php echo $InicioLab; ?>">
                <label for="fecha">Fecha de Despido</label>                
                <input type="text" name="cese_laboral" id="Cese_Labor" placeholder="Cece Laboral" value="<?php echo   $FinalLab ; ?>">
                <label for="monto">Rol</label>
                <input type="text" name="id_Rol" id="telefono" placeholder="TELEFONO" value="<?php echo $Rol;?>">                
                <input type="submit" value="Actualizar" class="btn-save">
            </form>
        </div>
    </section>
    <?php include "includes/footer.php"; ?>
</body>

</html>