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
    <div class="row mt-3 mb-3">
        <div class="col-sm-11">
            <a class="btn btn-success btn-xs" href="<?= URLROOT; ?>/productos/csv">Exportar a CSV</a>
            <a class="btn btn-success btn-xs" href="<?= URLROOT; ?>/productos/json">Exportar a JSON</a>
            <a class="btn btn-success btn-xs" href="<?= URLROOT; ?>/productos/pdf">Exportar a PDF</a>

        </div>
        <div class="col-sm-1">
            <a class="btn btn-success btn-xs" href="<?= URLROOT; ?>/productos/agregar"><i class="fa fa-plus"></i></a>
        </div>

    </div>

    <div class="col-sm-11"></div>
    <div class="table-responsive">
        <table class="table table-bordered table hover">
            <tbody>
                <th>ID</th>
                <th>Nombre</th>
                <!-- <th>Contraseña</th> -->
                <th>Stock</th>
                <th>Proveedor</th>
                <th>Precio</th>
                <th>Fecha</th>
                <th>Foto</th>
                <?php
                foreach ($data['productos'] as $registro) {
                ?>

                    <tr>
                        <td><?php echo $registro->id; ?></td>
                        <td><?php echo $registro->producto_nombre; ?></td>
                        <td><?php echo $registro->producto_stock; ?></td>
                        <td><?php echo $registro->prov_nombre; ?></td>
                        <td><?php echo $registro->producto_precio; ?></td>
                        <td><?php echo $registro->producto_fecha; ?></td>

                        <td><img src="data:image/png;base64,<?php echo base64_encode($registro->producto_foto); ?>" height="30" width="30" alt="Foto"></td>


                        <td>
                            <a href="<?= URLROOT; ?>/productos/editar/<?= $registro->id; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>

                            <a type='button' href="#" class="btn btn-danger btn-sm eliminarFila" data-bs-toggle="modal" data-bs-target="#modalEliminar" data-fila=<?php echo $registro->id; ?>>
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
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
    <nav aria-label="Page navigation example">
        <div class="col-sm-6">Mostrando <?= count($data['productos']); ?> de <?= $data['registros']; ?></div>

        <ul class="pagination justify-context-center">
            <li class="page-item <?= ($data['pagina'] <= 1) ? 'disabled' : ''; ?>">
                <a class="page-link" href="<?= ($data['pagina'] <= 1) ? '#' : URLROOT . '/productos/index/' . $data['limite'] . '/' . $data['previa']; ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php
            for ($i = 1; $i <= $data['paginas']; $i++) {
            ?>
                <li class="page-item <?= ($data['pagina'] == $i) ? 'active' : ''; ?>"><a class="page-link" href="<?= URLROOT . '/productos/index/' . $data['limite'] . '/' . $i; ?>"><?= $i; ?></a></li>
            <?php
            }
            ?>


            <li class="page-item <?= ($data['paginas'] <= $data['pagina']) ? 'disabled' : ''; ?>">
                <a class="page-link" href="<?= ($data['paginas'] <= $data['pagina']) ? '#' : URLROOT . '/productos/index/' . $data['limite'] . '/' . $data['siguiente']; ?>" aria-label="Previous">
                    <span aria-hidden="true">&raquo;</span>
                </a>
        </ul>
    </nav>

    <!-- MODAL ELIMINAR-->
    <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEliminarLabel">Eliminar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Estas seguro que quieres eliminar este registro de producto?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form id='formEliminar' action="<?= URLROOT; ?>/productos/eliminar/<?= $registro->id ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="porBorrar" value="">
                        <button type="submit" class="btn btn-primary">Eliminar Producto</button></a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).on('click', '.eliminarFila', function() {
            document.getElementById("formEliminar").action = "<?= URLROOT; ?>/productos/eliminar/" + $(this).data('fila');
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