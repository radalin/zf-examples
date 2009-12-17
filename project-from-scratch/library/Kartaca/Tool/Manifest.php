<?php

require_once("Zend/Tool/Framework/Manifest/Interface.php");
require_once("Zend/Tool/Framework/Manifest/ProviderManifestable.php");
require_once("Zend/Tool/Framework/Manifest/MetadataManifestable.php");
require_once(dirname(__FILE__) . "/DoctrineProvider.php");

/**
 * Description of Manifest
 *
 * @author roysimkes
 */
class Kartaca_Tool_Manifest
    implements Zend_Tool_Framework_Manifest_Interface,
               Zend_Tool_Framework_Manifest_ProviderManifestable,
               Zend_Tool_Framework_Manifest_MetadataManifestable
{
    public function getProviders()
    {
        return array(
            new Kartaca_Tool_DoctrineProvider(),
        );
    }

    public function getMetadata()
    {
        return array(
            new Zend_Tool_Framework_Metadata_Basic(
                array(
                    "name" => "cli_options",
                    "value" => array(
                        'data_fixtures_path'  =>  'application/data/fixtures',
                        'models_path'         =>  'application/models/doctrine/',
                        'migrations_path'     =>  'application/data/migrations',
                        'sql_path'            =>  'application/data/sql',
                        'yaml_schema_path'    =>  'application/data/schema',
                        "generate_models_options" => array(
                            "phpDocPackage"       => "Kartaca",
                            "phpDocSubpackage"    => "Doctrine",
                            "baseClassName"       => "Kartaca_Model_Doctrine_Record",
                            "phpDocName"          => "Roy Simkes",
                            "phpDocEmail"         => "roy@kartaca.com",
                        ),
                    )
                )
            ),
            new Zend_Tool_Framework_Metadata_Basic(
                array(
                    "name" => "application_bootstrap_file",
                    "value" => "public/header.php",
                )
            ),
        );
    }
}

