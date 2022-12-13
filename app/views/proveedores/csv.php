<?php

/**
 * fopen(), fwrite(), fclose()
 */

#encabezado de archivo
header('Content-Type:application/csv');
header('Content-Disposition: attachment; filename=clientes.csv');
#encabezado de datos
echo $csv = "ID,R.F.C,Nombre,Direccion,Telefono,Correo,C.P\n";

foreach ($data as $registro) {
    echo $registro->id . "," .
        $registro->cliente_rfc . "," .
        $registro->cliente_nombre . '",' .
        $registro->cliente_direccion . '",' .
        $registro->cliente_telefono . "," .
        $registro->cliente_correo . "," .
        $registro->cliente_cp . "\n";
}

file_put_contents(APPROOT . '/files/clientes_' . time() . '.csv', $csv);
