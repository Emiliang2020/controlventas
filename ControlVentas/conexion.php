 <?php
 	// Esta conexion es con mysql.
 	$host = 'Localhost';
 	$user = 'root';
 	#$password = '1234';
    $password = '';  	
    $db = 'PROYECTG_2';

    // CONEXION AL SERVIDOR
    $conect = @mysqli_connect($host,$user,$password,$db);
   

    if (!$conect) {
    	            echo "Error al conectar";    
                  } else {
    	                # echo "La conexion ha sido exitosa";
                         }
 ?>