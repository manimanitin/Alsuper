<?php
/*Controlador proveedores */
class Proveedores extends Controller
{
    public function __construct()
    {
        $this->proveedorModel = $this->model('Proveedor');
    }/*
    sin paginar
    public function index()
    {
        $proveedores = $this->proveedorModel->listarProveedores();
        $this->view('/proveedores/index', $proveedores);
    }*/
    public function index($limite = 10, $pagina = 1)
    {
        $proveedores = $this->proveedorModel->listarProveedoresP($limite, $pagina);
        $this->view('/proveedores/index', $proveedores);
    }

    public function agregar()
    {
        $data = [
            'prov_nombre' => '',
            'prov_direccion' => '',
            'prov_cp' => ''

        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            # $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING,);
            $data = [

                'prov_nombre' => $_POST['prov_nombre'],
                'prov_direccion' => $_POST['prov_direccion'],
                'prov_cp' => $_POST['prov_cp']
            ];

            if ($this->proveedorModel->agregar($data)) {
                redirigir("/proveedores/index");
            } else {
                $data['msg_error'] = 'algo salio mal';
            }
        }
        $this->view('proveedores/agregar', $data);
    }

    public function editar($id)
    {
        $data = [
            'id' => $id,
            'prov_nombre' => '',
            'prov_direccion' => '',
            'prov_cp' => '',
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            # $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING,);
            var_dump($data);
            $data = [
                'id' => $id,
                'prov_nombre' => $_POST['prov_nombre'],
                'prov_direccion' => $_POST['prov_direccion'],
                'prov_cp' => $_POST['prov_cp']
            ];

            if ($this->proveedorModel->editar($data)) {

                redirigir("/proveedores/index");
            } else {
                $data['msg_error'] = 'algo salio mal';
            }
        }
        $data = $this->proveedorModel->buscarProveedorPorId($id);
        $this->view('proveedores/editar', $data);
    }

    public function eliminar($id)
    {
        $data = [
            'id' => $id
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            # $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING,);
            $data = [
                'id' => $id,
            ];

            if ($this->proveedorModel->eliminar($data)) {
                redirigir("/proveedores/index");
            } else {
                $data['msg_error'] = 'algo salio mal';
            }
        }

        $data = $this->proveedorModel->buscarProveedorPorId($id);
        $this->view('proveedores/index');
    }

    public function csv()
    {
        $proveedores = $this->proveedorModel->listarProveedores();
        $this->view('proveedores/csv', $proveedores);
    }

    public function json()
    {
        $proveedores = $this->proveedorModel->listarProveedores();
        $this->view('proveedores/json', $proveedores);
    }

    public function pdf()
    {
        $proveedores = $this->proveedorModel->listarProveedores();
        $this->view('proveedores/pdf', $proveedores);
    }
}
