<?php
header('Content-Type:application/json');
header('Content-Disposition:attachment;filename=clientes.json');


echo json_encode($data);

file_put_contents(APPROOT . '/files/clientes_' . time() . '.json', json_encode($data));
