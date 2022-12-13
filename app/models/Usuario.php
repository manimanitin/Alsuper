<?php


class Usuario
{
    private $db;
    public function __construct()
    {
        $this->db = new Base;
    }
    /**
     * 
     */
    public function login($username, $password)
    {
        //query
        $this->db->query('SELECT id,usuario_id,usuario_username,usuario_password,usuario_nombreCompleto,usuario_nivel FROM usuarios WHERE usuario_username=:usuario_username');
        $this->db->bind(':usuario_username', $username);

        $registro = $this->db->unico();

        if ($this->db->conteoReg() > 0) {
            $hashedPassword = $registro->usuario_password;
            if (password_verify($password, $hashedPassword)) {
                return $registro;
            }
        }
        return false;
    }
    public function buscarUsuarioPorCorreoUsuarioID($usuario_id, $usuario_username)
    {
        $this->db->query('SELECT 
        usuario_id,usuario_username
        from usuarios where usuario_username=:usuario_username or usuario_id=:usuario_id');
        $this->db->bind(':usuario_username', $usuario_username);
        $this->db->bind(':usuario_id', $usuario_id);


        $registro = $this->db->unico();

        return ($this->db->conteoReg()) ? true : false;
    }
    public function agregar($data)
    {
        $this->db->query('INSERT INTO usuarios (usuario_id,usuario_username,usuario_password,usuario_nombreCompleto,usuario_nivel)
        values (:usuario_id,:usuario_username,:usuario_password,:usuario_nombreCompleto,:usuario_nivel)');
        $this->db->bind(':usuario_id', $data['usuario_id']);
        $this->db->bind(':usuario_username', $data['usuario_username']);
        $this->db->bind(':usuario_password', $data['usuario_password']);
        $this->db->bind(':usuario_nombreCompleto', $data['usuario_nombreCompleto']);
        $this->db->bind(':usuario_nivel', $data['usuario_nivel']);



        #  return ($this->db->execute()) ? true : false;
        try {
            $this->db->execute();
            return true;
        } catch (Exception $evt) {
            return false;
        }
    }

    public function listarUsuarios()
    {
        $registro = $this->db->query('SELECT id,usuario_id,usuario_username,usuario_nombreCompleto,usuario_nivel from usuarios');
        $registro = $this->db->multiple();
        return ($registro);
    }
    public function listarUsuariosP($limite, $pagina)
    {
        $limite = intval($limite);

        $offset = ($pagina - 1) * $limite;
        $this->db->query('SELECT COUNT(id) as total from usuarios');
        $registros = $this->db->unico();
        $paginas = ceil($registros->total / $limite);
        $paginacion = [
            'paginas' => $paginas,
            'pagina' => $pagina,
            'limite' => $limite,
            'registros' => $registros->total,
            'previa' => $pagina - 1,
            'siguiente' =>
            $pagina + 1,


        ];

        $registro = $this->db->query('SELECT id,usuario_id,usuario_username,usuario_password,usuario_nombreCompleto,usuario_nivel from Usuarios limit :offset, :limite');
        $this->db->bind(':limite', $limite);
        $this->db->bind(':offset', $offset);

        $data['usuarios'] = $this->db->multiple();
        $data = array_merge($paginacion, $data);
        return ($data);
    }

    public function eliminar($data)
    {
        $this->db->query('DELETE FROM usuarios WHERE id=:id');
        $this->db->bind(':id', $data['id']);
        try {
            $this->db->execute();
            return true;
        } catch (Exception $evt) {
            print_r($this->db);
            return false;
        }
    }

    public function editar($data)
    {
        $this->db->query('UPDATE usuarios set usuario_username=:usuario_username, usuario_password=:usuario_password, usuario_nombreCompleto=:usuario_nombreCompleto, usuario_nivel=:usuario_nivel where id=:id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':usuario_username', $data['usuario_username']);
        $this->db->bind(':usuario_password', $data['usuario_password']);
        $this->db->bind(':usuario_nombreCompleto', $data['usuario_nombreCompleto']);
        $this->db->bind(':usuario_nivel', $data['usuario_nivel']);


        // echo '<pre>';
        // print_r($data);
        // echo '<pre>';



        try {
            $this->db->execute();
            return true;
        } catch (Exception $evt) {
            echo '<pre>';
            print_r($evt);
            echo '<pre>';
            return false;
        }
    }

    public function buscarUsuarioPorId($id)
    {
        $this->db->query('SELECT id,usuario_id,usuario_username,usuario_password,usuario_nombreCompleto,usuario_nivel from usuarios where id = :id');
        $this->db->bind(':id', $id);
        #  return ($this->db->execute()) ? true : false;
        return $this->db->unico();
    }

    // public function buscarUsuarioPorIdoUsuario($id,$user)
    // {
    //     $this->db->query('SELECT id,usuario_id,usuario_username,usuario_password,usuario_nombreCompleto,usuario_nivel from usuarios where id = :id or usuario_username=:usuario_username');
    //     $this->db->bind(':id', $id);
    //     $this->db->bind(':usuario_username', $user);

    //     #  return ($this->db->execute()) ? true : false;
    //     return $this->db->unico();
    // }
}
