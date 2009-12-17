<?php
require("public/header.php");

$application->bootstrap();

// Configure Doctrine Cli
// Normally these are arguments to the cli tasks but if they are set here the arguments will be auto-filled
$config = array(
    'data_fixtures_path'  =>  APPLICATION_PATH . '/data/fixtures',
    'models_path'         =>  APPLICATION_PATH . '/models/doctrine/',
    'migrations_path'     =>  APPLICATION_PATH . '/data/migrations',
    'sql_path'            =>  APPLICATION_PATH . '/data/sql',
    'yaml_schema_path'    =>  APPLICATION_PATH . '/data/schema',
    "generate_models_options" => array(
        "phpDocPackage"       => "Kartaca",
        "phpDocSubpackage"    => "Doctrine",
        "baseClassName"       => "Kartaca_Model_Doctrine_Record",
        "phpDocName"          => "Roy Simkes",
        "phpDocEmail"         => "roy@kartaca.com",
    ),
);

$cli = new Doctrine_Cli($config);
$cli->run($_SERVER['argv']);
