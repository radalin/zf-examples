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
 * @package    Kartaca_Blog_Forms
 * @copyright  Copyright (c) 2010 Kartaca (http://www.kartaca.com)
 * @license    http://www.gnu.org/licenses/ GPL
 * @author     roysimkes
 */
class AddCommentForm extends Zend_Form
{
    public function init()
    {
        $this->setMethod("post");
        $this->setAction(APPLICATION_BASEURL . "/posts/addcomment");

        $commentator = $this->createElement("text", "commentator")
            ->setLabel("Full Name");

        $email = $this->createElement("text", "email")
            ->setLabel("Email")
            ->setRequired()
            ->addValidator("emailAddress");

        $body = $this->createElement("textarea", "body")
            ->setLabel("Body")
            ->setRequired();

        $title = $this->createElement("text", "title")
            ->setLabel("Title")
            ->setRequired();

        $post = $this->createElement("hidden", "post");

        $postId = $this->createElement("hidden", "postId");

        $submitBtn = $this->createElement("submit", "Add Comment");

        $this->addElements(array(
            $commentator,
            $email,
            $title,
            $body,
            $submitBtn,
            $post,
            $postId,
        ));
    }

    /**
     *
     * @param Post $post
     */
    public function setPost($post)
    {
        $this->getElement("post")->setValue($post->permalink);
        $this->getElement("postId")->setValue($post->id);
    }

    public function getPostPermalink()
    {
        return $this->getElement("post")->getValue();
    }

    public function getPostId()
    {
        return $this->getElement("postId")->getValue();
    }

    public function getCommentator()
    {
        return $this->getElement("commentator")->getValue();
    }

    public function getEmail()
    {
        return $this->getElement("email")->getValue();
    }

    public function getBody()
    {
        return $this->getElement("body")->getValue();
    }

    public function getTitle()
    {
        return $this->getElement("title")->getValue();
    }
}