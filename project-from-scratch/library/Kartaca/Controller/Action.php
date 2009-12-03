<?php

class Kartaca_Controller_Action extends Zend_Controller_Action
{
    protected $_logger;
    
    protected function _init()
    {
        $this->_logger = Zend_Registry::get("logger");
    }
}
