<?php

/*
autoload.inc.php
*/
include_once 'config.inc.php';
//incluir helper
include_once APPROOT . '/helpers/helpers.php';
include_once APPROOT . '/vendors/dompdf/autoload.inc.php';
include_once APPROOT . '/vendors/nusoap/src/nusoap.php';

spl_autoload_register(function ($classname) {
    include_once APPROOT . '../libraries/' . $classname . '.php';
});
