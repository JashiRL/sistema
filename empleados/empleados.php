<?php
    include('../conexion/conexion.php');

    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID']: '';
    $txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre']: '';
    $txtApaterno = (isset($_POST['txtApaterno'])) ? $_POST['txtApaterno']: '';
    $txtAmaterno = (isset($_POST['txtAmaterno'])) ? $_POST['txtAmaterno']: '';
    $txtCorreo = (isset($_POST['txtCorreo'])) ? $_POST['txtCorreo']: '';
    $txtFoto = (isset($_FILES['txtFoto']['name'])) ? $_FILES['txtFoto']['name']: '';
    $accion = (isset($_POST['accion'])) ? $_POST['accion']: '';

    $error = array();

    $accionAgregar = '';
    $accionModificar = $accionEliminar = $accionCancelar = "disabled";
    $mostrarModal = false;
    switch ($accion) {
        case 'btnAgregar':
            if ($txtNombre == ''){
            $error ['Nombre'] = 'nombre no puede ir vacio';
            }
            if ($txtApaterno == ''){
                $error ['APaterno'] = 'apellido paterno no puede ir vacio';
                }
             if ($txtAmaterno == ''){
                $error ['AMaterno'] = 'apellido materno no puede ir vacio';
                }
            if ($txtCorreo == ''){
                $error ['Correo'] = 'correo no puede ir vacio';
                }   
            //este es por si no se cumple alguna de las condiciones del 
            if(count($error) >0 ){
                $mostrarModal = true;
                break;
            }
            $query = $pdo->prepare('INSERT INTO empleados(nombre, apaterno, amaterno, correo, foto)
                                    VALUES(:nombre, :apaterno, :amaterno, :correo, :foto)');
                                    //los :nombre es para evitar las SQLinyections y así no puedan rastrear 
                                    // la informacion que se inserta o muestra
            $query->bindParam(':nombre', $txtNombre);
            $query->bindParam(':apaterno', $txtApaterno);
            $query->bindParam(':amaterno', $txtAmaterno);
            $query->bindParam(':correo', $txtCorreo);
            $fecha = new Datetime();
            $nombreFoto = ($txtFoto != '') ? $fecha->getTimestamp(). '_' . $_FILES['txtFoto']['name'] : 'image';
            //numero de hora a nivel mundial
            $tmpFoto = $_FILES ['txtFoto']['tmp_name'];

            if ($tmpFoto != '') {
                move_uploaded_file($tmpFoto, '../imagenes/'.$nombreFoto);
            }

            $query->bindParam(':foto', $nombreFoto);
            $query->execute();
            header('Location: index.php');
            break;
        
            case 'btnEliminar':
                $queryEliminar = $pdo->prepare('SELECT foto FROM empleados WHERE id=:id');
                $queryEliminar->bindParam(':id', $txtID);
                $queryEliminar->execute();
                $empleado = $queryEliminar->fecth(PDO::FETCH_LAZY);

                if(isset($empleado['foto']) && $empleado['foto'] != 'image') {
                    if (file_exists('../imagenes/'. $empleado['foto'])) {
                        unlink('../imagenes/'.$empleado['foto']);
                    }
                }

            $queryDelete = $pdo->prepare('DELETE FROM empleados WHERE id=:id');
            $queryDelete->bindParam(':id', $txtID);
            header('location: index.php');
            break;

            case 'btnModificar':
                    $queryUpdate = $pdo->prepare("UPDATE empleados SET nombre =:nombre, 
                    apaterno= :apaterno, amaterno=:amaterno, correo= :correo WHERE id=:id");
                $queryUpdate->bindParam(':nombre', $txtNombre);
                $queryUpdate->bindParam(':apaterno', $txtApaterno);
                $queryUpdate->bindParam(':amaterno', $txtAmaterno);
                $queryUpdate->bindParam(':correo', $txtCorreo);
                $queryUpdate->bindParam(':id', $txtID);
                $queryUpdate->execute();
                $fecha = new DateTime();
                $nombreFoto = ($txtFoto != '') ? $fecha->getTimestamp() . "_" . $__FILES["txtFoto"]["name"] : "image";
                $tmpFoto = $_FILES ['txtFoto']['tmp_name'];
                if ($tmpFoto != '') {
                    move_uploaded_file($tmpFoto, "../imagenes/".$nombreFoto);
                $queryEliminar = $pdo->prepare('SELECT foto FROM empleados WHERE id=:id');
                $queryEliminar->bindParam(':id', $txtID);
                $queryEliminar->execute();
                $empleado = $queryEliminar->fecth(PDO::FETCH_LAZY);

                if(isset($empleado['foto']) && $empleado['foto'] != 'image') {
                    if (file_exists('../imagenes/'. $empleado['foto'])) {
                        unlink('../imagenes/'.$empleado['foto']);
                    }
                    }
                    $queryUpdateFoto = $pdo -> prepare('UPDATE empleados SET foto=:foto WHERE id=:id');
                    $queryUpdateFoto->bindParam(':foto', $nombreFoto);
                    $queryUpdateFoto->bindParam(':id', $txtID);
                }
                header('Location: index.php');
            break;

            case 'btnCancelar':
                header('Location: index.php');
            break;
            case 'Seleccionar':
                    $accionAgregar = "disabled";
                    $accionModificar = $accionEliminar = $accionCancelar = '';
                    $mostrarModal = true;
                    $queryEmpleado = $pdo->prepare('SELECT * FROM empleados WHERE id=:id');
                    $queryEmpleado->bindParam(':id', $txtID);
                    $queryEmpleado->execute();
                    $empleado = $queryEmpleado ->fetch(PDO::FETCH_LAZY);
                    $txtNombre = $empleado['nombre'];
                    $txtApaterno = $empleado['apaterno'];
                    $txtAmaterno = $empleado['apaterno'];
                    $txtCorreo = $empleado['correo'];
                    $txtFoto = $empleado['foto'];
            break;
    }

    $querySelect = $pdo->prepare('SELECT * FROM empleados');
    $querySelect->execute();
    $listaEmpleados = $querySelect->fecthAll(PDO::FETCH_ASSOC);
?>