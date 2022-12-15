<?php

/**
 * fopen(), fwrite(), fclose()
 */

#encabezado de archivo

header('Content-Type:application/csv');
header('Content-Disposition:attachment;filename=productos.csv');
#encabezado de datos

$csv = "ID, Nombre, Stock, Proveedor, Precio, Fecha\n";

foreach ($data as $registro) {



    $csv .= $registro->id . ',' .
        $registro->producto_nombre . ',' .
        $registro->producto_stock . ',' .
        $registro->prov_nombre . ',' .
        $registro->producto_precio . ',' .
        $registro->producto_fecha . "\n";
}
echo $csv;

file_put_contents(APPROOT . '/files/productos_' . time() . '.csv', $csv);
