<?php

use Herrera\Pdo\PdoServiceProvider;
use Silex\Application;

$app = new Application();
$dbopts = parse_url(getenv('DATABASE_URL'));
$dbopts = parse_url(getenv('DATABASE_URL'));
$app->register(new PdoServiceProvider(),
               array(
                   'pdo.dsn' => 'pgsql:dbname='.ltrim($dbopts["path"],'/').';host='.$dbopts["host"] . ';port=' . $dbopts["port"],
                   'pdo.username' => $dbopts["user"],
                   'pdo.password' => $dbopts["pass"]
               )
);
echo "yes" ;

?>