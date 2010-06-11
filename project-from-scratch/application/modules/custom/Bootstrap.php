<?php

/**
 * Module's bootstrap file.
 * Notice the bootstrap class' name is "Modulename_"Bootstrap.
 * When creating your own modules make sure that you are using the correct namespace
 */
class Custom_Bootstrap extends Zend_Application_Module_Bootstrap
{
    protected function _initMyModule()
    {
        $isEnabled = $this->_options['config']['enabled'];
        if ($isEnabled != 1) {
            throw new Exception("This module is not enabled.");
        }
    }
}