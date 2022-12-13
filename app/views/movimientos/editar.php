<?php
include_once APPROOT . '/views/includes/header.inc.php';
?>
<!-- para recibir emsansjes -->

<?php
if (isset($data->msg_error) && $data->msg_error != '') {
    echo '<div class="alert alert-warning">' . $data->msg_error . '</div>';
}
// print_r($data->prod);
?>
<?php
if (estaLogueado()) {
    //var_dump($data->id)
?>
    <div id="datos">
        <form action="<?= URLROOT; ?>/movimientos/editar/<?= $data->id; ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $data->id; ?>">

            <div class="mb-3">
                <label for="" class="form-label">Proveedor</label>
                <br>
                <select name="producto-id">
                    <?php
                    foreach ($data->prod as $registro) {
                    ?>
                        <option value="<?php echo $registro->id; ?>" <?php
                                                                        if ($data->producto_id ==  $registro->id) {
                                                                            echo ' selected';
                                                                        }
                                                                        ?>>
                            <?php echo $registro->producto_nombre;
                            ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Cantidad</label>
                <input type="text" class="form-control" name="mov-cantidad" id="username" value='<?= $data->mov_cantidad ?>' placeholder="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Fecha</label>
                <input type="date" class="form-control" name="mov-fecha" id="pass" value='<?= $data->mov_fecha ?>' placeholder="">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Registrar</button>

        </form>
    </div>

    <script>
        $(document).ready(function() {
            $("#datos form").validate({
                rules: {
                    'producto_nombre': {
                        required: true,
                    },

                    'producto_direccion': {
                        required: true,
                    },

                    'producto_cp': {
                        required: true
                    }
                },
                messages: {
                    'producto_nombre': {
                        required: "Ingresa el nombre del producto",
                    },
                    'producto_direccion': {
                        required: "Ingresa la dirección",
                    },
                    'producto_cp': {
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