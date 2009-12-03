<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initMyLoggingSettings()
    {
        $logger = new Zend_Log();
        $logger->addFilter(new Zend_Log_Filter_Priority((int) $this->_options["logging"]["level"]));
        foreach($this->_options["logging"]["writer"] as $wr) {
            if ($wr == "Zend_Log_Writer_Stream") {
                $w = new $wr($this->_options["logging"]["filename"]);
                $logger->addWriter($w);
            } else {
                $logger->addWriter(new $wr());
            }
        }
        Zend_Registry::set("logger", $logger);
    }

    protected function _initSiteRoutes()
    {
        //Don't forget to bootstrap the front controller as the resource may not been created yet...
        $this->bootstrap("frontController");
        $front = $this->getResource("frontController");
        //Read the routes from an ini file and in that ini file use the options with routes prefix...
        $front->getRouter()->addConfig(new Zend_Config_Ini(APPLICATION_PATH . "/configs/routes.ini"), "routes");
    }

    protected function _initDoctrine()
    {
        //Load the autoloader
        Zend_Loader_Autoloader::getInstance()->registerNamespace('Doctrine')
                                             ->pushAutoloader(array('Doctrine', 'autoload'));

        $manager = Doctrine_Manager::getInstance();
        foreach ($this->_options['doctrine']['attr'] as $key => $val) {
            $manager->setAttribute(eval("return Doctrine::$key;"), $val);
        }
        $manager->setAttribute(Doctrine::ATTR_VALIDATE, Doctrine::VALIDATE_ALL);
        $conn = Doctrine_Manager::connection($this->_options['doctrine']['dsn'], 'doctrine');
        Doctrine::loadModels($this->_options["doctrine"]["module_directories"]);
    }

}
