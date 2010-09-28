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
 * @author     roysimkes
 *
 */

require_once(APPLICATION_PATH . "/forms/LoginForm.php");

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        if ($this->_getParam("error") == "1") {
            $this->view->showWrongPassError = true;
        } else if ($this->_getParam("error") == "2") {
            $this->view->invalidFormError = true;
        }
        $_form = new LoginForm();
        $this->view->form = $_form;
    }

    public function loginAction()
    {
        //First check if the form is valid...
        $_form = new LoginForm();
        if (!$_form->isValid($_POST)) {
            $this->_redirect(APPLICATION_BASEURL . "/user/index/error/2");
        }

        $_auth = Zend_Auth::getInstance();
        $_authAdapter = new Zend_Auth_Adapter_DbTable();
        $_authAdapter->setTableName('users')
            ->setIdentityColumn('username')
            ->setCredentialColumn('password');

        $_authAdapter->setIdentity($_form->getUsername())
            ->setCredential(sha1($_form->getPassword()));
        //That's the actual authentication operation
        $_result = $_auth->authenticate($_authAdapter);

        if ($_result->isValid()) {
            $this->view->loggedIn = true;
        } else {
            $this->_redirect(APPLICATION_BASEURL . "/user/index/error/1");
        }
    }

    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->view->loggedOut = true;
    }


}





