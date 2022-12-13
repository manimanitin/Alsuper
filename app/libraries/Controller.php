<?php

class Controller
{
    /**no hago us de __construct 
     * view - para mostrar html */

    public function __construct()
    {
    }

    /**view es el nombre del archivo
     * @data es opcional y es un arreglo
     * @return interfaz
     */
    public function view($view, $data = [])
    {

        if (file_exists(APPROOT . '/views/' . $view . '.php')) {
            include_once APPROOT . '/views/' . $view . '.php';
        } #fin de if file esis
        else {
            die('vista no existe');
        }
    }
    #metodo modelo
    #@model
    #@retunr instancia de modelo
    public function model($model)
    {
        if (file_exists(APPROOT . '/models/' . $model . '.php')) {
            # code...
            include_once APPROOT . '/models/' . $model . '.php';
            return new $model;
        }
    }
}
