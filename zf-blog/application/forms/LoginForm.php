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
 * @package`   Kartaca_Blog_Form
 * @copyright  Copyright (c) 2010 Kartaca (http://www.kartaca.com)
 * @license    http://www.gnu.org/licenses/ GPL
 * @author     roysimkes
 */
class LoginForm extends Zend_Form
{
    public function init()
    {
        $this->setAction(APPLICATION_BASEURL . "/user/login");
        $this->setMethod("post");

        $_username = $this->createElement("text", "username")
                ->setLabel("username")
                ->setRequired();

        $_password = $this->createElement("password", "password")
                ->setLabel("password")
                ->setRequired();

        $_sbmt = $this->createElement("submit", "Log In!");

        $this->addElements(array(
            $_username,
            $_password,
            $_sbmt,
        ));
    }

    public function getUsername()
    {
        return $this->getElement("username")->getValue();
    }

    public function getPassword()
    {
        return $this->getElement("password")->getValue();
    }
}