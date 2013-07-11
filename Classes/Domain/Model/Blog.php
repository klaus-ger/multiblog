<?php

/**
 * @scope prototype
 * @entity
 */
class Tx_Multiblog_Domain_Model_Blog extends Tx_Extbase_DomainObject_AbstractEntity {

    /**
     * The uid
     * @var int
     * @validate NotEmpty 
     */
    protected $uid;

    /**
     * The blogtitel
     * @var string
     * @validate NotEmpty 
     */
    protected $blogtitel;

    /**
     * The blogwriter
     * @var string
     * @validate NotEmpty 
     */
    protected $blogwriter;

    /**
     * The blogwritermail
     * @var string
     * @validate NotEmpty
     */
    protected $blogwritermail;

    /**
     * The blogdescription
     * @var string
     * @validate NotEmpty 
     */
    protected $blogdescription;

    /**
     * The blogcss
     * @var int
     * @validate NotEmpty 
     */
    protected $blogcss;

    /**
     * The blogbild
     * @var string
     * 
     */
    protected $blogbild;

    /**
     * The lastentry
     * @var DateTime
     * @validate NotEmpty
     */
    protected $lastentry;

    /**
     * The StickyPost
     * @var Tx_Multiblog_Domain_Model_Entry
     * 
     */
    protected $stickyPost;

    /**
     * Widget About Blog
     * @var int
     * 
     */
    protected $widgetAboutBlog;

    /**
     * Widget recent Post
     * @var int
     * 
     */
    protected $widgetRecentPost;

    /**
     * Widget Category
     * @var int
     * 
     */
    protected $widgetCategory;

    /**
     * Widget last Comments
     * @var int
     * 
     */
    protected $widgetComments;

    /**
     * Widget All Posts
     * @var int
     * 
     */
    protected $widgetAllPosts;

    /**
     * Blogstyle
     * @var int
     * 
     */
    protected $blogstyle;
    
    /**
     * Set the use of teaser images in Blog show and Category View
     * @var int
     * 
     */
    protected $blogstyleTeaserimages;
    
    
    Public Function setUid($uid) {
        $this->uid = $uid;
    }

    /** Setters for Blog * */

    /**
     *
     * Sets the blogtitel
     * @param string $blogtitel The blogtitel
     * @return void
     *
     */
    Public Function setBlogtitel($blogtitel) {
        $this->blogtitel = $blogtitel;
    }

    /**
     *
     * Sets the blogwritermail
     * @param string $blogwritermail The blogwriter
     * @return void
     *
     */
    Public Function setBlogwritermail($blogwritermail) {
        $this->blogwritermail = $blogwritermail;
    }

    /**
     *
     * Sets the blogwriter
     * @param string $blogwriter The blogwriter
     * @return void
     *
     */
    Public Function setBlogwriter($blogwriter) {
        $this->blogwriter = $blogwriter;
    }

    /**
     *
     * Sets the blogdescription
     * @param string $blogdescription The blogdescription
     * @return void
     *
     */
    Public Function setBlogdescription($blogdescription) {
        $this->blogdescription = $blogdescription;
    }

    /**
     *
     * Sets the blogcss
     * @param int $blogcss The blogcss
     * @return void
     *
     */
    Public Function setBlogcss($blogcss) {
        $this->blogcss = $blogcss;
    }

    /**
     *
     * Sets the blogbild
     * @param string $blogbild 
     * @return void
     *
     */
    Public Function setBlogbild($blogbild) {
        $this->blogbild = $blogbild;
    }

    /**
     *
     * Sets the lastentry
     * @param DateTime $lastentry
     * @return void
     *
     */
    Public Function setLastentry(DateTime $lastentry) {
        $this->lastentry = $lastentry;
    }

    /**
     * Sets the stickyPost
     * 
     * @param int $stickypost
     * @return void
     *
     */
    Public Function setStickyPost($stickyPost) {
        $this->stickyPost = $stickyPost;
    }

    /**
     * Sets the widget About Blog
     * 
     * @param int $widgetAboutBlog
     * @return void
     *
     */
    Public Function setWidgetAboutBlog($widgetAboutBlog) {
        $this->widgetAboutBlog = $widgetAboutBlog;
    }
    
