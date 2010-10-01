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
 * @package
 * @copyright  Copyright (c) 2010 Kartaca (http://www.kartaca.com)
 * @license    http://www.gnu.org/licenses/ GPL
 * @author     roysimkes
 */
class CommentsTable extends Zend_Db_Table
{
    protected $_name = "comments";
    protected $_rowClass = "Comment";

    /**
     *
     * @param integer $postId
     * @return Zend_Db_Table_RowSet
     */
    public function getApprovedCommentsForPost($postId)
    {
        $select = $this->_getCommentsForPostBaseQuery($postId)
            ->where("approved_at IS NOT NULL")
            ->where("deleted_at IS NULL");
        return $this->fetchAll($select);
    }

    /**
     *
     * @param integer $id
     * @return Comment
     */
    public function findById($id)
    {
        $_select = $this->select()
            ->where("id = ?", $id);
        return $this->fetchRow($_select);
    }

    /**
     *
     * @param integer $postId
     * @return Zend_Db_Table_RowSet
     */
    public function getCommentsForPost($postId)
    {
        return $this->fetchAll($this->_getCommentsForPostBaseQuery($postId));
    }

    private function _getCommentsForPostBaseQuery($postId)
    {
        return $select = $this->select()
            ->where("post_id = ?", $postId)
            ->where("deleted_at IS NULL");
    }
}