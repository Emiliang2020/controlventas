<?php
include "../conexion.php"; 
//----------------------------------------------
    $idCliente = $_POST['idCliente']?? '';   
    //query para eliminar un registro de la base de datos.
    $query_delete = mysqli_query($conect,"DELETE FROM clientes WHERE id_Cliente = $idCliente");
    //query para cambiar de estatus un registro de la base de datos, sin eliminar.
    //$query_delete = mysqli_query($conect,"UPDATE clientes SET Estatus = 0 WHERE idCliente = $idCliente");

    if ($query_delete) {
        header('Location: Lista_Clientes.php');
    }else {
        //echo "Error al eliminar";
    }


//--- capturamos los valores en la cajetas
if (empty($_REQUEST['id'])) {
    header('Location: Lista_Clientes.php');
} 
$idCliente = $_REQUEST['id'];
$sql= mysqli_query($conect,"SELECT id_Cliente, nombreCli, apellidoCli, direccionCli, nitCli,telefono 
                            FROM clientes  
                            WHERE id_Cliente = $idCliente");

$result_sql = mysqli_num_rows($sql);

if ($result_sql > 0) {
    while($data = mysqli_fetch_array($sql)){

        $idCliente  =  $data["id_Cliente"];
        $nombre     =  $data["nombreCli"];
        $apellido   =  $data["apellidoCli"];
        $direccion  =  $data["direccionCli"];
        $nit        =  $data["nitCli"];
        $telefono   =  $data["telefono"]; }

    } else {
         header('Location: Lista_Clientes.php');
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";?>
	<title>ELIMINAR CLIENTES</title>
</head>
<body>
<?php include "includes/header.php";?>
	<section id="container">
        <div class="data_delete"> 
            <h2>¿Esta seguro?</h2>            
            <p>Nombre:    <span><?php echo $nombre;    ?></span></p>
            <p>Apellido:  <span><?php echo $apellido;  ?></span></p>
            <p>Dirección: <span><?php echo $direccion; ?></span></p>
            <p>Nit:       <span><?php echo $nit;       ?></span></p>
            <p>Telefono:  <span><?php echo $telefono;  ?></span></p>
            
        </div>
        <form method="post" action="">
            <input type="hidden" name="idCliente" value="<?php echo $idCliente;?>">
                <a href="Lista_Clientes.php" class="btn_Cancelar">Cancelar</a>
            <input type="submit" value="Aceptar" class="btn_Aceptar">
        </form>

	</section>
	<?php include "includes/footer.php";?>	
</body>
</html>