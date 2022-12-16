<?php
/*Controlador usuarios */
class Usuarios extends Controller
{
    public function __construct()
    {
        $this->usuarioModel = $this->model('Usuario');
    }
    public function index($limite = 10, $pagina = 1)
    {
        $usuarios = $this->usuarioModel->listarUsuariosP($limite, $pagina);
        $this->view('/usuarios/index', $usuarios);
    }


    public function agregar()
    {
        $data = [
            'usuario_id' => '',
            'usuario_username' => '',
            'usuario_password' => '',
            'usuario_nombreCompleto' => '',
            'usuario_nivel' => '',
            'msg_error' => ''
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            # $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING,);
            $data = [
                'usuario_id' => $_POST['usuario-id'],
                'usuario_username' => $_POST['usuario-username'],
                'usuario_password' => $_POST['usuario-password'],
                'usuario_nombreCompleto' => $_POST['usuario-nombreCompleto'],
                'usuario_nivel' => $_POST['usuario-nivel'],
                'usuario_confirmacion' => $_POST['usuario-confirmacion']


            ];
            //se puede hacer doble validacion
            if (empty($data['usuario_id']) || empty($data['usuario_username']) || empty($data['usuario_password']) || empty($data['usuario_nombreCompleto'])  || empty($data['usuario_confirmacion'])) {
                $data['msg_error'] = 'llene todos los campos';
            }

            if ($data['usuario_password'] != $data['usuario_confirmacion']) {
                $data['msg_error'] = 'no coincide password';
            }
            if ($this->usuarioModel->buscarUsuarioPorCorreoUsuarioID($data['usuario_id'], $data['usuario_username'])) {
                $data['msg_error'] = 'usuario id o nombre de usuario ya existe';
            }
            if (empty($data['msg_error'])) {
                $data['usuario_password'] = password_hash($data['usuario_password'], PASSWORD_DEFAULT);
                if ($this->usuarioModel->agregar($data)) {
                    redirigir("/usuarios/index");
                } else {
                    $data['msg_error'] = 'algo salio mal';
                }
            }
        }
        $this->view('usuarios/agregar', $data);
    }

    public function login()
    {
        //comprobar de onde sale la llamada de menu o del forumu
        $data = [
            'usuario_id' => '',
            'usuario_username' => '',
            'usuario_password' => '',
            'usuario_nombreCompleto' => '',
            'usuario_nivel' => '',
            'msg_error' => ''
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            # $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING,);
            $data = [
                'usuario_username' => $_POST['usuario-username'],
                'usuario_password' => $_POST['usuario-password']


            ];
            //sepuede aser doble validation

            //bbuscar usuario en base de datos
            $logging = $this->usuarioModel->login($data['usuario_username'], $data['usuario_password']);
            //print_r($logging);
            if ($logging) {
                //todo
                //trabajar con sesiones $_SESSION
                $this->crearSesionUsuario($logging);
                // echo print_r($data);
            } else {
                $data['msg_error'] = 'Correo/password incorrecto';
                //echo print_r($data['msg_error']);
                $this->view('usuarios/login', $data);
            }
        } else {
            //            echo 'get';
            $this->view('usuarios/home');
        }
    }
    public function crearSesionUsuario($usuario)
    {
        //la funcion session star inicializa server
        //pero debe usarse al ninicio del codigo, facilita helper
        $_SESSION['usuario_id'] = $usuario->usuario_id;
        $_SESSION['usuario_username'] = $usuario->usuario_username;
        $_SESSION['usuario_nombreCompleto'] = $usuario->usuario_nombreCompleto;
        $_SESSION['usuario_nivel'] = $usuario->usuario_nivel;

        redirigir('/');
    }
    public function logout()
    {
        unset($_SESSION['usuario_id']);
        unset($_SESSION['usuario_username']);
        unset($_SESSION['usuario_nombreCompleto']);
        redirigir('/');
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
            if ($this->usuarioModel->eliminar($data)) {
                redirigir("/usuarios/index");
            } else {
                $data['msg_error'] = 'algo salio mal';
            }
        }

        $data = $this->usuarioModel->buscarUsuarioPorId($id);
        $this->view('usuarios/index');
    }

    public function editar($id)
    {
        $data = [
            'id' => $id,
            'usuario_id' => '',
            'usuario_username' => '',
            'usuario_password' => '',
            'usuario_nombreCompleto' => '',
            'usuario_nivel' => '',
            'msg_error' => ''
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            # $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING,); prueba
            $data = [
                'id' => $id,
                //'usuario_id' => $_POST['usuario-id'],
                'usuario_username' => $_POST['usuario-username'],
                'usuario_password' => $_POST['usuario-password'],
                'usuario_nombreCompleto' => $_POST['usuario-nombreCompleto'],
                'usuario_nivel' => $_POST['usuario-nivel'],
                'usuario_confirmacion' => $_POST['usuario-confirmacion']
            ];



            if ($data['usuario_password'] != $data['usuario_confirmacion']) {
                $data['msg_error'] = 'no coincide password';
            }

            $data['usuario_password'] = password_hash($data['usuario_password'], PASSWORD_DEFAULT);
            if (!($data['msg_error'] = '')) {
                if ($this->usuarioModel->editar($data)) {
                    redirigir("/usuarios/index");
                } else {
                    $data['msg_error'] = 'algo salio mal';
                }
            }
        }
        $data = $this->usuarioModel->buscarUsuarioPorId($id);
        $this->view('usuarios/editar', $data);
    }
}
