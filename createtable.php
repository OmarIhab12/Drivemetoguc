<?php

use Herrera\Pdo\PdoServiceProvider;
use Silex\Application;

$app = new Application();
$dbopts = parse_url(getenv('DATABASE_URL'));
$app->register(
    new PdoServiceProvider(),
    array(
        'pdo.dsn' => 'pdo_mysql:dbname=test;host=127.0.0.1',
        'pdo.username' => 'username', // optional
        'pdo.password' => 'password', // optional
        'pdo.options' => array( // optional
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
        )
    )
);
echo "yes" ;

?>