<?php

class ControladorUsuarios
{

    static public function ctrCrearUsuario()
    {
        if (isset($_POST['nuevoUsuario'])) {
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['nuevoNombre']) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['nuevoUsuario']) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['nuevoPassword'])
            ) {

                $ruta = "";
                if (isset($_FILES['nuevaFoto']['tmp_name'])) {

                    list($ancho, $alto) = getimagesize($_FILES['nuevaFoto']['tmp_name']);
                    $nuevoancho = 500;
                    $nuevoalto = 500;

                    //directorio

                    $directorio = "vistas/img/usuarios/" . $_POST['nuevoUsuario'];
                    mkdir($directorio, 0755);

                    // proceso de recorte de la foto

                    if ($_FILES['nuevaFoto']['type'] == "image/jpeg") {

                        $aleatorio = mt_rand(100, 999);
                        $ruta = $directorio . "/" . $aleatorio . ".jpg";
                        /* imagecreatefromjpg NO EXISTE se usa imagecreatefromjpeg*/
                        // $origen = imagecreatefromjpg($_FILES['nuevaFoto']['tmp_name']);
                        $origen = imagecreatefromjpeg($_FILES['nuevaFoto']['tmp_name']);
                        $destino = imagecreatetruecolor($nuevoancho, $nuevoalto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoancho, $nuevoalto, $ancho, $alto);
                        /* imagejpg NO EXISTE se usa imagejpeg*/
                        // imagejpg($destino,$ruta);
                        imagejpeg($destino, $ruta);
                    }
                    if ($_FILES['nuevaFoto']['type'] == "image/png") {

                        $aleatorio = mt_rand(100, 999);
                        $ruta = $directorio . "/" . $aleatorio . ".png";
                        $origen = imagecreatefrompng($_FILES['nuevaFoto']['tmp_name']);
                        $destino = imagecreatetruecolor($nuevoancho, $nuevoalto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoancho, $nuevoalto, $ancho, $alto);
                        imagepng($destino, $ruta);
                    }
                }

                $tabla = "usuarios";
                $datos = array(
                    "nombre" => $_POST['nuevoNombre'],
                    "usuario" => $_POST['nuevoUsuario'],
                    "password" => $_POST['nuevoPassword'],
                    "perfil" => $_POST['nuevoPerfil'],
                    // "ruta" => $_POST['ruta']
                    "ruta" => $ruta
                );
                $respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);
                if ($respuesta == "ok") {

                    echo ("<script>

                            Swal.fire({
                                        title: 'Success!',
                                        text: '¡Registro Exitoso!',
                                        icon: 'success',
                                        confirmButtonText: 'Ok'
                                    
                                    });

                        </script>");
                }
            } else {
                //echo ('<script>alert ("ingreso");</script>');
                echo ("<script>

                            Swal.fire({
                                        title: 'Error!',
                                        text: '¡No puedes usar caraacteres especiales!',
                                        icon: 'error',
                                        confirmButtonText: 'Ok'
                                
                                    });
                            </script>");
            }
        }
    }


    static public function ctrIngreso()
    {
        if (isset($_POST['ingUsuario'])) {
            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingUsuario']) && preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingPassword'])) {
                $tabla = "usuarios";
                $item = "usuario";
                $valor = $_POST['ingUsuario'];
                // $salt = md5($_POST['ingPassword']);
                // $passwordEncriptado = crypt($_POST['ingPassword'],$salt);
                $passwordEncriptado = $_POST['ingPassword'];
                $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);
                if ($respuesta['usuario'] == $_POST['ingUsuario'] && $respuesta['password'] == $passwordEncriptado) {
                    if ($respuesta['estado'] == 1) {
                        $_SESSION['iniciarSesion'] = "ok";
                        echo '<script>
                                    window.location = "inicio";
                                </script>';
                    } else {
                        echo ("<div class='alert alert-danger'>Error al ingresar al sistema</div>");
                    }
                }
            }
        }
    }
}
