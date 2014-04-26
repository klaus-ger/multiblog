<?php

namespace T3developer\Multiblog\Controller;

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
class BlogController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

    /**
     * @var T3developer\Multiblog\Domain\Repository\BlogRepository 
     * @inject 
     */
    protected $blogRepository;

    /**
     * @var T3developer\Multiblog\Domain\Repository\PostRepository 
     * @inject 
     */
    protected $postRepository;

    /**
     * @var T3developer\Multiblog\Domain\Repository\ContentRepository 
     * @inject 
     */
    protected $contentRepository;

    /**
     * @var T3developer\Multiblog\Domain\Repository\CommentRepository 
     * @inject 
     */
    protected $commentRepository;

    /**
     * @var T3developer\Multiblog\Domain\Repository\CategoryRepository 
     * @inject 
     */
    protected $categoryRepository;

    /**
     * Index view
     * 
     * All actions are sent to the index view with the parameters
     * like single postId or categoryId because we need nice URLs 
     * without eg. action links and so on
     * 
     * We can rewrite the parameters via real url, see documentation!
     * 
     */
    public function indexAction() {

        //check get variables
        if ($this->request->hasArgument('blogId')) {
            $blogId = $this->request->getArgument('blogId');
        } else {
            $blogId = 1;
        }
        if ($this->request->hasArgument('page')) {
            $page = $this->request->getArgument('page');
        } else {
            $page = 1;
        }
        if ($this->request->hasArgument('postId')) {
            $postId = $this->request->getArgument('postId');
        } else {
            $postId = 0;
        }
        if ($this->request->hasArgument('categoryId')) {
            $categoryId = $this->request->getArgument('categoryId');
        } else {
            $categoryId = 0;
        }

        $blog = $this->blogRepository->findByUid($blogId);

        //Check which view has to be displayed
        //Case: Blog view | Startpage of the blog
        if ($postId == 0) {
            $this->blogView($blog->getUid(), $page, $categoryId);
        }
        //Case: Single Post View
        if ($postId > 0) {
            $this->singleView($blog->getUid(), $postId);
        }

        //general view values
        $this->setSeoHeader($blogId, $postId);
        $this->setSidebarValues($blog->getUid());
        $this->view->assign('blog', $blog);
    }

    /**
     * Blogview
     */
    public function blogview($blogId, $page, $categoryId) {
        //TODO: split this in blogview and one post view
        $blog = $this->blogRepository->findByUid($blogId);


        //check if Blog has single view or blog view
        // this is a feauture in next versions!
        //if ($blog->getBlogstyle() == 1) {
        $blog->setBlogstyle(1);
        if(1 == 1){
            $itemsPerPage = 10;
            //count all visible post
            if ($categoryId < 1) {
                $countPosts = $this->postRepository->countPostByBlogId($blog->getUid(), $categoryId);
            } else {
                $countPosts = $this->postRepository->countPostByBlogIdCategory($blog->getUid(), $categoryId);
            }

            //posts fits to one page
            if ($countPosts < $itemsPerPage) {
                if ($categoryId < 1) {
                    $posts = $this->postRepository->findPostsByLimitAndBlogId($blog->getUid(), 100);
                } else {
                    $posts = $this->postRepository->findPostsByLimitBlogIdCategory($blog->getUid(), 100, $categoryId);
                }
                //posts needs several pages, fetch posts only for the displayed page
            } else {
                $queryOffset = $itemsPerPage * ($page - 1);
                if ($queryOffset < 1) {
                    $queryOffset = 0;
                }
                if ($categoryId < 1) {
                    $posts = $this->postRepository->findPostsByLimitOffsetAndBlogId($blog->getUid(), $queryOffset, $itemsPerPage, $categoryId);
                } else {
                    $posts = $this->postRepository->findPostsByLimitOffsetBlogIdCategory($blog->getUid(), $queryOffset, $itemsPerPage, $categoryId);
                }
                //build paginator
                $pages = ceil($countPosts / $itemsPerPage);
                //We limit the page menu to 10 pages
                //Case I: the calculatet pages are below 10
                if ($pages <= 10) {
                    $minPagination = 1;
                    $maxPagination = $pages;
                }

                //Case II: the calculated pages are more than 10 
                if ($pages > 10) {
                    $maxPagination = $page + 5;
                    if ($maxPagination > $pages) {
                        $maxPagination = $pages;
                    }
                    $minPagination = $maxPagination - 11;
                    if ($minPagination < 1) {
                        $minPagination = 1;
                        $maxPagination = 11;
                    }
                }
                //Now we bild the page navigation
                for ($i = $minPagination; $i <= $maxPagination; $i++) {
                    $pagination['pages'][$i]['text'] = $i;
                }

                //Build next / prev links
                if ($page > 1) {
                    $pagination['prev'] = $page - 1;
                }
                if ($page < $pages) {
                    $pagination['next'] = $page + 1;
                }


                //write the actual page for css
                $pagination['current'] = $page;
                $this->view->assign('pagination', $pagination);
            }
            //$posts = $this->postRepository->findAll();
        } else {
            //load last Post
        }

        //loadSticky Posts
        if ($page == 1) {
            $sticky = $this->postRepository->findStickyPosts($blog->getUid());
            if ($sticky[0] != '') {
                $countComments = $this->commentRepository->countCommentsperPost($sticky[0]->getUid());
                $sticky[0]->setContComments($countComments);
            }
        }

        //Count comments for posts
        foreach ($posts as $post) {
            $postCount = $this->commentRepository->countCommentsperPost($post->getUid());
            $post->setContComments($postCount);
        }

        // find category
        if($categoryId != 0){
            $category = $this->categoryRepository->findByUid($categoryId);
            $this->view->assign('categoryfilter', $category);
        }
        $this->view->assign('posts', $posts);
        $this->view->assign('sticky', $sticky[0]);
        $this->view->assign('view', 'blogview');
    }

    /**
     * SingleView
     * 
     * @param int $blogId Blog Uid
     * @param int $postId PostUid
     */
    public function singleView($blogId, $postId) {

        $post = $this->postRepository->findByUid($postId);
        $blog = $this->blogRepository->findByUid($post->getBlogid());
        $content = $this->contentRepository->findByPostid($post->getUid());

        $comments = $this->commentRepository->findApprovedByPostid($post->getUid());
        $post->setContComments(count($comments));

        //find prev / next posts
        $prev = $this->postRepository->findPreviousEntry($post->getPostdate()->getTimestamp(), $blog->getUid());
        $next = $this->postRepository->findNextEntry($post->getPostdate()->getTimestamp(), $blog->getUid());

        $this->setSidebarValues($blog->getUid());

        
        $this->view->assign('post', $post);
        $this->view->assign('content', $content);
        $this->view->assign('comments', $comments);
        $this->view->assign('newComment', $newComment);
        $this->view->assign('currentUrl', $this->uriBuilder->getRequest()->getRequestUri());
        $this->view->assign('prev', $prev[0]);
        $this->view->assign('next', $next[0]);
        $this->view->assign('blog', $blog);
        $this->view->assign('view', 'singleview');
    }

    /**
     * Add a new Comment
     * 
     */
    public function ajaxNewCommentAction() {
        if ($this->request->hasArgument('blogid')) {
            $blogid = $this->request->getArgument('blogid');
        }
        if ($this->request->hasArgument('postid')) {
            $postid = $this->request->getArgument('postid');
        }
        if ($this->request->hasArgument('name')) {
            $name = $this->request->getArgument('name');
        }
        if ($this->request->hasArgument('email')) {
            $email = $this->request->getArgument('email');
        }
        if ($this->request->hasArgument('text')) {
            $text = $this->request->getArgument('text');
        }
        
        $commentRepository = $this->objectManager->get('T3developer\\Multiblog\\Domain\\Repository\\CommentRepository');
       
        $newComment = $this->objectManager->get('T3developer\\Multiblog\\Domain\\Model\\Comment'); 
        $newComment->setBlogid($blogid);
        $newComment->setPostid($postid);
        $newComment->setCommentname($name);
        $newComment->setCommentmail($email);
        $newComment->setCommenttext($text);
        $newComment->setCommentdate(time());
        
        $commentRepository->add($newComment);
        $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager')->persistAll();
       
       exit;
    }

    /**
     * Sidebar values
     * 
     * @param int $blogId Blog Uid
     * @return array Sidebarvalues
     */
    public function setSidebarValues($blogId) {

        $sidebar['categories'] = $this->categoryRepository->findByBlogid($blogId);
        $sidebar['comments'] = $this->commentRepository->findLastByBlogid($blogId, 3);
        $sidebar['lastPosts'] = $this->postRepository->findPostsByLimitAndBlogId($blogId, 5);
        $this->view->assign('sidebar', $sidebar);
    }

    /**
     * Seo Header Data
     * 
     * @param int $blogId Blog Uid
     * @param int $postId Blog Uid
     */
    public function setSeoHeader($blogId, $postId = 0) {
        $seo['title'] = '';
        $seo['description'] = '';

        $blog = $this->blogRepository->findByUid($blogId);

        if ($postId > 0) {
            $post = $this->postRepository->findByUid($postId);
        }

        //title
        if ($post) {
            $seo['title'] = $post->getPosttitel();
        } else {
            $seo['title'] = $blog->getBlogtitel();
        }

        //description
        if ($post) {
            $seo['description'] = $post->getPostseodescription();
        } else {
            $seo['description'] = $blog->getBlogdescription();
        }

        //image    
//        if ($post) {
//            if ($post->getImage()) {
//               // $og['image'] = $GLOBALS['TSFE']->tmpl->setup['config.']['baseURL'] . $post->getImage()->getOriginalResource()->getPublicUrl();
//            } else {
//                if ($blog->getBlogpicture()) {
//               //  $og['image'] = $GLOBALS['TSFE']->tmpl->setup['config.']['baseURL'] . $post->getImage()->getOriginalResource()->getPublicUrl();
//                }
//            }
//        } else {
//            if ($blog->getBlogpicture()) {
//                $og['image'] = $GLOBALS['TSFE']->tmpl->setup['config.']['baseURL'] . $post->getImage()->getOriginalResource()->getPublicUrl();
//            }
//        }

        //detaillink
        if ($post) {
            $link = strtolower($post->getPosttitel());
            $link = str_replace(':', '', $link);
            $link = str_replace(' ', '-', $link);
            $og['pagelink'] = $this->settings['linkSingleView'] . $link;
        } else {
            $og['pagelink'] = $this->settings['linkSingleView'];
        }

        //domain link
        $og['domainlink'] = $GLOBALS['TSFE']->tmpl->setup['config.']['baseURL'];

        //Sitename
        $og['sitename'] = $this->settings['sitename'];


        // typ
        if ($post) {
            $og['typ'] = 'article';
        } else {
            $og['typ'] = 'blog';
        }

        //google+ Publisher
        if ($this->settings['author'] != '') {
            $og['author'] = $this->settings['author'];
        }

        //create date
        if ($post) {
            $og['crdate'] = date(DATE_ATOM, $post->getPostdate()->getTimestamp());
        } else {
            $og['crdate'] = date(DATE_ATOM, mktime(0, 0, 0, 4, 1, 2013));
            ;
        }

        //render the page header
        $GLOBALS['TSFE']->getPageRenderer()->setTitle($seo['title']);
        $GLOBALS['TSFE']->getPageRenderer()->addMetaTag('<meta name="description" content="' . $seo['description'] . '" /> ');
        $GLOBALS['TSFE']->getPageRenderer()->addMetaTag('<meta name="canonical" content="' . $og['pagelink'] . '" /> ');

        //og
        $GLOBALS['TSFE']->getPageRenderer()->addMetaTag('<meta property="og:title" content="' . $seo['title'] . '" /> ');
        $GLOBALS['TSFE']->getPageRenderer()->addMetaTag('<meta property="og:type" content="' . $og['typ'] . '" /> ');
        $GLOBALS['TSFE']->getPageRenderer()->addMetaTag('<meta property="og:url" content="' . $og['pagelink'] . '" /> ');
        $GLOBALS['TSFE']->getPageRenderer()->addMetaTag('<meta property="og:image" content="' . $og['image'] . '" /> ');
        $GLOBALS['TSFE']->getPageRenderer()->addMetaTag('<meta property="og:description" content="' . $seo['description'] . '" /> ');
        $GLOBALS['TSFE']->getPageRenderer()->addMetaTag('<meta property="og:site_name" content="' . $og['sitename'] . '" /> ');
        $GLOBALS['TSFE']->getPageRenderer()->addMetaTag('<meta property="article:published_time" content="' . $og['crdate'] . '" /> ');

        //$GLOBALS['TSFE']->getPageRenderer()->addMetaTag('<meta property="author" content="' . $og['author'] . '" /> ');
        $GLOBALS['TSFE']->getPageRenderer()->addMetaTag('<meta itemprop="name" content="' . $seo['title'] . '" /> ');
        $GLOBALS['TSFE']->getPageRenderer()->addMetaTag('<meta itemprop="description" content="' . $seo['description'] . '" /> ');
        $GLOBALS['TSFE']->getPageRenderer()->addMetaTag('<meta itemprop="image" content="' . $og['image'] . '" /> ');


        //Set array for bulding the share links
        $share['image'] = $og['image'];
        $share['text'] = $seo['description'];
        $share['title'] = $seo['title'];
        $this->view->assign('share', $share);

// <!-- Google Authorship and Publisher Markup -->
//<link rel="author" href="https://plus.google.com/[Google+_Profile]/posts"/>
//<link rel="publisher" href=”https://plus.google.com/[Google+_Page_Profile]"/>
//
//<!-- Schema.org markup for Google+ -->
//<meta itemprop="name" content="The Name or Title Here">
//<meta itemprop="description" content="This is the page description">
//<meta itemprop="image" content="http://www.example.com/image.jpg">
//
//<!-- Twitter Card data -->
//<meta name="twitter:card" content="summary_large_image">
//<meta name="twitter:site" content="@publisher_handle">
//<meta name="twitter:title" content="Page Title">
//<meta name="twitter:description" content="Page description less than 200 characters">
//<meta name="twitter:creator" content="@author_handle">
//<!-- Twitter summary card with large image must be at least 280x150px -->
//<meta name="twitter:image:src" content="http://www.example.com/image.html">
//
//<!-- Open Graph data -->
//<meta property="og:title" content="Title Here" />
//<meta property="og:type" content="article" />
//<meta property="og:url" content="http://www.example.com/" />
//<meta property="og:image" content="http://example.com/image.jpg" />
//<meta property="og:description" content="Description Here" />
//<meta property="og:site_name" content="Site Name, i.e. Moz" />
//<meta property="article:published_time" content="2013-09-17T05:59:00+01:00" />
//<meta property="article:modified_time" content="2013-09-16T19:08:47+01:00" />
//<meta property="article:section" content="Article Section" />
//<meta property="article:tag" content="Article Tag" />
//<meta property="fb:admins" content="Facebook numberic ID" /> 
    }

}

?>