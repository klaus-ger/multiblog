<?php

namespace T3developer\Multiblog\Domain\Model;

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Klaus Heuer <klaus.heuer@t3-developer.com>, t3-developer.com
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

/**
 *
 *
 * @package multiblog
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Comment extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

        /**
     * blogid
     *
     * @var \int
     * 
     */
    protected $blogid;
    
    /**
     * posttitel
     *
     * @var \T3developer\Multiblog\Domain\Model\Post
     * 
     */
    protected $postid;

    /**
     * comment text
     * @var \string
     * 
     */
    protected $commenttext;

    /**
     * comment name
     *
     * @var \string
     */
    protected $commentname;
    
        /**
     * comment date
     *
     * @var \DateTime
     */
    protected $commentdate;
    
        /**
     * comment mail
     *
     * @var \string
     */
    protected $commentmail;
    
        /**
     * comment approve
     *
     * @var \int
     */
    protected $commentapprove;

    
    public function getPostid() {
        return $this->postid;
    }

    public function setPostid($postid) {
        $this->postid = $postid;
    }

    public function getCommenttext() {
        return $this->commenttext;
    }

    public function setCommenttext($commenttext) {
        $this->commenttext = $commenttext;
    }

    public function getCommentname() {
        return $this->commentname;
    }

    public function setCommentname($commentname) {
        $this->commentname = $commentname;
    }

    public function getCommentdate() {
        return $this->commentdate;
    }

    public function setCommentdate($commentdate) {
        $this->commentdate = $commentdate;
    }

    public function getCommentmail() {
        return $this->commentmail;
    }

    public function setCommentmail($commentmail) {
        $this->commentmail = $commentmail;
    }

    public function getCommentapprove() {
        return $this->commentapprove;
    }

    public function setCommentapprove($commentapprove) {
        $this->commentapprove = $commentapprove;
    }

    public function getBlogid() {
        return $this->blogid;
    }

    public function setBlogid($blogid) {
        $this->blogid = $blogid;
    }





}

?>