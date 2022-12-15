<?php
header('Content-Type:application/json');
header('Content-Disposition:attachment;filename=productos.json');


echo json_encode($data);

file_put_contents(APPROOT . '/files/productos_' . time() . '.json', json_encode($data));
