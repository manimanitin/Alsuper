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
    # code...
?>
    <div id="datos">
        <form action="<?=
                        URLROOT;
                        ?>/proveedores/editar/<?= $data->id ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $data->id; ?>">
            <!-- ========== Start Section ======== poner verificacion== -->
            <div class="mb-3">
                <label for="prov_nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="prov_nombre" id="nombre" placeholder="" value="<?= $data->prov_nombre; ?>">
            </div>
            <div class="mb-3">
                <label for="prov_direccion" class="form-label">Direccion</label>
                <input type="text" class="form-control" name="prov_direccion" id="direccion" placeholder="" value="<?= $data->prov_direccion; ?>">
            </div>
            <div class="mb-3">
                <label for="prov_cp" class="form-label">CP</label>
                <input type="text" class="form-control" name="prov_cp" id="cp" placeholder="" value="<?= $data->prov_cp; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Editar</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $("#datos form").validate({
                rules: {

                    'prov_nombre': {
                        required: true,
                    },
                    'prov_direccion': {
                        required: true,
                    },

                    'prov_cp': {
                        required: true
                    },
                    agree: 'required'
                },
                messages: {
                    'prov_rfc': {
                        required: "ingresa rfc",
                    },
                    'prov_nombre': {
                        required: "ingresa nombre",
                    },
                    'prov_direccion': {
                        required: "ingresa direccion",
                    },
                    'prov_telefono': {
                        required: "ingresa telefono",
                    },
                    'prov_correo': {
                        require: "ingresa correo",
                        email: "ingresa correo",
                    },
                    'prov_cp': {
                        required: "ingresa codigo postal"
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