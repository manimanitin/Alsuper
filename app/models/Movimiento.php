<?php


class Movimiento
{
    private $db;
    public function __construct()
    {
        $this->db = new Base;
    }
    /**
     * 
     */




    public function reporteMensual($data)
    {
        $registro = $this->db->query('SELECT id, producto_id,mov_cantidad,mov_fecha FROM movimientos WHERE YEAR(mov_fecha)=:anno AND MONTH(mov_fecha)=:mes');
        $this->db->bind(':anno', $data['year']);
        $this->db->bind(':mes', $data['month']);
        $registro = $this->db->multiple();
        return ($registro);
    }

    public function reporteAnual($data)
    {
        $registro = $this->db->query('SELECT id, producto_id,mov_cantidad,mov_fecha FROM movimientos WHERE YEAR(mov_fecha)=:anno');
        $this->db->bind(':anno', $data['year']);

        $registro = $this->db->multiple();
        return ($registro);
    }

    public function reporteSemanal($data)
    {
        $registro = $this->db->query('SELECT id, producto_id,mov_cantidad,mov_fecha FROM movimientos WHERE DATE(mov_fecha) BETWEEN :primer AND :segun');
        $this->db->bind('primer', $data['primera']);
        $this->db->bind('segun', $data['segunda']);
        $registro = $this->db->multiple();
        return ($registro);
    }





    public function agregar($data)
    {

        $this->db->query('INSERT INTO movimientos (producto_id,mov_cantidad,mov_fecha) VALUES(:producto_id,:mov_cantidad,:mov_fecha)');
        $this->db->bind(':producto_id', $data['producto_id']);
        $this->db->bind(':mov_cantidad', $data['mov_cantidad']);
        $this->db->bind(':mov_fecha', $data['mov_fecha']);

        #  return ($this->db->execute()) ? true : false;
        try {
            $this->db->execute();
            return true;
        } catch (Exception $evt) {
            print_r($evt);
            return false;
        }
    }

    public function listarMovimientos()
    {
        $registro = $this->db->query('SELECT id, producto_id,mov_cantidad,mov_fecha FROM movimientos');
        $registro = $this->db->multiple();
        return ($registro);
    }

    public function listarMovimientosP($limite, $pagina)
    {
        $limite = intval($limite);

        $offset = ($pagina - 1) * $limite;
        $this->db->query('SELECT COUNT(id) as total from movimientos');
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

        $registro = $this->db->query('SELECT id,producto_id,mov_cantidad,mov_fecha FROM movimientos limit :offset, :limite');
        $this->db->bind(':limite', $limite);
        $this->db->bind(':offset', $offset);

        $data['movimientos'] = $this->db->multiple();
        $data = array_merge($paginacion, $data);
        return ($data);
    }

    public function eliminar($data)
    {
        $this->db->query('DELETE FROM movimientos WHERE id=:id');
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

        $this->db->query('UPDATE movimientos set producto_id=:producto_id,mov_cantidad=:mov_cantidad,mov_fecha=:mov_fecha where id=:id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':producto_id', $data['producto_id']);
        $this->db->bind(':mov_cantidad', $data['mov_cantidad']);
        $this->db->bind(':mov_fecha', $data['mov_fecha']);



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

    public function buscarMovimientoPorId($id)
    {
        $this->db->query('SELECT id,producto_id,mov_cantidad,mov_fecha from movimientos where id = :id');
        $this->db->bind(':id', $id);
        #  return ($this->db->execute()) ? true : false;
        return $this->db->unico();
    }

    public function verificarStock($prod_id)
    {
        $this->db->query('SELECT producto_stock FROM productos WHERE id=:id');
        $this->db->bind(':id', $prod_id);
        #  return ($this->db->execute()) ? true : false;
        return $this->db->unico();
    }

    public function actualizarStock($data){
        $this->db->query('UPDATE productos set producto_stock=producto_stock-:cantidad WHERE id=:id');
        $this->db->bind(':id', $data['producto_id']);
        $this->db->bind(':cantidad', $data['mov_cantidad']);
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


    // public function buscarMovimientoPorIdoMovimiento($id,$user)
    // {
    //     $this->db->query('SELECT id,mov_id,mov_username,mov_password,mov_nombreCompleto,mov_nivel from movimientos where id = :id or mov_username=:mov_username');
    //     $this->db->bind(':id', $id);
    //     $this->db->bind(':mov_username', $user);

    //     #  return ($this->db->execute()) ? true : false;
    //     return $this->db->unico();
    // }
}
