<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // Conexión a la base de datos
        $conexion = new mysqli("localhost", "usuario", "contraseña", "basedatos");
        if ($conexion->connect_error) {
            die("Error de conexión a la base de datos: " . $conexion->connect_error);
        }

        // Función de bienvenida
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === '/') {
            echo "Bienvenido a la API";
            exit();
        }

        // Función de consulta
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === '/usuarios') {
            $resultados = $conexion->query("SELECT * FROM usuarios");
            $usuarios = array();

            while ($fila = $resultados->fetch_assoc()) {
                $usuarios[] = $fila;
            }

            header('Content-Type: application/json');
            echo json_encode($usuarios);
            exit();
        }

        // Función de inserción
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/usuarios') {
            $datos = json_decode(file_get_contents('php://input'), true);

            $nombre = $datos['nombre'];
            $email = $datos['email'];
            $telefono = $datos['telefono'];

            $conexion->query("INSERT INTO usuarios (nombre, email, telefono) VALUES ('$nombre', '$email', '$telefono')");

            if ($conexion->affected_rows > 0) {
                echo "Usuario insertado correctamente";
            } else {
                echo "Error al insertar el usuario";
            }
            exit();
        }

        // Función de actualización
        if ($_SERVER['REQUEST_METHOD'] === 'PUT' && preg_match('/^\/usuarios\/(\d+)$/', $_SERVER['REQUEST_URI'], $matches)) {
            $id = $matches[1];
            $datos = json_decode(file_get_contents('php://input'), true);

            $nombre = $datos['nombre'];
            $email = $datos['email'];
            $telefono = $datos['telefono'];

            $conexion->query("UPDATE usuarios SET nombre='$nombre', email='$email', telefono='$telefono' WHERE id=$id");

            if ($conexion->affected_rows > 0) {
                echo "Usuario actualizado correctamente";
            } else {
                echo "Error al actualizar el usuario";
            }
            exit();
        }

        // Función de eliminación
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && preg_match('/^\/usuarios\/(\d+)$/', $_SERVER['REQUEST_URI'], $matches)) {
            $id = $matches[1];

            $conexion->query("DELETE FROM usuarios WHERE id=$id");

            if ($conexion->affected_rows > 0) {
                echo "Usuario eliminado correctamente";
            } else {
                echo "Error al eliminar el usuario";
            }
            exit();
        }

        // Cierre de la conexión a la base de datos
        $conexion->close();
        ?>
    </body>
</html>
