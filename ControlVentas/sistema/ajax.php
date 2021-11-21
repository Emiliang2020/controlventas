

<?php 
 include "../conexion.php";   

    //buscar cliente, viene de funtion.js
   if($_POST['action'] == 'searchCliente'){
        if(!empty($_POST['cliente'])){
            $nit = $_POST['cliente'];

            $query = mysqli_query($conect,"SELECT * FROM clientes WHERE nitCli = '$nit' AND estatus = 1");
            mysqli_close($conect);  //Cerramos la conexión
            $result = mysqli_num_rows($query);
            if ($result > 0) {
                $data = mysqli_fetch_array($query);
            }else{
                    $data = 0;
                 }
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
                 
        }
      exit;
    }


//--------------------------------------------------------------------------
//Registra clientes, viene de funtion.js
if($_POST['action'] == 'addCliente'){
        
        $id_C       = "";
        $nit        = $_POST['nit_cliente'];
        $nombre     = $_POST['nom_cliente'];
        $apellido   = $_POST['ape_cliente'];
        $telefono   = $_POST['tel_cliente'];
        $direccion  = $_POST['dir_cliente'];
        $status = '1';
        
        $query_insert = mysqli_query($conect, "INSERT INTO CLIENTES 
                                               VALUES('$id_C','$nombre','$apellido','$direccion','$nit','$telefono','$status')");
        
            if ($query_insert) {
                $codigoCliente = mysqli_insert_id($conect);
                $msg = $codigoCliente;               
                                
            } else {
                $msg = 'Error';
            }
            mysqli_close($conect);    
            //echo $msg;
            exit;

    }
//-------------------------------------------------------------------
    
    //buscar producto, viene de funtion.js
   if($_POST['action'] == 'Info_Producto'){
    if(!empty($_POST['producto'])){
        $codProd = $_POST['producto'];

        $query = mysqli_query($conect,"SELECT nombreProd, existenciaProd,  precioVenta 
                                       FROM productos 
                                       WHERE id_Productos = '$codProd' AND condicion = '1'");
        mysqli_close($conect);  //Cerramos la conexión
        $result = mysqli_num_rows($query);

        if ($result > 0) {
            $dataPro = mysqli_fetch_array($query);
        }else{
                $dataPro = 0;
             }
        echo json_encode($dataPro, JSON_UNESCAPED_UNICODE);
             
    }
  exit;
}
  
//......................................................................................
// AGREGAR registros a la tabla detalle, por procedimiento almacenado
// Viene de funtion,js

if($_POST['action'] == 'addProductoDetalle'){

    //print_r($_POST); exit;
        
     if(empty($_POST['producto']) || empty($_POST['No_factura']) || empty($_POST['cantidad']) ){  
        
        echo 'Error';

    } else {
        $codProd = $_POST['producto'];
        $No_factura = $_POST['No_factura'];
        $cantidad = $_POST['cantidad'];

        $query_detalleFactura = mysqli_query($conect, "CALL add_detalle_facturas($codProd, $No_factura, $cantidad)");
        $result = mysqli_num_rows($query_detalleFactura);

        $detalleTabla = '';
        //$detalleTotal = '';
        $total = 0;
        $arrayData = array();

        if($result > 0){

        while($data = mysqli_fetch_assoc($query_detalleFactura)){
            $precioTotal = round($data['cantidad'] * $data['precioVenta'], 2);
            $total = round($total + $precioTotal,2);

        //creamos la tabla del detalle desde acá y no desde el propio formulario en nueva_venta.php
        $detalleTabla .= '
                                <tr>
                                    <td>'.$data['id_Productos'].'</td>
                                    <td colspan="2">'.$data['nombreProd'].'</td>
                                    <td class="textcenter">'.$data['cantidad'].'</td>
                                    <td class="textright">'.$data['precioVenta'].'</td>
                                    <td class="textright">'.$precioTotal.'</td>
                                    <td class="">
                                        <a href="#" class="link_delete" onclick="event.preventDefault();
                                        del_producto_detalle('.$data['id_Productos'].');">
                                        <i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>  ';
        } // termina el While
        
        $detalleTotal = '
                            <tr>
                            <td colspan="5" class="textright">Total</td>
                            <td class="textright">'.$total.'</td>
                            </tr>
                        ';
       
        
        // Lineas de código que concatenan las tablas que se han creado.
        $arrayData['detalle'] = $detalleTabla;
        $arrayData['totales'] = $detalleTotal;

        //echo $arrayData;
        // Retornamos estos valores por medio de las siguiente línea de código
        echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
        
        } else {
            echo "Error";
        }
        mysqli_close($conect);
    }         

}



// Elimina registros de la tabla detalles
if($_POST['action'] == 'del_producto_detalle'){
  //print_r($_POST); exit;
   if(empty($_POST['id_Producto']) || empty($_POST['No_factura']) ){  
         
          echo 'Error';

    } else {
         $idProducto = $_POST['id_Producto'];
         $NumFactura = $_POST['No_factura'];
   
        date_default_timezone_set("America/Guatemala"); // necesaria para optener la hora de mi país
        $fechaAct = date('Y-m-d');       


        $query_EliminaDeldetalleFactura = mysqli_query($conect, "CALL eliminaReg_detalle_facturas($idProducto, $NumFactura)");
        $result = mysqli_num_rows( $query_EliminaDeldetalleFactura);
           

    $detalleTabla = '';
    $detalleTotal = '';
    $total = 0;
    $arrayData = array();

    if($result >= 0){

    while($data = mysqli_fetch_assoc( $query_EliminaDeldetalleFactura)){
        $precioTotal = round($data['cantidad'] * $data['precioVenta'], 2);
        $total = round($total + $precioTotal,2);

    //creamos la tabla del detalle desde acá y no desde el propio formulario en nueva_venta.php
    $detalleTabla .= '
                            <tr>
                                <td>'.$data['id_Productos'].'</td>
                                <td colspan="2">'.$data['nombreProd'].'</td>
                                <td class="textcenter">'.$data['cantidad'].'</td>
                                <td class="textright">'.$data['precioVenta'].'</td>
                                <td class="textright">'.$precioTotal.'</td>
                                <td class="">
                                    <a href="#" class="link_delete" onclick="event.preventDefault();
                                    del_producto_detalle('.$data['id_Productos'].');">
                                    <i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>  ';
    } // termina el While
    
    $detalleTotal = '
                        <tr>
                        <td colspan="5" class="textright">Total</td>
                        <td class="textright">'.$total.'</td>
                        </tr>
                    ';
   
    
    // Lineas de código que concatenan las tablas que se han creado.
    $arrayData['detalle'] = $detalleTabla;
    $arrayData['totales'] = $detalleTotal;

    // Retornamos estos valores por medio de las siguiente línea de código
    echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
    
    } else {
        echo 'Error';       
    }
    mysqli_close($conect);
}        

}



// ver los registros en la tabla detalle, en la ventana nueva venta, viene de funtions.js
if($_POST['action'] == 'extraerDetalle'){

     //print_r($_POST);exit;
         
     if(empty($_POST['numFact']) ){  
         
         echo 'Error el post esta vacío';
 
     } else {
         $numFact = $_POST['numFact'];
        
        date_default_timezone_set("America/Guatemala"); // necesaria para optener la hora de mi país
        $fechaAct = date('Y-m-d');       
   

        $query = mysqli_query($conect, "SELECT Dtf.id_factura, P.id_Productos, P.nombreProd, Dtf.cantidad, P.precioVenta
                                         FROM detalle_facturas Dtf
                                         INNER JOIN productos P
                                         ON Dtf.id_Productos = P.id_Productos
                                         WHERE Dtf.id_factura = '$numFact' AND Dtf.fecha = '$fechaAct' "); 
               
        $result = mysqli_num_rows($query);
       
       

         $detalleTabla = '';
         $detalleTotal = '';
         $total = 0;
         $arrayData = array();
 
         if($result > 0){
 
         while($data = mysqli_fetch_assoc($query)){
             $precioTotal = round($data['cantidad'] * $data['precioVenta'], 2);
             $total = round($total + $precioTotal,2);
 
         //creamos la tabla del detalle desde acá y no desde el propio formulario en nueva_venta.php
         $detalleTabla .= '
                                 <tr>
                                     <td>'.$data['id_Productos'].'</td>
                                     <td colspan="2">'.$data['nombreProd'].'</td>
                                     <td class="textcenter">'.$data['cantidad'].'</td>
                                     <td class="textright">'.$data['precioVenta'].'</td>
                                     <td class="textright">'.$precioTotal.'</td>
                                     <td class="">
                                         <a href="#" class="link_delete" onclick="event.preventDefault();
                                         del_producto_detalle('.$data['id_Productos'].');">
                                         <i class="far fa-trash-alt"></i></a>
                                     </td>
                                 </tr>  ';
         } // termina el While
         
         $detalleTotal .= '
                             <tr>
                             <td colspan="5" class="textright">Total</td>
                             <td class="textright">'.$total.'</td>
                             </tr>
                         ';
        
         
         // Lineas de código que concatenan las tablas que se han creado.
         $arrayData['detalle'] = $detalleTabla;
         $arrayData['totales'] = $detalleTotal;
 
         // Retornamos estos valores por medio de las siguiente línea de código
         echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
         
         } else {
             echo "Error algo anda mal";
         }
         mysqli_close($conect);
     }       
 
 }






?>
