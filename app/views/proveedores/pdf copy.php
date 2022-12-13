<?php

/**
 * DOMPDF herramienta para convertir html a pdf
 * Ejemplo simple
 */

#crear cadena de datos
$html =  '<head><link href="' . URLROOT . '/css/bs/css/bootstrap.min.css" rel="stylesheet"></head>';
$html = '<table class="table table-bordered table hover">
<tbody>
    <th>ID</th>
    <th>RFC</th>
    <th>Nombre</th>
    <th>Direccion</th>
    <th>Telefono</th>
    <th>Correo</th>
    <th>CP</th>
    <th>FOTO</th>';

foreach ($data as $registro) {
    $html .=
        '<tr>
            <td>' . $registro->id . '</td>
            <td>' . $registro->cliente_rfc . ' </td>
            <td>' . $registro->cliente_nombre . '</td>
            <td>' . $registro->cliente_direccion . '</td>
            <td>' . $registro->cliente_telefono . '</td>
            <td>' . $registro->cliente_correo . '</td>
            <td>' . $registro->cliente_cp . '</td>
        </tr>';
}
$html .= '</tbody></table>';
#conversion

use Dompdf\Dompdf;

#crear instancia de libreria

$pdf = new Dompdf();


#usar la instancia
//cargar el html
$pdf->loadHtml($html);
//2 renderizar
$pdf->render();
$pdf->stream('clientes.pdf');
