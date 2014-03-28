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
class BlogeditController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

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
     * @var T3developer\Multiblog\Domain\Repository\CategoryRepository 
     * @inject 
     */
    protected $categoryRepository;

    
    public function initializeAction() {
        if (isset($this->arguments['entry'])) {
            // $propertyMappingConfiguration->allowProperties('ticketDate');
            $this->arguments['entry']
                    ->getPropertyMappingConfiguration()->allowProperties('postdate')
                    ->forProperty('postdate')
                    ->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');
        }
        
    }

    /**
     * Index view
     *
     * 
     */
    public function indexAction() {
        $blogUid = $this->findsBlogUidByLoggedInUser();

        $posts = $this->postRepository->findByBlogid($blogUid);


        $this->view->assign('entrys', $posts);

        $this->view->assign('menu', 'articles-all');
        $this->view->assign('main-menu', 'articles');
    }

    /*     * ***********************************************************************
     * Posts
     * ************************************************************************ */

    /**
     * Shows the form for a new Post
     */
    public function postNewAction() {
        $blogUid = $this->findsBlogUidByLoggedInUser();

        $blog = $this->blogRepository->findByUid($blogUid);

        //create new post and set values
        $entry = new \T3developer\Multiblog\Domain\Model\Post;
        $entry->setBlogid($blogUid);
        $entry->setPoststatus(0);
        $entry->setPostdate(time());
        
        //search categories
        $categories = $this->categoryRepository->findByBlogid($blogUid);

        $this->view->assign('blog', $blog);
        $this->view->assign('entry', $entry);
        $this->view->assign('categories', $categories);

        $this->view->assign('menu', 'articlecreate');
        $this->view->assign('main-menu', 'articles');
    }

    /**
     * Shows the form for editing a post
     */
    public function postEditAction() {
        
    }

    /**
     * Save a new post
     * @param \T3developer\Multiblog\Domain\Model\Post $entry
     * @dontvalidate  $entry
     */
        public function postCreateAction() {
            if ($this->request->hasArgument('entry')){
                $entry = $this->request->getArgument('entry');
            }

         \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($entry);
        //$this->postRepository->add($entry);

        //$this->redirect('index');
    }