    /**
     * Sets the widget Recent post
     * 
     * @param int $widgetRecentPost
     * @return void
     *
     */
    Public Function setWidgetRecentPost($widgetRecentPost) {
        $this->widgetRecentPost = $widgetRecentPost;
    }
    
    /**
     * Sets the widget Category
     * 
     * @param int $widgetCategory
     * @return void
     *
     */
    Public Function setWidgetCategory($widgetCategory) {
        $this->widgetCategory = $widgetCategory;
    }
    
    
    /**
     * Sets the swidget last Comments
     * 
     * @param int $widgetComments
     * @return void
     *
     */
    Public Function setWidgetComments($widgetComments) {
        $this->widgetComments = $widgetComments;
    }
    
    /**
     * Sets the widget All Posts
     * 
     * @param int $widgetAllPosts
     * @return void
     *
     */
    Public Function setWidgetAllPosts($widgetAllPosts) {
        $this->widgetAllPosts = $widgetAllPosts;
    }
    
    
    /**
     * Sets the blogstyle
     * 
     * @param int $blogstyle
     * @return void
     *
     */
    Public Function setBlogstyle($blogstyle) {
        $this->blogstyle = $blogstyle;
    }
        
    /**
     * Sets the blogstyle teaserimages
     * 
     * @param int $blogstyleTeaserimages
     * @return void
     *
     */
    Public Function setBlogstyleTeaserimages($blogstyleTeaserimages) {
        $this->blogstyleTeaserimages = $blogstyleTeaserimages;
    }
    
    /** GETTERS *************************** */

    /**
     *
     * Gets the blogtitel
     * @return string
     *
     */
    Public Function getBlogtitel() {
        Return $this->blogtitel;
    }

    /**
     *
     * Gets the blogwriter
     * @return string blogwriter
     *
     */
    Public Function getBlogwriter() {
        Return $this->blogwriter;
    }

    /**
     *
     * Gets the blogwritermail
     * @return string blogwritermail
     *
     */
    Public Function getBlogwritermail() {
        Return $this->blogwritermail;
    }

    /**
     *
     * Gets the blogdescription
     * @return string blogdescription
     *
     */
    Public Function getBlogdescription() {
        Return $this->blogdescription;
    }

    /**
     *
     * Gets the blogcss
     * @return int blogcss
     *
     */
    Public Function getBlogcss() {
        Return $this->blogcss;
    }

    /**
     *
     * Gets the blogbild
     * @return string blogbild
     *
     */
    Public Function getBlogbild() {
        Return $this->blogbild;
    }

    /**
     *
     * Gets the lastentry
     * @return DateTime lastentry
     *
     */
    Public Function getLastentry() {
        Return $this->lastentry;
    }

    /**
     * Gets the stickyPost
     *
     * @return int
     */
    Public Function getStickyPost() {
        Return $this->stickyPost;
    }

    /**
     * Gets widget About Blog
     *
     * @return int
     */
    Public Function getWidgetAboutBlog() {
        Return $this->widgetAboutBlog;
    }
    
    /**
     * Gets widget Recent Post
     *
     * @return int
     */
    Public Function getWidgetRecentPost() {
        Return $this->widgetRecentPost;
    }
    
    /**
     * Gets widget Category
     *
     * @return int
     */
    Public Function getWidgetCategory() {
        Return $this->widgetCategory;
    }
    
    /**
     * Gets widget Comments
     *
     * @return int
     */
    Public Function getWidgetComments() {
        Return $this->widgetComments;
    }
    
    /**
     * Gets widget All Posts
     *
     * @return int
     */
    Public Function getWidgetAllPosts() {
        Return $this->widgetAllPosts;
    }
    
    /**
     * Gets blogstyle
     *
     * @return int
     */
    Public Function getBlogstyle() {
        Return $this->blogstyle;
    }
    
    /**
     * Gets blogstyleTeaserimages
     *
     * @return int
     */
    Public Function getBlogstyleTeaserimages() {
        Return $this->blogstyleTeaserimages;
    }
}

?>