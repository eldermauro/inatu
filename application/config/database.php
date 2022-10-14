<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
$active_group = 'PostgreSQL';
$query_builder = TRUE;

$db['PostgreSQL'] = array(
    'dsn'      => 'pgsql:host=pgsql.cidadesflorestais.org.br; dbname=cidadesflorestais',
    'hostname' => 'pgsql:host=pgsql.cidadesflorestais.org.br; dbname=cidadesflorestais',
    'username' => 'cidadesflorestais',
    'password' => 'Idesam!@#123',
    'database' => 'cidadesflorestais',
    'dbdriver' => 'pdo',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'd'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => FALSE
);
 
