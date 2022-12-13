<?php
session_start();
//
function redirigir($locacion)
{
    header('Location: ' . URLROOT . $locacion);
}


/**
 * para modificar encabezado
 */




function estaLogueado()
{
    return (isset($_SESSION['usuario_id']) && !empty($_SESSION['usuario_id'])) ? true : false;
}
