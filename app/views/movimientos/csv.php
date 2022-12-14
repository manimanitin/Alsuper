<?php

/**
 * fopen(), fwrite(), fclose()
 */

#encabezado de archivo
header('Content-Type:application/csv');
header('Content-Disposition:attachment;filename=movimientos.csv');
#encabezado de datos
echo $csv = "id, id del producto, cantidad, fecha\n";

foreach ($data as $registro) {
    echo $csv .= $registro->id . ',' .
        $registro->producto_id . ',' .
        $registro->mov_cantidad . ',' .
        $registro->mov_fecha . "\n";
}

file_put_contents(APPROOT . '/files/movimientos_' . time() . '.csv', $csv);
