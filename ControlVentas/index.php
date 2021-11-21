<?php
$alert = '';
/*Iniciamos sesion*/              
session_start();

#código para no loguearse cada vez que retornemos a la pagina anterior.
if (!empty($_SESSION['active'])) {
    header('location: sistema/');  
}else{
    
if (!empty($_POST)) {
    if (empty($_POST['usuario'])|| empty($_POST['clave'])) {
        $alert = 'Ingrese su usuario y su contraseña';
    }else{
          require_once "conexion.php";
            # mysqli_real_escape_string = esta funcion sirve para evitar caracteres raros, como una posible
            #                             inyeccion a la base de datos.
            # md5  = sirve para encriptar el usuario y la contraseña; en este caso.
         /*  $user = mysqli_real_escape_string($conect, $_POST['usuario']);
          $pass = (mysqli_real_escape_string($conect, $_POST['clave'])); */

          $user =  $_POST['usuario'];
          $pass =  $_POST['clave'];

          $query = mysqli_query($conect,"Select * from usuarios where nombreUsuario = '$user' and claveUsuario= '$pass'");          
          $result = mysqli_num_rows($query);
          echo $result;

          if ($result > 0) {
              $data = mysqli_fetch_array($query); # mete en un array el resultado del query              

              $_SESSION['active'] = true;
              $_SESSION['idUser'] = $data['id_Usuario'];                       
              $_SESSION['user']   = $data['nombreUsuario'];
              
              #redireccionamos a otra carpeta  
              header('location: sistema/');
              }else{
                $alert = 'El usuario ó contraseña, son incorrectos';
                session_destroy();
                   }
        }    
    }
}    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Sistema de Ventas</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>     
    <section id = "container">
       <form action="" method="post">
           <h3>Iniciar Sesión</h3>
           <img src="img/Login Manager.png" alt="Login">
            
              <input type="text" name="usuario" placeholder="Usuario">
              <input type="password" name="clave" placeholder="Contraseña">
            
            <div class="alert"><?php echo isset($alert)? $alert : '';?></div>
           <input type="submit" value="INGRESAR">
       </form>
    </section>
</body>
</html>