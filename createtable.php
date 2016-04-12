<?php

use Herrera\Pdo\PdoServiceProvider;
use Silex\Application;

$dbopts = parse_url(getenv('DATABASE_URL'));
$app->register(new Herrera\Pdo\PdoServiceProvider(),
               array(
                   'pdo.dsn' => 'pgsql:dbname='.ltrim($dbopts["path"],'/').';host='.$dbopts["host"] . ';port=' . $dbopts["port"],
                   'pdo.username' => $dbopts["jgnzsrfulamkrq"],
                   'pdo.password' => $dbopts["WBBl9gjBGfXJYE2wh0nvk_smTq"]
               )
);

?>