<?php
/**
 * This file is part of Kartaca Sample ZF Blog.
 *
 * Kartaca Sample ZF Blog is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * Kartaca Sample ZF Blog is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with Kartaca Sample ZF Blog.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @category   Kartaca
 * @package    Krtc_Blog_Controllers
 * @copyright  Copyright (c) 2010 Kartaca (http://www.kartaca.com)
 * @license    http://www.gnu.org/licenses/ GPL
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initModels()
    {
        $this->bootstrap("namespace"); //Make sure that namespace bootstrap has run before...
        //Add models to the include path...
        set_include_path(
            get_include_path() . PATH_SEPARATOR .
            APPLICATION_PATH . "/models/"
        );

        //Now register the custom model autoloader...
        Zend_Loader_Autoloader::getInstance()
            ->pushAutoloader(array('Kartaca_Model_Autoloader', 'autoload'));
    }

    protected function _initNamespace()
    {
        Zend_Loader_Autoloader::getInstance()->registerNamespace("Kartaca");
    }

}

