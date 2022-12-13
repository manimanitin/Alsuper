<?php
include_once APPROOT . '/views/includes/header.inc.php';
?>
<!-- para recibir emsansjes -->

<?php
if (isset($data['msg_error']) && $data['msg_error'] != '') {
    echo '<div class="alert alert-warning">' . $data['msg_error'] . '</div>';
}

?>
<?php
if (estaLogueado()) {
    # code...

?>
    <div id="datos">
        <form action="<?=
                        URLROOT;
                        ?>/proveedores/agregar" method="POST" enctype="multipart/form-data">
            <!-- ========== Start Section ======== poner verificacion== -->
            <div class="mb-3">
                <label for="prov_nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="prov_nombre" id="prov_nombre" placeholder="">
            </div>
            <div class="mb-3">
                <label for="prov_direccion" class="form-label">Direcci&oacute;n</label>
                <input type="text" class="form-control" name="prov_direccion" id="prov_direccion" placeholder="">
            </div>
            <div class="mb-3">
                <label for="prov_cp" class="form-label">CP</label>
                <input type="text" class="form-control" name="prov_cp" id="prov_cp" placeholder="">
            </div>

    </div>
    <div>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </div>
    <br>

    <script>
        $(document).ready(function() {
            $("#datos form").validate({
                rules: {
                    'prov_nombre': {
                        required: true,
                        pattern: /^[a-z ,.'-]+$/
                    },
                    'prov_direccion': {
                        required: true,
                        pattern: /^[#.0-9a-zA-Z\s,-]+$/
                    },
                    'prov_cp': {
                        required: true,
                        digits: true,

                    },
                    agree: 'required'
                },
                messages: {
                    'prov_nombre': {
                        required: "ingrese el nombre del proveedor",
                        pattern: "ingrese un nombre valido"
                    },
                    'prov_direccion': {
                        required: "ingrese la direccion",
                        pattern: "Ingrese una direccion valida"
                    },
                    'prov_cp': {
                        required: "ingrese el código postal",
                        digits: "Ingrese solo numeros",

                    },
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