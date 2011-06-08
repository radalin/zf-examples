<?php

/**
 * Module's bootstrap file.
 * Notice the bootstrap class' name is "Modulename_"Bootstrap.
 * When creating your own modules make sure that you are using the correct namespace
 */
class Custom_Bootstrap extends Zend_Application_Module_Bootstrap
{

    protected function _bootstrap()
    {
        //Now let's parse the module specific configuration
        //Path might change however this is probably the one you won't ever need to change...
        //And also don't forget to use the current staging environment by sending the APP_ENV parameter to the Zend_Config
        $_conf = new Zend_Config_Ini(APPLICATION_PATH . "/modules/" . strtolower($this->getModuleName()) . "/config/application.ini", APPLICATION_ENV);
        $this->_options = array_merge($this->_options, $_conf->toArray()); //Let's merge the both arrays so that we can use them together...
        parent::_bootstrap(); //Well our custom bootstrap logic should end with the actual bootstrapping, now that we have merged both configs, we can go on...
    }
    
    protected function _initMyModule()
    {
        $_isEnabled = $this->_options['config']['enabled']; //Which one will be used do you think? The on in the global config or the module's config?
        if ($_isEnabled != 1) {
            throw new Exception($this->_options[$this->_options["language"]["selected"]]["error_message"]);
        }
    }
    
    protected function _initModuleLangArray()
    {
        //Now let's define our language array to the registry so that we can use it...
        //Notice I have added "Custom_" prefix to the registry to avoid any conflicts with other modules...
        Zend_Registry::set("Custom_language", $this->_options[$this->_options["language"]["selected"]]);
    }
}
