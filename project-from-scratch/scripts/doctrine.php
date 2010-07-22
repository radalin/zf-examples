<?php
require("public/header.php");

$application->bootstrap();

$defaultPath = APPLICATION_PATH;

$args = $_SERVER["argv"];

//Perhaps, I want to create models and tables or create sqls for just a module!!!
//Usage: ./doctrine -m MODULE_NAME generate-models-yaml
//The above usage will only generate models for the yaml defined in the module directory
$moduleNameIndex = array_search("-m", $args);
if ($moduleNameIndex !== false) { //Check if the module bootstrapping exists or not...
    $defaultPath = APPLICATION_PATH . "/modules/" . $args[$moduleNameIndex+1];
    //Now unset these module variables to prevent causing problems in the doctrine command line
    array_splice($args, $moduleNameIndex, 2);
}

// Configure Doctrine Cli
// Normally these are arguments to the cli tasks but if they are set here the arguments will be auto-filled
$config = array(
    'data_fixtures_path'  =>  $defaultPath . '/data/fixtures',
    'models_path'         =>  $defaultPath . '/models/doctrine/',
    'migrations_path'     =>  $defaultPath . '/data/migrations',
    'sql_path'            =>  $defaultPath . '/data/sql',
    'yaml_schema_path'    =>  $defaultPath . '/data/schema',
    "generate_models_options" => array(
        "phpDocPackage"       => "Kartaca",
        "phpDocSubpackage"    => "Doctrine",
        "baseClassName"       => "Kartaca_Model_Doctrine_Record",
        "phpDocName"          => "Roy Simkes",
        "phpDocEmail"         => "roy@kartaca.com",
    ),
);

$cli = new Doctrine_Cli($config);
$cli->run($args);

