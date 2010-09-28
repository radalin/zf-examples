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

require_once(APPLICATION_PATH . "/forms/AddCommentForm.php");
require_once(APPLICATION_PATH . "/forms/AddPostForm.php");

class PostsController extends Zend_Controller_Action
{

    /**
     * @var PostsTable
     * 
     */
    private $_postsTable = null;
    /**
     * @var CommentsTable
     * 
     */
    private $_commentsTable = null;

    public function init()
    {
        $this->_postsTable = new PostsTable();
        $this->_commentsTable = new CommentsTable();
    }

    public function indexAction()
    {
        $this->view->title = "Latest Blogs In My Site";
        //Show a post list here...

        $this->view->posts = $this->_postsTable->getLatestPosts();
    }

    public function showAction()
    {
        //Get the post
        $_post = $this->_getParam("post");
        if (!isset($_post) || !$_post instanceof Post) {
            $_permalink = $this->_request->getParam("permalink");
            $_post = $this->_postsTable->findByPermalink($_permalink);
        }

        //Get the comments
        $_comments = $this->_commentsTable->getApprovedCommentsForPost($_post->id);

        $this->view->post = $_post;
        $this->view->commentsCount = count($_comments);
        $this->view->comments = $_comments;

        //Create the comment form...
        $_form = $this->_getParam("form");
        if (!isset($_form) || !$_form instanceof AddCommentForm) {
            $_form = new AddCommentForm();
        }
        $_form->setPost($_post);
        $this->view->commentForm = $_form;
    }

    public function addcommentAction()
    {
        if ($_POST) {
            $_form = new AddCommentForm();
            $_isValid = $_form->isValid($_POST);
            $_post = $this->_postsTable->findByPermalink($_form->getPostPermalink());
            if ($_isValid) {
                //Now insert it...
                $_newComment = $this->_commentsTable->createRow();
                $_newComment->loadFromForm($_form);
                if ($_newComment->insert()) {
                    $this->view->updated = true;
                } else {
                    $this->view->updated = false;
                }
            } else {
                $this->_forward("show", null, null, array("form" => $_form, "post" => $_post, "permalink" => $_post->permalink));
            }
        } else {
            $this->view->updated = false;
        }
    }

    public function updateAction()
    {
        //Only allow updates if you are logged in...
        if (!Zend_Auth::getInstance()->getIdentity()) {
            $this->view->notAuthorized = true;
            return;
        }

        $_form = new AddPostForm();
        $this->view->updated = false;
        if ($_POST) {
            if ($_form->isValid($_POST)) {
                if ($_form->isNewPostForm()) {
                    $_newPost = $this->_postsTable->createRow();
                    $_newPost->loadFromForm($_form);
                    $_newPost->insert();
                } else {
                    $_oldPost = $this->_postsTable->findById($_form->getElement("post"));
                    $_oldPost->loadFromForm($_form);
                    $_oldPost->save();
                }
                $this->view->updated = true;
            }
        } else {
            $_activePost = $this->_getParam("postId");
            if (isset($_activePost) && is_numeric($_activePost)) { //Don't forget to make checks...
                //get the content from database
                $_post = $this->_postsTable->findById($_activePost);
                $_form->setPost($_post);
            }
        }
        $this->view->form = $_form;
    }
}