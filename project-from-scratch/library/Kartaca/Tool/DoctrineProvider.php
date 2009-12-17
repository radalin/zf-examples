<?php

require_once("Zend/Tool/Framework/Provider/Interface.php");
require_once("Doctrine.php");

class Kartaca_Tool_DoctrineProvider 
    implements Zend_Tool_Framework_Provider_Interface,
               Zend_Tool_Framework_Registry_EnabledInterface
{

    private $_registry = null;

    /**
     *
     * @var Doctrine_Cli
     */
    private $_cli = null;

    protected function _setUp()
    {
        $applicationBootstrapFile = $this->_registry->getManifestRepository()->getMetadata(array("name" => "application_bootstrap_file"))->getValue();
        if (file_exists($applictionBootstrapFile)) {
            require $applicationBootstrapFile;
            $application->bootstrap(); //badly hardcoded...
        } else {
            require_once 'Zend/Tool/Framework/Provider/Exception.php';
            throw new Zend_Tool_Framework_Provider_Exception("You need to specify a project specific Zend_Application which contains database connection values for doctrine");
        }
        $config = $this->_registry->getManifestRepository()->getMetadata(array("name" => "cli_options"))->getValue();
        $this->_cli = new Doctrine_Cli($config);
    }

    public function setRegistry(Zend_Tool_Framework_Registry_Interface $reg)
    {
        $this->_registry = $reg;
    }

    public function create($task)
    {
        $this->_setUp();
        $this->_cli->run(array(0 => "doctrine", 1 => $task));
    }
}