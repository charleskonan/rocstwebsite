<?php

//print_r($_SERVER);

define('WEBROOT', dirname(__FILE__));
define('ROOT', dirname(WEBROOT));
define('DS', DIRECTORY_SEPARATOR);
define('CORE', ROOT.DS.'core');
define('BASE_URL',dirname(dirname($_SERVER['SCRIPT_NAME'])));
define('TIME_ZONE', 'Africa/Abidjan');

//NEW CONSTANTES 
define('rocstinteractive', 'http://'.$_SERVER['HTTP_HOST'].'/rocst/');

/*define('CDNLINK', 'http://'.$_SERVER['HTTP_HOST'].'/CDN_BOM/');
define('CDN','C:'.DS.'xampp'.DS.'htdocs'.DS.'CDN_BOM'.DS);*/

require CORE.DS.'include.php';

new dispatcher();





?>

 
