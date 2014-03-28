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
class Blog extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

    /**
     * Blogtitel
     *
     * @var \string
     * @validate NotEmpty
     */
    protected $blogtitel;

    /**
     * Blogowner
     *
     * @var \string
     * @validate NotEmpty
     */
    protected $blogowner;

    /**
     * Blogowner e-mail
     *
     * @var \string
     * 
     */
    protected $blogwritermail;

    /**
     * Blogdescription
     *
     * @var \string
     */
    protected $blogdescription;

    /**
     * Blog CSS
     *
     * @var \string
     */
    protected $blogcss;

    /**
     * Blogpicture
     *
     * @var \string
     */
    protected $blogpicture;

    /**
     * Last Entry
     *
     * @var \int
     */
    protected $lastentry;

    /**
     * Sticky Post
     *
     * @var \string
     */
    protected $stickyPost;

    /**
     * Widget About Blog
     *
     * @var \int
     */
    protected $widgetAboutBlog;

    /**
     * Widget Recent Post
     *
     * @var \int
     */
    protected $widgetRecentPost;

    /**
     * Widget Category
     *
     * @var \int
     */
    protected $widgetCategory;

    /**
     * Widget Comments
     *
     * @var \int
     */
    protected $widgetComments;

    /**
     * Widget All Posts
     *
     * @var \int
     */
    protected $widgetAllPosts;

    /**
     * Blogsyle
     *
     * @var \int
     */
    protected $blogstyle;

    /**
     * Blogstyle Teaser Image
     *
     * @var \int
     */
    protected $blogstyleTeaserimages;

    public function getBlogtitel() {
        return $this->blogtitel;
    }

    public function setBlogtitel($blogtitel) {
        $this->blogtitel = $blogtitel;
    }

    public function getBlogowner() {
        return $this->blogowner;
    }

    public function setBlogowner($blogowner) {
        $this->blogowner = $blogowner;
    }

    public function getBlogwritermail() {
        return $this->blogwritermail;
    }

    public function setBlogwritermail($blogwritermail) {
        $this->blogwritermail = $blogwritermail;
    }

    public function getBlogdescription() {
        return $this->blogdescription;
    }

    public function setBlogdescription($blogdescription) {
        $this->blogdescription = $blogdescription;
    }

    public function getBlogcss() {
        return $this->blogcss;
    }

    public function setBlogcss($blogcss) {
        $this->blogcss = $blogcss;
    }

    public function getBlogpicture() {
        return $this->blogpicture;
    }

    public function setBlogpicture($blogpicture) {
        $this->blogpicture = $blogpicture;
    }

    public function getLastentry() {
        return $this->lastentry;
    }

    public function setLastentry($lastentry) {
        $this->lastentry = $lastentry;
    }

    public function getStickyPost() {
        return $this->stickyPost;
    }

    public function setStickyPost($stickyPost) {
        $this->stickyPost = $stickyPost;
    }

    public function getWidgetAboutBlog() {
        return $this->widgetAboutBlog;
    }

    public function setWidgetAboutBlog($widgetAboutBlog) {
        $this->widgetAboutBlog = $widgetAboutBlog;
    }

    public function getWidgetRecentPost() {
        return $this->widgetRecentPost;
    }

    public function setWidgetRecentPost($widgetRecentPost) {
        $this->widgetRecentPost = $widgetRecentPost;
    }

    public function getWidgetCategory() {
        return $this->widgetCategory;
    }

    public function setWidgetCategory($widgetCategory) {
        $this->widgetCategory = $widgetCategory;
    }

    public function getWidgetComments() {
        return $this->widgetComments;
    }

    public function setWidgetComments($widgetComments) {
        $this->widgetComments = $widgetComments;
    }

    public function getWidgetAllPosts() {
        return $this->widgetAllPosts;
    }

    public function setWidgetAllPosts($widgetAllPosts) {
        $this->widgetAllPosts = $widgetAllPosts;
    }

    public function getBlogstyle() {
        return $this->blogstyle;
    }

    public function setBlogstyle($blogstyle) {
        $this->blogstyle = $blogstyle;
    }

    public function getBlogstyleTeaserimages() {
        return $this->blogstyleTeaserimages;
    }

    public function setBlogstyleTeaserimages($blogstyleTeaserimages) {
        $this->blogstyleTeaserimages = $blogstyleTeaserimages;
    }

}

?>