<?php
/* 
identificacion, mapeo
*/


class Ruta
{
    /*
    propiedades son los argumentos
    metodos son funciones
    publicas privadas estaticas protegidas
    
    */
    #controlador default
    protected $controladorActual = 'Home';
    #metodo defaultx|
    protected $metodoActual = 'index';
    #parametros, arreglo vacio
    protected $parametros = [];
    public function __construct()
    {
        $url = $this->getUrl();
        if ($url) {
            if (file_exists(APPROOT . '/controllers/' . ucwords($url[0]) . '.php')) {
                $this->controladorActual = ucwords($url[0]);
            }
            unset($url[0]);
        }
        include_once APPROOT . '/controllers/' . $this->controladorActual . '.php';
        $this->controladorActual = new $this->controladorActual;
        //comprbar si hay metodo
        if (isset($url[1])) {

            if (method_exists($this->controladorActual, $url[1])) {
                $this->metodoActual = $url[1];
            }
            unset($url[1]);
        }
        #tercera parte, los parametros
        $this->parametros = ($url) ? array_values($url) : [];
        call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);








        //var_dump($url);
        /*echo '<pre>';
        var_dump($_SERVER);
        echo '</pre>';*/
    }
    /*
lectura en url1
@url en arreglo
    */

    public function getUrl()
    {
        #url se creo en .htaccess
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            //decsomponer la cadena en arreglo 
            $url = explode('/', $url);
            return $url;
            // return $_GET['url'];
        }
    }
}
