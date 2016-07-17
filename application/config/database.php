<?php

defined('BASEPATH') or exit('No direct script access allowed');
$active_group = 'default';
$query_builder = true;
$db['default'] = array(
    'dsn' => '',
    'hostname' => '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.56.101)(PORT = 1521))
	        (CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = orcl)))',
    'username' => 'trabalho',
    'password' => '1234',
    'database' => 'orcl',
    'dbdriver' => 'oci8',
    'dbprefix' => '',
    'pconnect' => false,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => false,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => false,
    'compress' => false,
    'stricton' => false,
    'failover' => array(),
    'save_queries' => true,
);
