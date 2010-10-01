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
 * 
 */
class CommentsController extends Zend_Controller_Action
{

    /**
     *
     * @var CommentsTable
     */
    private $_commentsTable = null;

    public function init()
    {
        //Make sure no one unauthorized enters here...
        if (!Zend_Auth::getInstance()->getIdentity()) {
            $this->_redirect(APPLICATION_BASEURL . "/index");
            return;
        }
        $this->_commentsTable = new CommentsTable();
    }

    public function indexAction()
    {
        $this->view->comments = $this->_commentsTable->fetchAll();
    }

    public function updateAction()
    {
        try {
            //Get the comment first...
            $_comment = $this->_commentsTable->findById($this->_getParam("commentId"));
            if ($_comment === null) {
                throw new Exception("No comment is found");
            }
            //Update the status of the comment...
            $_do = $this->getRequest()->getParam("do");
            switch ($_do) {
                case "approve":
                    $_comment->approved_at = date("d.m.Y H:i:s");
                    break;
                case "reject":
                    $_comment->approved_at = null;
                    break;
                case "delete":
                    $_comment->deleted_at = date("d.m.Y H:i:s");
                    break;
                case "restore":
                    $_comment->deleted_at = null;
                    break;
                default:
                    throw new Exception("Invalid Action");
            }
            $_affectedRows = $_comment->save();
            if ($_affectedRows < 1) {
                throw new Exception("Failed to save the comment");
            }
        } catch (Exception $_e) {
            $this->view->error = $_e->getMessage();
        }
    }
}