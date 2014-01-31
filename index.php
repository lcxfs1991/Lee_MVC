<?php

// session_save_path(realpath(dirname($_SERVER['DOCUMENT_ROOT']).'/../tmp'));
session_start();
// echo dirname($_SERVER['DOCUMENT_ROOT']).'/../tmp';
require_once(__DIR__."/application/config/Config.php");
require_once(__DIR__."/application/config/Constants.php");
require_once($Config["system"]["route"]["core"]."Loader.php");
Loader::loading($Config);
// register_shutdown_function(array("Loader","fatal_error"));
// set_error_handler(array("Loader","custom_error"));

?>