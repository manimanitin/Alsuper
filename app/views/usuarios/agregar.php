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
                        ?>/usuarios/agregar" method="POST" enctype="multipart/form-data">
            <!-- ========== Start Section ======== poner verificacion== -->
            <div class="mb-3">
                <label for="" class="form-label">ID</label>
                <input type="text" class="form-control" name="usuario-id" id="id" placeholder="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Nombre de usuario</label>
                <input type="text" class="form-control" name="usuario-username" id="username" placeholder="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="usuario-password" id="usuario-password" placeholder="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Confirmar contraseña</label>
                <input type="password" class="form-control" name="usuario-confirmacion" id="usuario-confirmacion" placeholder="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Nombre Completo</label>
                <input type="text" class="form-control" name="usuario-nombreCompleto" id="usuario-nombreCompleto" placeholder="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Nivel</label>
                <br>
                <select name="usuario-nivel">
                    <option value="1" selected>
                        Administrador
                    </option>
                    <option value="0">
                        Usuario
                    </option>
                </select>
            </div>
    </div>
    <div>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </div>
    </form>

    <br>

    <script>
        $(document).ready(function() {
            $("#datos form").validate({
                rules: {
                    'usuario-id': {
                        required: true,
                        digits: true
                    },
                    'usuario-username': {
                        required: true,
                        pattern: /^[a-z0-9]+$/
                    },
                    'usuario-password': {
                        required: true,
                        minlength: 2,
                        pattern: /^[a-z0-9]+$/

                    },
                    'usuario-confirmacion': {
                        required: true,
                        equalTo: '#usuario-password',
                        pattern: /^[a-z0-9]+$/

                    },
                    'usuario-nombreCompleto': {
                        required: true,
                        pattern: /^[a-zA-Z\s,.'-]+$/
                    },
                    'usuario-nivel': {
                        required: true,
                        number: true
                    },
                    agree: 'required'
                },
                messages: {
                    'usuario-id': {
                        required: "ingresa una id",
                        digits: "utiliza solo digitos"
                    },
                    'usuario-username': {
                        required: "ingresa un nombre de usuario",
                        pattern: "utiliza solo digitos y letras"
                    },
                    'usuario-password': {
                        required: "ingresa una contraseña",
                        minlength: "necesita mas de 2 caracteres",
                        pattern: "utiliza solo digitos y letras"
                    },
                    'usuario-confirmacion': {
                        required: "vuelve a ingresar la contraseña",
                        minlength: "necesita mas de 2 caracteres",
                        pattern: "utiliza solo digitos y letras",
                        equalTo: 'no coincide'
                    },
                    'usuario-nombreCompleto': {
                        required: "ingresa un nombre",
                        pattern: "Utiliza solo caracteres"
                    },
                    'usuario-nivel': {
                        required: "ingresa un nivel",
                        number: "utiliza solo numeros"
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