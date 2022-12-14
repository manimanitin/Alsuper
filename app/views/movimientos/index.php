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
        <form action="<?= URLROOT; ?>/movimientos/mes/2022/12" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                Filtrar por
                <select id="opciones">
                    <option value="0">
                        -------
                    </option>
                    <option value="1">
                        Año
                    </option>
                    <option value="2">
                        Mes
                    </option>
                    <option value="3">
                        Semana
                    </option>
                </select>
            </div>
            <div id="anno">
                <div class="mb-3">
                    <label for="" class="form-label">AÑO</label>
                    <input type="text" class="form-control" name="year" id="fecha1" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">MES</label>
                    <input type="text" class="form-control" name="month" id="fecha2" placeholder="">
                </div>
            </div>

            <div id="mes" class="mb-3">
                <select id="meses">

                    <option value="1">
                        enero
                    </option>
                    <option value="2">
                        febrero
                    </option>
                    <option value="3">
                        marzo
                    </option>
                </select>
            </div>

            <div id="semana">
                <div class="mb-3">
                    <label for="" class="form-label">Fecha</label>
                    <input type="date" class="form-control" name="mov-fecha" id="pass" placeholder="">
                </div>
            </div>

            <div class="mb-3">

                <button type="submit" class="btn btn-primary" id="gen">Generar reporte</button>
        </form>
    </div>
    </form>


    <div class="row mt-3 mb-3">
        <!-- <div class="col-sm-11">
                <a class="btn btn-success btn-xs" href="<?= URLROOT; ?>/movimientos/csv">Exportar a CSV</a>
                <a class="btn btn-success btn-xs" href="<?= URLROOT; ?>/movimientos/json">Exportar a JSON</a>
                <a class="btn btn-success btn-xs" href="<?= URLROOT; ?>/movimientos/pdf">Exportar a PDF</a>

            </div> -->
        <div class="col-sm-1">
            <a class="btn btn-success btn-xs" href="<?= URLROOT; ?>/movimientos/agregar"><i class="fa fa-plus"></i></a>
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
                <th></th>
                <?php
                foreach ($data['movimientos'] as $registro) {
                ?>

                    <tr>
                        <td><?php echo $registro->id; ?></td>
                        <td><?php echo $registro->producto_id; ?></td>
                        <td><?php echo $registro->mov_cantidad; ?></td>
                        <td><?php echo $registro->mov_fecha; ?></td>
                        <td>
                            <a href="<?= URLROOT; ?>/movimientos/editar/<?= $registro->id; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>

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
        <div class="col-sm-6">Mostrando <?= count($data['movimientos']); ?> de <?= $data['registros']; ?></div>

        <ul class="pagination justify-context-center">
            <li class="page-item <?= ($data['pagina'] <= 1) ? 'disabled' : ''; ?>">
                <a class="page-link" href="<?= ($data['pagina'] <= 1) ? '#' : URLROOT . '/movimientos/index/' . $data['limite'] . '/' . $data['previa']; ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php
            for ($i = 1; $i <= $data['paginas']; $i++) {
            ?>
                <li class="page-item <?= ($data['pagina'] == $i) ? 'active' : ''; ?>"><a class="page-link" href="<?= URLROOT . '/movimientos/index/' . $data['limite'] . '/' . $i; ?>"><?= $i; ?></a></li>
            <?php
            }
            ?>


            <li class="page-item <?= ($data['paginas'] <= $data['pagina']) ? 'disabled' : ''; ?>">
                <a class="page-link" href="<?= ($data['paginas'] <= $data['pagina']) ? '#' : URLROOT . '/movimientos/index/' . $data['limite'] . '/' . $data['siguiente']; ?>" aria-label="Previous">
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

        $('#opciones').on('change', function() {
            var valor = $('#opciones option:selected').val();
            switch (valor) {
                case "0":
                    $("#anno").hide();
                    $("#mes").hide();
                    $("#semana").hide();
                    break;
                case "1":
                    $("#anno").show();
                    $("#mes").hide();
                    $("#semana").hide();
                    break;
                case "2":
                    $("#anno").hide();
                    $("#mes").show();
                    $("#semana").hide();
                    break;
                case "3":
                    $("#anno").hide();
                    $("#mes").hide();
                    $("#semana").show();
                    break;
            }
        });

        $('#gen').on('click', function() {

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