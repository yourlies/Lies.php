<?php
define('ROOT_PATH', dirname(__FILE__));
define('COMPONENT_PATH', dirname(__FILE__) . '/t');
define('CACHES_PATH', dirname(__FILE__) . '/caches');
define('ASSETS_PATH', '//' . $_SERVER['HTTP_HOST'] . '/a');
define('VERSION_ID', 1.003);
define('DEVELOP_MODE', true);

require(ROOT_PATH . '/route.php');