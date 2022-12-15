<?php


class Producto
{
    private $db;
    public function __construct()
    {
        $this->db = new Base;
    }
    /**
     * 
     */

    public function buscarProductoPorCorreoProductoID($producto_id, $producto_username)
    {
        $this->db->query('SELECT 
        producto_id,producto_username
        from productos where producto_username=:producto_username or producto_id=:producto_id');
        $this->db->bind(':producto_username', $producto_username);
        $this->db->bind(':producto_id', $producto_id);


        $registro = $this->db->unico();

        return ($this->db->conteoReg()) ? true : false;
    }
    public function agregar($data)
    {

        $this->db->query('INSERT INTO productos (producto_nombre, producto_stock, producto_precio, producto_fecha, proveedor_id, producto_foto) VALUES(:producto_nombre, :producto_stock, :producto_precio, :producto_fecha, :proveedor_id, :producto_foto)');
        $this->db->bind(':producto_nombre', $data['producto_nombre']);
        $this->db->bind(':producto_stock', $data['producto_stock']);
        $this->db->bind(':producto_precio', $data['producto_precio']);
        $this->db->bind(':producto_fecha', $data['producto_fecha']);
        $this->db->bind(':proveedor_id', $data['proveedor_id']);
        $this->db->bind(':producto_foto', $data['producto_foto']);

        #  return ($this->db->execute()) ? true : false;
        try {
            $this->db->execute();
            return true;
        } catch (Exception $evt) {
            print_r($evt);
            return false;
        }
    }

    public function listarProductos()
    {
        // $registro = $this->db->query('SELECT id, producto_nombre, producto_stock, producto_precio, producto_fecha, proveedor_id, producto_foto FROM productos');
        $registro = $this->db->query('SELECT
        prod.id,
        prod.producto_nombre,
        prod.producto_stock,
        prod.producto_precio,
        prod.producto_fecha,
        prod.proveedor_id,
        prov.prov_nombre,
        prod.producto_foto
    FROM
        productos AS prod,
        proveedores AS prov
        WHERE prod.proveedor_id=prov.id');
        $registro = $this->db->multiple();
        return ($registro);
    }
    public function listarProductosP($limite, $pagina)
    {
        $limite = intval($limite);

        $offset = ($pagina - 1) * $limite;
        $this->db->query('SELECT COUNT(id) as total from productos');
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

        // $registro = $this->db->query('SELECT id, producto_nombre, producto_stock, producto_precio, producto_fecha, proveedor_id, producto_foto FROM productos limit :offset, :limite');
        $registro = $this->db->query('SELECT
        prod.id,
        prod.producto_nombre,
        prod.producto_stock,
        prod.producto_precio,
        prod.producto_fecha,
        prod.proveedor_id,
        prov.prov_nombre,
        prod.producto_foto
    FROM
        productos AS prod,
        proveedores AS prov
        WHERE prod.proveedor_id=prov.id order by prod.id limit :offset, :limite ');
        $this->db->bind(':limite', $limite);
        $this->db->bind(':offset', $offset);

        $data['productos'] = $this->db->multiple();
        $data = array_merge($paginacion, $data);
        return ($data);
    }

    public function eliminar($data)
    {
        $this->db->query('DELETE FROM productos WHERE id=:id');
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


        if ($data['producto_foto'] != '') {
            $this->db->query('UPDATE productos set producto_nombre=:producto_nombre, producto_stock=:producto_stock, producto_precio=:producto_precio, producto_fecha=:producto_fecha, proveedor_id=:proveedor_id, producto_foto=:producto_foto where id=:id');
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':producto_nombre', $data['producto_nombre']);
            $this->db->bind(':producto_stock', $data['producto_stock']);
            $this->db->bind(':producto_precio', $data['producto_precio']);
            $this->db->bind(':producto_fecha', $data['producto_fecha']);
            $this->db->bind(':proveedor_id', $data['proveedor_id']);
            $this->db->bind(':producto_foto', $data['producto_foto']);
        } else {
            $this->db->query('UPDATE productos set producto_nombre=:producto_nombre, producto_stock=:producto_stock, producto_precio=:producto_precio, producto_fecha=:producto_fecha, proveedor_id=:proveedor_id where id=:id');
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':producto_nombre', $data['producto_nombre']);
            $this->db->bind(':producto_stock', $data['producto_stock']);
            $this->db->bind(':producto_precio', $data['producto_precio']);
            $this->db->bind(':producto_fecha', $data['producto_fecha']);
            $this->db->bind(':proveedor_id', $data['proveedor_id']);
        }


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

    public function buscarProductoPorId($id)
    {
        $this->db->query('SELECT id, producto_nombre, producto_stock, producto_precio, producto_fecha, proveedor_id, producto_foto from productos where id = :id');
        $this->db->bind(':id', $id);
        #  return ($this->db->execute()) ? true : false;
        return $this->db->unico();
    }

    // public function buscarProductoPorIdoProducto($id,$user)
    // {
    //     $this->db->query('SELECT id,producto_id,producto_username,producto_password,producto_nombreCompleto,producto_nivel from productos where id = :id or producto_username=:producto_username');
    //     $this->db->bind(':id', $id);
    //     $this->db->bind(':producto_username', $user);

    //     #  return ($this->db->execute()) ? true : false;
    //     return $this->db->unico();
    // }
}
