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
    //var_dump($data->id)
?>
    <div id="datos">
        <form action="<?= URLROOT; ?>/productos/editar/<?= $data->id; ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $data->id; ?>">
            <div class="mb-3">
                <label for="" class="form-label">Nombre de producto</label>
                <input type="text" class="form-control" name="producto-nombre" id="username" value='<?= $data->producto_nombre ?>' placeholder="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Stock</label>
                <input type="text" class="form-control" name="producto-stock" id="pass" value="<?= $data->producto_stock ?>" placeholder="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Precio Unitario</label>
                <input type="text" class="form-control" name="producto-precio" id="pass2" value='<?= $data->producto_precio ?>' placeholder="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Fecha Ingreso</label>
                <input type="date" class="form-control" name="producto-fecha" id="cp" value='<?= $data->producto_fecha ?>' placeholder="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Proveedor</label>
                <br>
                <select name="proveedor-id">
                    <?php
                    foreach ($data->prov as $registro) {
                    ?>
                        <option value="<?php echo $registro->id; ?>" <?php
                                                                        if ($data->proveedor_id ==  $registro->id) {
                                                                            echo ' selected';
                                                                        }
                                                                        ?>>
                            <?php echo $registro->prov_nombre;
                            ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Foto</label>
                <input type="file" class="form-control" name="producto-foto" id="foto" value="" placeholder="">
            </div>
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