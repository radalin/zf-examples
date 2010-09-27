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
 */
class PostsController extends Zend_Controller_Action
{

    /**
     *
     * @var PostsTable
     */
    private $_table;

    public function init()
    {
        $this->_table = new PostsTable();
    }

    public function indexAction()
    {
        $this->view->title = "Latest Blogs In My Site";
        //Show a post list here...
        
        $this->view->posts = $this->_table->getLatestPosts();
    }

    public function showAction()
    {
        //Get the post
        $_permalink = $this->_request->getParam("permalink");
        $_post = $this->_table->findByPermalink($_permalink);
        //Get the comments
        $_commentsTable = new CommentsTable();
        $_comments = $_commentsTable->getApprovedCommentsForPost($_post->id);

        $this->view->post = $_post;
        $this->view->commentsCount = count($_comments);
        $this->view->comments = $_comments;
    }

    public function updateAction()
    {
        $this->view->updated = true;
    }
}



