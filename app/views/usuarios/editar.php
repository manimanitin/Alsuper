<?php
include_once APPROOT . '/views/includes/header.inc.php';
?>
<!-- para recibir emsansjes -->

<?php
if (isset($data->msg_error) && $data->msg_error != '') {
    echo '<div class="alert alert-warning">' . $data->msg_error . '</div>';
}

?>
<?php
if (estaLogueado()) {
?>
    <div id="datos">
        <form action="<?= URLROOT; ?>/usuarios/editar/<?= $data->id; ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $data->id; ?>">
            <!-- <div class="mb-3">
                <label for="" class="form-label">ID</label>
                <input type="text" class="form-control" name="usuario-id" id="iduser" placeholder="" value=<?= $data->usuario_id ?>>
            </div> -->
            <div class="mb-3">
                <label for="" class="form-label">Nombre de usuario</label>
                <input type="text" class="form-control" name="usuario-username" id="username" value='<?= $data->usuario_username ?>' placeholder="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Contraseña</label>
                <input type="text" class="form-control" name="usuario-password" id="pass" value="" placeholder="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Confirmar contraseña</label>
                <input type="text" class="form-control" name="usuario-confirmacion" id="pass2" value='' placeholder="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Nombre Completo</label>
                <input type="" class="form-control" name="usuario-nombreCompleto" id="cp" value='<?= $data->usuario_nombreCompleto ?>' placeholder="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Nivel</label>
                <input type="text" class="form-control" name="usuario-nivel" id="nivel" value='<?= $data->usuario_nivel ?>' placeholder="">
            </div>
            <button type="submit" class="btn btn-primary">Editar</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $("#datos form").validate({
                rules: {
                    'usuario_nombre': {
                        required: true,
                    },

                    'usuario_direccion': {
                        required: true,
                    },

                    'usuario_cp': {
                        required: true
                    }
                },
                messages: {
                    'usuario_nombre': {
                        required: "Ingresa el nombre del usuario",
                    },
                    'usuario_direccion': {
                        required: "Ingresa la dirección",
                    },
                    'usuario_cp': {
                        required: "Ingresa un codigo postal"
                    }
                },
                errorElement: "em",
                errorPlacement: function(error, element) {
                    // Add the `invalid-feedback` class to the error element
                    error.addClass("invalid-feedback");

                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.next("label"));
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                }
            });
        });
    </script>

<?php
} else {
?>
    Ingrese sesión
<?php
}
?>

<?php
include_once APPROOT . '/views/includes/footer.inc.php';

?>