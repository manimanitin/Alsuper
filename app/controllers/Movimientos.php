<?php
/*Controlador movimientos */
class Movimientos extends Controller
{
    public function __construct()
    {
        $this->movimientoModel = $this->model('Movimiento');
        $this->productoModel = $this->model('Producto');
    }
    public function index($limite = 10, $pagina = 1)
    {
        $movimientos = $this->movimientoModel->listarMovimientosP($limite, $pagina);
        $this->view('/movimientos/index', $movimientos);
    }


    public function agregar()
    {
        //$prod = $this->productoModel->listarProductos();

        $data = [
            'producto_id' => '',
            'mov_cantidad' => '',
            'mov_fecha' => '',
            'prod' => $this->productoModel->listarProductos()
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            # $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING,);

            $data = [
                'producto_id' => $_POST['producto-id'],
                'mov_cantidad' => $_POST['mov-cantidad'],
                'mov_fecha' => $_POST['mov-fecha'],
                'prod' => $this->productoModel->listarProductos()

            ];

            $stock=($this->movimientoModel->verificarStock($data['producto_id']))->producto_stock;
            // print_r($data['mov_cantidad']);
            // print_r($stock);

            if ($stock >= $data['mov_cantidad']) {
                if (empty($data['msg_error'])) {
                    $this->movimientoModel->actualizarStock($data);
                    if ($this->movimientoModel->agregar($data)) {
                        redirigir("/movimientos/index");
                    } else {
                        $data['msg_error'] = 'algo salio mal';
                    }
                }
            } else {
                $data['msg_error'] = 'Pedido supera el stock disponible';
            }
        }
        $this->view('movimientos/agregar', $data);
    }




    public function eliminar($id)
    {
        $data = [
            'id' => $id
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            # $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING,);
            $data = [
                'id' => $id
            ];
            if ($this->movimientoModel->eliminar($data)) {
                redirigir("/movimientos/index");
            } else {
                $data['msg_error'] = 'algo salio mal';
            }
        }

        $data = $this->movimientoModel->buscarMovimientoPorId($id);
        $this->view('movimientos/index');
    }

    public function editar($id)
    {
        $prod = [
            'prod' => $this->productoModel->listarProductos()
        ];
        $data = [
            'id' => $id,
            'producto_id' => '',
            'mov_cantidad' => '',
            'mov_fecha' => ''
            //'prod' => $prod
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            # $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING,);
            //$movimiento_foto = ($_FILES['movimiento-foto']['size'] == 0) ? '' : file_get_contents($_FILES['movimiento-foto']['tmp_name']);

            $data = [
                'id' => $id,
                //'movimiento_id' => $_POST['movimiento-id'],
                'producto_id' => $_POST['producto-id'],
                'mov_cantidad' => $_POST['mov-cantidad'],
                'mov_fecha' => $_POST['mov-fecha']
            ];

            if (!($data['msg_error'] = '')) {
                if ($this->movimientoModel->editar($data)) {
                    redirigir("/movimientos/index");
                } else {
                    $data['msg_error'] = 'algo salio mal';
                }
            }
        }
        $data = $this->movimientoModel->buscarMovimientoPorId($id);
        $data = (object) array_merge((array) $data, (array) $prod);
        $this->view('movimientos/editar', $data);
    }
}
