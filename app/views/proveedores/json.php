<?php
include_once APPROOT . '/views/includes/header.inc.php';

/**
 * generacion de vista de datos JSON
 */

#dos formas
/**
 * 1 utilizando header
 * 2 la vista clasica de header
 */


// header('Content-Type: application;');
// header('Content-Disposition: attachment; filename=clientes.json');

file_put_contents(APPROOT . '/files/clientes_' . time() . '.json', json_encode($data));
?>
<div class="alert alert-info">
    ARCHIVO JSON CREADO
</div>

<?php
include_once APPROOT . '/views/includes/footer.inc.php';
?>