//    public function postCreateAction(\T3developer\Multiblog\Domain\Model\Post $entry) {
//
//
//        // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($entry);
//        $this->postRepository->add($entry);
//
//        $this->redirect('index');
//    }

    /**
     * Updates a post
     */
    public function postUpdateAction() {
        
    }

    /**
     * Shows all categories
     */
    public function kategoryShowAction() {
        $blogUid = $this->findsBlogUidByLoggedInUser();

        $blog = $this->blogRepository->findByUid($blogUid);
        
        //build category Tree
        $mainCategories = $this->categoryRepository->findMainCatByBlog($blogUid);
        
        foreach ($mainCategories as $mainCat) {
            $cat[$mainCat->getUid()]['main'] = $mainCat;
            $cat[$mainCat->getUid()]['sub'] = $this->categoryRepository->findByTopkategory($mainCat->getUid());
        }
        
        //build objects for new category form
        $newKat = new \T3developer\Multiblog\Domain\Model\Category;
        $newKat->setBlogid($blogUid);
        
        
        $this->view->assign('blog', $blog);
        $this->view->assign('categories', $cat);
        $this->view->assign('newKat', $newKat);
        $this->view->assign('mainCategories', $mainCategories);

        $this->view->assign('menu', 'category');
        $this->view->assign('main-menu', 'articles');
    }

    /**
     * Adds a categories
     *
    * @param \T3developer\Multiblog\Domain\Model\Category $newKat Description
     * @dontvalidate $newKat
     */
    public function kategoryAddAction(\T3developer\Multiblog\Domain\Model\Category $newKat) {
        
        $this->categoryRepository->add($newKat);
        
        $this->redirect('kategoryShow');
    }

    /*     * ***********************************************************************
     * Settings
     * ************************************************************************ */

    /**
     * Shows Form for widget settings
     */
    public function widgetsShowAction() {
        $blogUid = $this->findsBlogUidByLoggedInUser();

        $blog = $this->blogRepository->findByUid($blogUid);

        $this->view->assign('blog', $blog);

        $this->view->assign('menu', 'widgets');
        $this->view->assign('main-menu', 'settings');
    }

    /**
     * update widget settings
     * 
     * @param \T3developer\Multiblog\Domain\Model\Blog $blog Description
     * @dontvalidate $blog
     */
    public function widgetsUpdateAction(\T3developer\Multiblog\Domain\Model\Blog $blog) {
        $this->blogRepository->update($blog);

        $this->redirect('widgetsShow');
    }

    /**
     * Shows Form for blogstyle settings
     */
    public function blogstyleShowAction() {
        $blogUid = $this->findsBlogUidByLoggedInUser();

        $blog = $this->blogRepository->findByUid($blogUid);

        $this->view->assign('blog', $blog);

        $this->view->assign('menu', 'blogstyle');
        $this->view->assign('main-menu', 'settings');
    }

    /**
     * update Blogsettings
     * 
     * @param \T3developer\Multiblog\Domain\Model\Blog $blog Description
     * @dontvalidate $blog
     */
    public function blogstyleUpdateAction(\T3developer\Multiblog\Domain\Model\Blog $blog) {
        $this->blogRepository->update($blog);

        $this->redirect('blogstyleShow');
    }

    /**
     * Shows Form for blogstyle settings
     */
    public function usersettingsShowAction() {
        $blogUid = $this->findsBlogUidByLoggedInUser();

        $blog = $this->blogRepository->findByUid($blogUid);

        $this->view->assign('blog', $blog);

        $this->view->assign('menu', 'usersettings');
        $this->view->assign('main-menu', 'settings');
    }

    /**
     * update Blogsettings
     * 
     * @param \T3developer\Multiblog\Domain\Model\Blog $blog Description
     * @dontvalidate $blog
     */
    public function usersettingsUpdateAction(\T3developer\Multiblog\Domain\Model\Blog $blog) {
        $this->blogRepository->update($blog);

        $this->redirect('usersettingsShow');
    }

    /*     * *************************************************************************
     * General functions
     * ************************************************************************ */

    /**
     * Finds the BlogUid by Logged In FE User
     * 
     */
    public function findsBlogUidByLoggedInUser() {

        $blogOwner = $GLOBALS['TSFE']->fe_user->user[uid];
        $blog = $this->blogRepository->findByblogwriter($blogOwner);

        if ($blog[0] != NULL) {
            $blogUid = $blog[0]->getUid();
            return $blogUid;
        } else {
            $this->redirect('login');
        }
    }

    /*
     * if the login is dated out
     */

    public function loginAction() {
        $user = $GLOBALS['TSFE']->fe_user->user;
        //Tx_Extbase_Utility_Debugger::var_dump($user);
        if ($user['uid'] == '') {
            if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['felogin']['loginFormOnSubmitFuncs'])) {
                $_params = array();
                foreach ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['felogin']['loginFormOnSubmitFuncs'] as $funcRef) {
                    //list($onSub, $hid) = t3lib_div::callUserFunction($funcRef, $_params, $this);
                    list($onSub, $hid) = \TYPO3\CMS\Core\Utility\GeneralUtility::callUserFunction($funcRef, $_params, $this);
                    $onSubmitAr[] = $onSub;
                    $extraHiddenAr[] = $hid;
                }
            }

            if (count($onSubmitAr)) {
                $onSubmit = implode('; ', $onSubmitAr) . '; return true;';
            }

            if (count($extraHiddenAr)) {
                $extraHidden = implode(LF, $extraHiddenAr);
            }

            $this->view->assign('storagePid', $this->settings['storagePid']);
            $this->view->assign('onSubmit', $onSubmit);
            $this->view->assign('extraHidden', $extraHidden);
            $this->view->assign('currentPid', \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('id'));
        } else {
            $this->redirect('index');
        }
    }

}

?>