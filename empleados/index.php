<?php 
    require 'empleados.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C R U D PHP</title>
    <!--Boostrap 4.5 para los estilos-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" 
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" 
    crossorigin="anonymous"> 
     <!--Esta libreria es para Jquery--> <!--Jquery son para nombres de etiquetas y se usa el simbolo de dolar $$-->
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" 
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
    crossorigin="anonymous"></script>
    <!--Esto es para popper -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" 
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" 
    crossorigin="anonymous"></script>
    <!--Bootstrap 4.5--> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" 
    integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
     crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
    <form action="" method="post" enctype="multipart/form-data">
    <!--Modal-->
    <div class="modal fade"
    id="exampleModal"
    tabIndex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">

    <div class="modal-dialog" >
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Empleado</h5>
                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="close"
                        >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <input type="hidden" name="txtID" 
                            required 
                            value="<?php echo $txtID; ?>" 
                            id="txtID">
                    <!--Nombres del formulario-->        
                    <div class="form-group col-md-12">
                        <label for="">Nombre(s): </label>
                        <input type="text"
                                class="form-grup <?php echo(isset($error['nombre']))?"is-invalid":""; ?>"
                                name="txtNombre"
                                id="txtNombre"
                                value="<?php echo $txtNombre; ?>">
                        <div class="invalid-feedback">
                        <?php echo(isset($error['nombre'])) ?>
                        </div>
                        <br>
                    </div>

                    <!--Apelldio paterno del formulario-->
                    <div class="form-group col-md-12">
                        <label for="">Apaterno: </label>
                        <input type="text"
                                class="form-grup <?php echo(isset($error['apaterno']))?"is-invalid":""; ?>"
                                name="txtApaterno"
                                id="txtApaterno"
                                value="<?php echo $txtApaterno; ?>">
                        <div class="invalid-feedback">
                        <?php echo(isset($error['apaterno'])) ?>
                        </div>
                        <br>
                    </div>

                    <!--Este es el campo del apellido materno-->
                    <div class="form-group col-md-12">
                        <label for="">Amaterno: </label>
                        <input type="text"
                                class="form-grup <?php echo(isset($error['amaterno']))?"is-invalid":""; ?>"
                                name="txtAmaterno"
                                id="txtAmaterno"
                                value="<?php echo $txtAmaterno; ?>">
                        <div class="invalid-feedback">
                        <?php echo(isset($error['amaterno'])) ?>
                        </div>
                        <br>
                    </div>

                    <!--Este es el campo del correo en el registro-->
                    <div class="form-group col-md-12">
                        <label for="">Correo: </label>
                        <input type="text"
                                class="form-grup <?php echo(isset($error['correo']))?"is-invalid":""; ?>"
                                name="txtCorreo"
                                id="txtCorreo"
                                value="<?php echo $txtCorreo; ?>">
                        <div class="invalid-feedback">
                        <?php echo(isset($error['correo'])) ?>
                        </div>
                        <br>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="">Foto: </label>
                        <?php if($txtFoto) {?>
                            <br>
                            <img  class="img-thumbnail rounded mx-auto d-block"
                            width="100px"
                            src="../imagenes/<?php echo $txtFoto; ?>">
                        <?php } ?>
                        <input type="file"
                        name="txtFoto"
                        id="txtFoto"
                        class="form-control"
                        accept="image/*"
                        value="<?php echo $txtFoto ?>">
                        <br>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success"
                        type="submit"
                        name="acccion"
                        value="btnAgregar"
                        <?php echo $accionAgregar; ?> 
                        >
                    Agregar
                </button>

                <button class="btn btn-warning"
                        type="submit"
                        name="acccion"
                        value="btnModificar"
                        <?php echo $accionModificar; ?> 
                        >
                    Modificar
                </button>
                <button class="btn btn-danger"
                        type="submit"
                        name="acccion"
                        value="btnEliminar"
                        <?php echo $accionEliminar; ?> 
                        onclick="return confirmar('¿Estas seguro?');"
                        >
                    Eliminar
                </button>

                <button class="btn btn-primary"
                        type="submit"
                        name="acccion"
                        value="btnCancelar"
                        <?php echo $accionCancelar; ?> 
                        >
                    Cancelar
                </button>
            </div>
        </div>
    </div>
    </div>

    <button type="button" 
            class="btn btn-primary" 
            data-toggle="modal" 
            data-target="#exampleModal">
        Agregar Registro  +
    </button>
    </form>
        <!--Tabla de registros en BD-->
        <div class="row">
            <table class="table table-hover table-bordered">
                <thead class="dark">
                    <tr>
                        <th>Foto</th>
                        <th>Nombre del usuario</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($listaEmpleados as $empleado) { ?>
                    <tr>
                        <td>
                            <img 
                                src="../imagenes/<?php echo $empleado['Foto']; ?>" 
                                class="img-tumbnail" 
                                width="100px"
                                >
                        </td>
                        <td>
                            <?php echo $empleado['nombre']; ?> <?php echo $empleado['apaterno']; ?> <?php echo $empleado['amaterno'];?>
                        
                        </td>
                        <td>
                            <?php echo $empleado['correo']; ?>
                        </td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden"
                                        name="txtID"
                                        value="<?php echo $empleado ['id']; ?>"
                                        >
                                <input type="submit"
                                        value="Seleccionar"
                                        class="btn btn-danger"
                                        name="accion"
                                >
                                <button type="submit"
                                        value="btnEliminar"
                                        onclick="return Confirmar('Estas seguro?')"
                                        class="btn btn-info"
                                        name="accion"
                                    >
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
                    </table>
        </div>
  </div>  

  <?php if($mostrarModal) { ?>
    <script>
            $('#exampleModal').modal('show')
    </script>
    <?php } ?>

   
     <script src="/empleados/empleados.js"></script>
</body>
</html>