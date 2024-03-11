<?php
    include('../conexion/conexion.php')

    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID']: '';
    $txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre']: '';
    $txtApaterno = (isset($_POST['txtApaterno'])) ? $_POST['txtApaterno']: '';
    $txtAmaterno = (isset($_POST['txtAmaterno'])) ? $_POST['txtAmaterno']: '';
    $txtCorreo = (isset($_POST['txtCorreo'])) ? $_POST['txtCorreo']: '';
    $txtFoto = (isset($_POST['txtFoto'])) ? $_POST['txtFoto']: '';
    $accion = (isset($_POST['accion'])) ? $_POST['accion']: '';

    $error = array();

    $accionAgregar = '';
    $accionModificar = $accionEliminar = $accionCancelar = "disabled";
    $mostrarModal = false;
    swicth ($accion) {
        case 'btnAgregar';
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

    }
?>