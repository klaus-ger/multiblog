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
     * 
     */
    public function indexAction() {
        if ($this->request->hasArgument('blogId')) {
            $blogId = $this->request->getArgument('blogId');
        } else {
            $blogId = 1;
        }
        $blog = $this->blogRepository->findByUid($blogId);

        //check if Blog has single view or blog view
        if ($blog->getBlogstyle() == 1) {
            $posts = $this->postRepository->findPostsByLimitAndBlogId($blog->getUid(), 8);
            //$posts = $this->postRepository->findAll();
        } else {
            //load last Post
        }

        //loadSticky Posts
        $sticky = $this->postRepository->findStickyPosts($blog->getUid());
        if ($sticky[0] != '') {
            $countComments = $this->commentRepository->countCommentsperPost($sticky[0]->getUid());
            $sticky[0]->setContComments($countComments);
        }
        
        //Count comments for posts
        foreach ($posts as $post){
            $postCount = $this->commentRepository->countCommentsperPost($post->getUid());
            $post->setContComments($postCount);
        }
        
        
        $this->setSidebarValues($blog->getUid());
        $this->setSeoHeader($blog->getUid(), 0);

        $this->view->assign('blog', $blog);
        $this->view->assign('posts', $posts);
        $this->view->assign('sticky', $sticky[0]);
    }

    /**
     * Blogview - List of Post Teaser
     * @param int $post postUid
     */
    public function singleViewAction($post) {

        $post = $this->postRepository->findByUid($post);
        $blog = $this->blogRepository->findByUid($post->getBlogid());
        $content = $this->contentRepository->findByPostid($post->getuid());

        $comments = $this->commentRepository->findApprovedByPostid($post->getUid());
        $post->setContComments(count($comments));

        //find prev / next posts
        $prev = $this->postRepository->findPreviousEntry($post->getPostdate()->getTimestamp(), $blog->getUid());
        $next = $this->postRepository->findNextEntry($post->getPostdate()->getTimestamp(), $blog->getUid());

        $this->setSidebarValues($blog->getUid());
        $this->setSeoHeader($blog->getUid(), $post->getUid());

        $this->view->assign('post', $post);
        $this->view->assign('content', $content);
        $this->view->assign('comments', $comments);
        $this->view->assign('newComment', $newComment);
        $this->view->assign('prev', $prev[0]);
        $this->view->assign('next', $next[0]);
        $this->view->assign('blog', $blog);
    }

    /**
     * Add a new Comment
     * @dontvalidate identifier
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

        $newComment = new \T3developer\Multiblog\Domain\Model\Comment;
        $newComment->setBlogid($blogid);
        $newComment->setPostid($postid);
        $newComment->setCommentname($name);
        $newComment->setCommentmail($email);
        $newComment->setCommenttext($text);
        $newComment->setCommentdate(time());

        $this->commentRepository->add($newComment);
        $persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
        $persistenceManager->persistAll();


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
            //Single Post Focus
            $post = $this->postRepository->findByUid($postId);
            $seo['title'] = $post->getPosttitel();
            $seo['description'] = $post->getPostseodescription();
        }

        if ($postId == 0 || $seo['title'] == '') {
            $seo['title'] = $blog->getBlogseotitle();
        }
        if ($postId == 0 || $seo['description'] == '') {
            $seo['description'] = $blog->getBlogseodescription();
        }


        $GLOBALS['TSFE']->getPageRenderer()->addMetaTag('<meta name="description" content="' . $seo['description'] . '" /> ');
        $GLOBALS['TSFE']->getPageRenderer()->setTitle($seo['title']);
    }

}

?>