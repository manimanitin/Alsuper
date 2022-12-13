<?php


class Proveedor
{
    private $db;
    public function __construct()
    {
        $this->db = new Base;
    }
    /**
     * 
     */
    public function listarProveedores()
    {
        $registro = $this->db->query('SELECT id,prov_nombre,prov_direccion,prov_cp from proveedores');
        $registro = $this->db->multiple();
        return ($registro);
    }
    public function listarProveedoresP($limite, $pagina)
    {
        $limite = intval($limite);

        $offset = ($pagina - 1) * $limite;
        $this->db->query('SELECT COUNT(id) as total from proveedores');
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

        $registro = $this->db->query('SELECT id,prov_nombre,prov_direccion,prov_cp from proveedores limit :offset, :limite');
        $this->db->bind(':limite', $limite);
        $this->db->bind(':offset', $offset);

        $data['proveedores'] = $this->db->multiple();
        $data = array_merge($paginacion, $data);
        return ($data);
    }
    public function agregar($data)
    {
        
        $this->db->query('INSERT INTO proveedores(prov_nombre,prov_direccion,prov_cp) VALUES (:prov_nombre,:prov_direccion,:prov_cp)');
        $this->db->bind(':prov_nombre', $data['prov_nombre']);
        $this->db->bind(':prov_direccion', $data['prov_direccion']);
        $this->db->bind(':prov_cp', $data['prov_cp']);




        #  return ($this->db->execute()) ? true : false;
        try {
            $this->db->execute();
            return true;
        } catch (Exception $evt) {
            return false;
        }
    }
    public function buscarProveedorPorId($id)
    {
        $this->db->query('SELECT id,prov_nombre,prov_direccion,prov_cp from proveedores where id = :id');
        $this->db->bind(':id', $id);
        #  return ($this->db->execute()) ? true : false;
        return $this->db->unico();
    }
    public function editar($data)
    {
        $this->db->query('UPDATE proveedores SET prov_nombre=:prov_nombre,prov_direccion=:prov_direccion,prov_cp=:prov_cp WHERE id=:id');
        $this->db->bind(':prov_nombre', $data['prov_nombre']);
        $this->db->bind(':prov_direccion', $data['prov_direccion']);
        $this->db->bind(':prov_cp', $data['prov_cp']);
        $this->db->bind(':id', $data['id']);


        try {
            $this->db->execute();
            return true;
        } catch (Exception $evt) {
            return false;
        }
    }

    public function eliminar($data)
    {
        $this->db->query('DELETE FROM proveedores WHERE id=:id');
        $this->db->bind(':id', $data['id']);
        try {
            $this->db->execute();
            return true;
        } catch (Exception $evt) {
            print_r($this->db);
            return false;
        }
    }

    /**
     * ayuda para servicios web
     */

    public function consultaProveedorSOAP($id)
    {
        $this->db->query('SELECT id,prov_nombre,prov_cp from proveedores where id = :id');
        $this->db->bind(':id', $id);

        $data = $this->db->unico();
        return [
            'prov_id' => $data->prov_id,
            'prov_nombre' => $data->prov_nombre,
            'prov_cp' => $data->prov_cp

        ];
    }

    
}
