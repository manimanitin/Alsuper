<?php

class Servicios extends Controller
{
    /**
     * metodos:
     * index --->cliente
     * server--->servidor
     */

    public function __construct()
    {
        $this->clienteModel = $this->model('Cliente');
    }

    /**
     * index
     * @param $id para buscar cliente
     */
    public function index($id = 0)
    {
        $cliente = new nusoap_client(URLROOT . '/servicios/server');
        #hacer uso del metodo funcion que provee el servidor
        $resultado = $cliente->call("Cliente.consultaClienteSOAP", ['id' => $id]);
        //optar por mostrar en JSON
        header('Content-type: application/json');
        echo json_encode($resultado);
    }

    public function server()
    {
        #crear la instancia
        $server = new nusoap_server();
        $serverName = 'Consulta de Datos de Cliente';
        $serverNamespace = URLROOT . '/servicios/server';
        //configurar WSDL
        $server->configureWSDL($serverName, $serverNamespace);
        //definir datos a recibir y datos a enviar
        $server->wsdl->addComplexType(
            'DatosCliente', //Nombre del dato
            'complexType',
            'struct',
            'all',
            '',
            [
                'cliente_nombre' => ['name' => 'cliente_nombre', 'type' => 'xsd:string'],
                'cliente_rfc' => ['name' => 'cliente_rfc', 'type' => 'xsd:string']
            ]
        );
        $server->register(
            'Cliente.consultaClienteSOAP', //metodo
            ['id' => 'xsd:int'], //entrada
            ['return' => 'DatosCliente'], //salida
            'urn:' . $serverNamespace,
            'urn:' . $serverNamespace . '#consultaCliente', //alias namespace
            'rpc', //style
            'encoded',
            'Documentacion...'

        );

        #invocar el servicio
        @$server->service(file_get_contents('php://input'));
    }
}
