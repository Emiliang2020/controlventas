<?php
include "../conexion.php";
if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['direccion']) || empty($_POST['nit']) || empty($_POST['telefono'])) {
        $alert = '<p class="msg_error">No lleno todos los campos</p>';
    } else {        
        $idCliente  = $_POST['idCliente'];
        $nombre     = $_POST['nombre'];
        $apellido   = $_POST['apellido'];
        $direccion  = $_POST['direccion'];
        $nit        = $_POST['nit'];
        $telefono   = $_POST['telefono'];
        
        $sql_update = mysqli_query($conect, "UPDATE CLIENTES
                                             SET   nombreCli     ='$nombre', 
                                                   apellidoCli   = '$apellido',
                                                   direccionCli  = '$direccion', 
                                                   nitCli        = '$nit', 
                                                   telefono      = '$telefono'
                                             WHERE id_Cliente    = $idCliente");
        }
            
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

$idCliente = $_GET['id'];
$sql= mysqli_query($conect,"SELECT id_Cliente, nombreCli, apellidoCli, direccionCli, nitCli,telefono 
                            FROM clientes  
                            WHERE id_Cliente = $idCliente");

$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
    header('Location: Lista_Clientes.php');
}else{   
    while($data = mysqli_fetch_array($sql)){        

        $idCliente  =  $data["id_Cliente"];
        $nombre     =  $data["nombreCli"];
        $apellido   =  $data["apellidoCli"];
        $direccion  =  $data["direccionCli"];
        $nit        =  $data["nitCli"];
        $telefono   =  $data["telefono"]; 
    }
} 
?>
              
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Actualizar Clientes</title>
</head>

<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        <div class="form_register">
            <h1>Actualizar Cliente</h1>
            <hr>
            <div class="alert"> <?php echo isset($alert) ? $alert : ''; ?></div>
            <form action="" method="post">
                
                <input type="hidden" name="idCliente" value="<?php echo $idCliente; ?>"  < -- Oculta este valor -->
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="NOMBRES" value="<?php print_r($nombre); ?>">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" id="apellido" placeholder="APELLIDOS" value="<?php print_r($apellido); ?>">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" id="direccion" placeholder="DIRECCION" value="<?php echo $direccion; ?>">
                <label for="fecha">NIT</label>
                <input type="text" name="nit" id="nit" placeholder="NIT" value="<?php echo $nit; ?>">
                <label for="monto">Teléfono</label>
                <input type="text" name="telefono" id="telefono" placeholder="TELEFONO" value="<?php echo $telefono;?>">                
                <input type="submit" value="Actualizar" class="btn-save">
            </form>
        </div>
    </section>
    <?php include "includes/footer.php"; ?>
</body>

</html>