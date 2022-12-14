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
    $datos = explode(' ', end($data));
?>



    <div class="row mt-3 mb-3">
        <div class="col-sm-11">
            <a class="btn btn-success btn-xs" href="<?= URLROOT; ?>/movimientos/mes/<?= $datos[0] ?>/<?= $datos[1] ?>/1">Exportar a CSV</a>
            <a class="btn btn-success btn-xs" href="<?= URLROOT; ?>/movimientos/mes/<?= $datos[0] ?>/<?= $datos[1] ?>/2">Exportar a JSON</a>
            <a class="btn btn-success btn-xs" href="<?= URLROOT; ?>/movimientos/mes/<?= $datos[0] ?>/<?= $datos[1] ?>/3">Exportar a PDF</a>

        </div>

    </div>

    <div class="col-sm-11"></div>
    <div class="table-responsive">
        <table class="table table-bordered table hover">
            <tbody>
                <th>ID</th>
                <th>Producto_id</th>
                <!-- <th>Contraseña</th> -->
                <th>Cantidad</th>
                <th>Fecha</th>
                <?php
                foreach ($data as $registro) {
                    if (!isset($registro->id)) {
                        break;
                    }
                ?>

                    <tr>
                        <td><?php echo $registro->id; ?></td>
                        <td><?php echo $registro->producto_id; ?></td>
                        <td><?php echo $registro->mov_cantidad; ?></td>
                        <td><?php echo $registro->mov_fecha; ?></td>

                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="9">DERECHOS RESERVADOS</td>
                </tr>
            </tfoot>
        </table>
    </div>


    <!-- MODAL ELIMINAR-->
    <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEliminarLabel">Eliminar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Estas seguro que quieres eliminar este registro de movimiento?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form id='formEliminar' action="<?= URLROOT; ?>/movimientos/eliminar/<?= $registro->id ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="porBorrar" value="">
                        <button type="submit" class="btn btn-primary">Eliminar Movimiento</button></a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).on('click', '.eliminarFila', function() {
            document.getElementById("formEliminar").action = "<?= URLROOT; ?>/movimientos/eliminar/" + $(this).data('fila');
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