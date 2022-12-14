<?php
/*Controlador productos */
class Productos extends Controller
{
    public function __construct()
    {
        $this->productoModel = $this->model('Producto');
        $this->proveedorModel = $this->model('Proveedor');
    }
    public function index($limite = 10, $pagina = 1)
    {
        $productos = $this->productoModel->listarProductosP($limite, $pagina);
        $this->view('/productos/index', $productos);
    }


    public function mes($year, $month, $archivo = '')
    {
        $data = [
            'year' => $year,
            'month' => $month,
        ];
        switch ($archivo) {
            case "0":
                $productos = $this->productoModel->reporteMensual($data);
                array_push($productos, $year . ' ' . $month);
                $this->view('/productos/mes', $productos);
                break;
            case "1":
                $productos = $this->productoModel->reporteMensual($data);
                $this->view('/productos/csv', $productos);
                break;
            case "2":
                $productos = $this->productoModel->reporteMensualJ($data);

                $this->view('/productos/json', $productos);
                break;
            case "3":
                $productos = $this->productoModel->reporteMensual($data);
                $this->view('/productos/pdf', $productos);
                break;
            default:
                $productos = $this->productoModel->reporteMensual($data);
                array_push($productos, $year . ' ' . $month);
                $this->view('/productos/mes', $productos);
                break;
        }
    }

    public function anno($year, $archivo = '')
    {
        $data = [
            'year' => $year,
        ];

        switch ($archivo) {
            case "0":
                $productos = $this->productoModel->reporteAnual($data);
                array_push($productos, $year);
                $this->view('/productos/anno', $productos);
                break;
            case "1":
                $productos = $this->productoModel->reporteAnual($data);
                $this->view('/productos/csv', $productos);
                break;
            case "2":
                $productos = $this->productoModel->reporteAnualJ($data);
                $this->view('/productos/json', $productos);
                break;
            case "3":
                $productos = $this->productoModel->reporteAnual($data);

                $this->view('/productos/pdf', $productos);
                break;
            default:
                $productos = $this->productoModel->reporteAnual($data);
                array_push($productos, $year);
                $this->view('/productos/anno', $productos);
                break;
        }
    }
    public function semana($year, $month, $day, $archivo = '')
    {
        $fecha = new DateTime();
        $fecha->setDate($year, $month, $day);
        $fechamas = new DateTime();
        $fechamas->setDate($year, $month, $day);
        $fechamas = $fechamas->add(DateInterval::createFromDateString('1 week'));
        $data = [
            'primera' => $fecha->format("Y-m-d"),
            'segunda' => $fechamas->format("Y-m-d")
        ];

        switch ($archivo) {
            case "0":
                $productos = $this->productoModel->reporteSemanal($data);
                array_push($productos, $year . ' ' . $month . ' ' . $day);

                $this->view('/productos/semana', $productos);
                break;
            case "1":
                $productos = $this->productoModel->reporteSemanal($data);
                $this->view('/productos/csv', $productos);
                break;
            case "2":
                $productos = $this->productoModel->reporteSemanalJ($data);
                $this->view('/productos/json', $productos);
                break;
            case "3":
                $productos = $this->productoModel->reporteSemanal($data);
                $this->view('/productos/pdf', $productos);
                break;
            default:
                $productos = $this->productoModel->reporteSemanal($data);
                array_push($productos, $year . ' ' . $month . ' ' . $day);
                $this->view('/productos/semana', $productos);
                break;
        }
    }



    public function agregar()
    {
        $prov = $this->proveedorModel->listarProveedores();

        $data = [
            'producto_nombre' => '',
            'producto_stock' => '',
            'producto_precio' => '',
            'producto_fecha' => '',
            'proveedor_id' => '',
            'producto_foto' => '',
            'msg_error' => '',
            'prov' => $this->proveedorModel->listarProveedores()
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            # $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING,);
            $producto_foto = ($_FILES['producto-foto']['size'] == 0) ? '' : file_get_contents($_FILES['producto-foto']['tmp_name']);

            $data = [
                'producto_nombre' =>  $_POST['producto-nombre'],
                'producto_stock' =>  $_POST['producto-stock'],
                'producto_precio' =>  $_POST['producto-precio'],
                'producto_fecha' =>  $_POST['producto-fecha'],
                'proveedor_id' =>  $_POST['proveedor-id'],
                'producto_foto' =>  $producto_foto,

            ];
            //se puede hacer doble validacion

            if (empty($data['msg_error'])) {
                if ($this->productoModel->agregar($data)) {
                    redirigir("/productos/index");
                } else {
                    $data['msg_error'] = 'algo salio mal';
                }
            }
        }
        $this->view('productos/agregar', $data);
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
            if ($this->productoModel->eliminar($data)) {
                redirigir("/productos/index");
            } else {
                $data['msg_error'] = 'algo salio mal';
            }
        }

        $data = $this->productoModel->buscarProductoPorId($id);
        $this->view('productos/index');
    }

    public function editar($id)
    {
        $prov = [
            'prov' => $this->proveedorModel->listarProveedores()
        ];
        $data = [
            'id' => $id,
            'producto_nombre' => '',
            'producto_stock' => '',
            'producto_precio' => '',
            'producto_fecha' => '',
            'proveedor_id' => '',
            'producto_foto' => '',
            'msg_error' => '',
            //'prov' => $prov
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            # $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING,);
            $producto_foto = ($_FILES['producto-foto']['size'] == 0) ? '' : file_get_contents($_FILES['producto-foto']['tmp_name']);

            $data = [
                'id' => $id,
                //'producto_id' => $_POST['producto-id'],
                'producto_nombre' =>  $_POST['producto-nombre'],
                'producto_stock' =>  $_POST['producto-stock'],
                'producto_precio' =>  $_POST['producto-precio'],
                'producto_fecha' =>  $_POST['producto-fecha'],
                'proveedor_id' =>  $_POST['proveedor-id'],
                'producto_foto' =>  $_POST['producto-foto']
            ];

            if (!($data['msg_error'] = '')) {
                if ($this->productoModel->editar($data)) {
                    redirigir("/productos/index");
                } else {
                    $data['msg_error'] = 'algo salio mal';
                }
            }
        }
        $data = $this->productoModel->buscarProductoPorId($id);
        $data = (object) array_merge((array) $data, (array) $prov);
        $this->view('productos/editar', $data);
    }
}
