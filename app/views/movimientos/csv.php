<?php

/**
 * fopen(), fwrite(), fclose()
 */

#encabezado de archivo

header('Content-Type:application/csv');
header('Content-Disposition:attachment;filename=movimientos.csv');
#encabezado de datos

$csv = "id, producto_id, cantidad, fecha\n";

foreach ($data as $registro) {

    $csv .= $registro->id . ',' .
        $registro->producto_id . ',' .
        $registro->mov_cantidad . ',' .
        $registro->mov_fecha . "\n";
}
echo $csv;

file_put_contents(APPROOT . '/files/movimientos_' . time() . '.csv', $csv);
