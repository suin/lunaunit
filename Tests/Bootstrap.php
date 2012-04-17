<?php

set_include_path(get_include_path() . PATH_SEPARATOR . dirname(dirname(__FILE__)).'/Source');

function load_class($c) {
	@include_once strtr($c, '_', '/').'.php';
}

spl_autoload_register('load_class');