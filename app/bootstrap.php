<?php
// Load config
require_once 'config/config.php';

//load url_helper
require_once 'helpers/url_helper.php';
//Load session_helper
require_once 'helpers/session_helper.php';

// Autoload Core libraries
spl_autoload_register(function($className){
	require_once 'libraries/' . $className .'.php';	
});