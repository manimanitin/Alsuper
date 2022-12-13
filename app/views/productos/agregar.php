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
                        ?>/productos/agregar" method="POST" enctype="multipart/form-data">
            <!-- ========== Start Section ======== poner verificacion== -->
            <div class="mb-3">
                <label for="" class="form-label">Nombre de producto</label>
                <input type="text" class="form-control" name="producto-nombre" id="username" placeholder="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Stock</label>
                <input type="number" class="form-control" name="producto-stock" id="pass" placeholder="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Precio</label>
                <input type="number" class="form-control" name="producto-precio" id="pass2" placeholder="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Fecha</label>
                <input type="date" class="form-control" name="producto-fecha" id="cp" placeholder="">
            </div>
            <!-- <div class="mb-3">
                <label for="" class="form-label">ID Proveedor</label>
                <input type="number" class="form-control" name="proveedor-id" id="nivel" placeholder="">
            </div> -->
            <div class="mb-3">
                <label for="" class="form-label">Proveedor</label>
                <br>
                <select name="proveedor-id">
                    <?php
                    foreach ($data['prov'] as $registro) {
                    ?>
                        <option value="<?php echo $registro->id; ?>">
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
                <input type="file" class="form-control" name="producto-foto" id="foto" placeholder="">
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
    <div>
    </div>
    <br>

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