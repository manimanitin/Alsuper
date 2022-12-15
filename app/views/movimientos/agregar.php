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
    // print_r($data['prod']);
?>
    <div id="datos">

        <form action="<?=
                        URLROOT;
                        ?>/movimientos/agregar" method="POST" enctype="multipart/form-data">
            <!-- ========== Start Section ======== poner verificacion== -->

            <div class="mb-3">
                <label for="" class="form-label">Producto</label>
                <br>
                <select name="producto-id">
                    <?php
                    foreach ($data['prod'] as $registro) {
                    ?>
                        <option value="<?php echo $registro->id; ?>">
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
                <input type="text" class="form-control" name="mov-cantidad" id="username" placeholder="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Fecha</label>
                <input type="date" class="form-control" name="mov-fecha" id="pass" placeholder="">
            </div>
            <div class="mb-3">

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

                    'mov-cantidad': {
                        required:true,
                        digits: true
                    },
                    'mov-fecha': {
                        required: true
                    },


                    agree: 'required'
                },
                messages: {

                    'mov-cantidad': {
                        required:'Ingrese la cantidad',
                        digits: "Solo números"
                    },
                    'mov-fecha': {
                        required:'Ingrese la fecha',
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