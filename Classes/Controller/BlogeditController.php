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

    /**
     * @var T3developer\Multiblog\Domain\Repository\ContentRepository 
     * @inject 
     */
    protected $contentRepository;

    /**
     * @var T3developer\Multiblog\Domain\Repository\FileReferenceRepository 
     * @inject 
     */
    protected $fileReferenceRepository;

    /**
     * @var \T3developer\Multiblog\Domain\Repository\FileRepository   
     * @inject
     */
    protected $fileRepository;

    public function initializeAction() {
        if (isset($this->arguments['post'])) {
            // $propertyMappingConfiguration->allowProperties('ticketDate');
            $this->arguments['post']
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
        $blog = $this->findsBlogByLoggedInUser();

        $posts = $this->postRepository->findPostByBlogid($blog->getUid());

        $this->view->assign('blog', $blog);
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
        $blog = $this->findsBlogByLoggedInUser();

        //create new post and set values
        $post = new \T3developer\Multiblog\Domain\Model\Post;
        $post->setBlogid($blog->getUid());
        $post->setPostdate(time());
        
        
        
        $newContent[0] = new \T3developer\Multiblog\Domain\Model\Content;
        $newContent[0]->setPostid($blog->getUid());
        
        
        //$categoryTree = $this->findCategoryTree($newContent->getUid());

        $this->view->assign('blog', $blog);
        $this->view->assign('post', $post);
        $this->view->assign('contentparts', $newContent);
        $this->view->assign('categoryTree', $categoryTree);

        $this->view->assign('menu', 'articlecreate');
        $this->view->assign('main-menu', 'articles');
    }

    /**
     * Shows the form for editing a post
     * 
     */
    public function postEditAction() {
        if ($this->request->hasArgument('postUid')) {
            $postUid = $this->request->getArgument('postUid');
        }
        $blog = $this->findsBlogByLoggedInUser();
        $post = $this->postRepository->findByUid($postUid);
        $contentparts = $this->contentRepository->findByPostid($postUid);

        $categoryTree = $this->findCategoryTree($post->getUid());

        $this->view->assign('blog', $blog);
        $this->view->assign('post', $post);
        $this->view->assign('contentparts', $contentparts);
        $this->view->assign('categoryTree', $categoryTree);

        $this->view->assign('menu', 'article-edit');
        $this->view->assign('main-menu', 'articles');
        $this->view->assign('post-menu', '1');
    }

    /**
     * Save a new post
     * @param \T3developer\Multiblog\Domain\Model\Post $entry
     * @dontvalidate  $entry
     */
    public function postCreateAction() {
        if ($this->request->hasArgument('entry')) {
            $entry = $this->request->getArgument('entry');
        }

        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($entry);
        //$this->postRepository->add($entry);
        //$this->redirect('index');
    }


    
    
    /**
     * Updates a post
     * @dontvalidate  $postNew
     */
    public function postSaveAction() {
        if ($this->request->hasArgument('post')) {
            $post = $this->request->getArgument('post');
        }

        if ($post['postUid'] > 0) {
            $DBPost = $this->postRepository->findByUid($post['postUid']);
            //clear all category
            foreach ($DBPost->getCategory() as $object) {
                $DBPost->removeCategory($object);
            }
        } else {
            $DBPost = new \T3developer\Multiblog\Domain\Model\Post;
        }

        //converting values
        $timestamp = strtotime($post['postdate']);

        //attach categories
        $catArray = explode(',', $post['categories']);
        foreach ($catArray as $newcatuid) {
            $newcat = $this->categoryRepository->findByUid($newcatuid);
            if ($newcat) {
                $DBPost->addCategory($newcat);
            }
        }


        //set values
        $DBPost->setBlogid($post['blogUid']);

        $DBPost->setPosttitel($post['posttitel']);
        $DBPost->setPostdate($timestamp);
        $DBPost->setPoststatus($post['poststatus']);
        $DBPost->setPoststicky($post['poststicky']);
        $DBPost->setPostcommentoption($post['postcommentoption']);
        $DBPost->setPostshowteaser($post['postshowteaser']);
        $DBPost->setPostseodescription($post['postseodescription']);
        $DBPost->setPostintro($post['postintro']);

        if ($post['imagedelete'] == 1) {
            $images = $DBPost->getImage();
            foreach ($images as $img) {
                $reference = $this->fileReferenceRepository->findByUid($img->getUid());
                $this->fileReferenceRepository->remove($reference);
                $DBPost->setImage(null);
            }
        }

        //file upload for teaser
       
            //intro has an file
            if ($_FILES['tx_multiblog_blogedit']['name']['image'][0] != '') {
                /** @var \TYPO3\CMS\Core\Resource\StorageRepository $storageRepository */
                $storageRepository = $this->objectManager->get('TYPO3\CMS\Core\Resource\StorageRepository');
                /** @var \TYPO3\CMS\Core\Resource\ResourceStorage $storage */
                $storage = $storageRepository->findByUid('1');

                $fileData = array();
                $fileData['name'] = $_FILES['tx_multiblog_blogedit']['name']['image'][0];
                $fileData['type'] = $_FILES['tx_multiblog_blogedit']['type']['image'][0];
                $fileData['tmp_name'] = $_FILES['tx_multiblog_blogedit']['tmp_name']['image'][0];
                $fileData['size'] = $_FILES['tx_multiblog_blogedit']['size']['image'][0];


                // this will already handle the moving of the file to the storage:
                $newFileObject = $storage->addFile(
                        $fileData['tmp_name'], $storage->getRootLevelFolder(), $fileData['name']
                );
                $newFileObject = $storage->getFile($newFileObject->getIdentifier());
                $newFile = $this->fileRepository->findByUid($newFileObject->getProperty('uid'));

                /** @var \T3developer\Multiblog\Domain\Model\FileReference $newFileReference */
                $newFileReference = $this->objectManager->get('T3developer\Multiblog\Domain\Model\FileReference');
                $newFileReference->setFile($newFile);

                $DBPost->addImage($newFileReference);
            }//end image handling
        
            if ($post['postUid'] > 0) {
                $this->postRepository->update($DBPost);
            } else {
                $this->postRepository->add($DBPost);
                $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager')->persistAll();
                
            }
        

        
        
        //handle the content parts
        $contentcounter = 1;
        foreach ($post['content'] as $postcontent) {
            if ($postcontent['contentUid'] > 0) {
                $DBcontent = $this->contentRepository->findByUid($postcontent['contentUid']);
            } else {
                $DBcontent = new \T3developer\Multiblog\Domain\Model\Content;
                $DBcontent->setPostid($DBPost->getUid());
            }

            //image handling

            if ($_FILES['tx_multiblog_blogedit']['name']['image'][$contentcounter] != '') {
                /** @var \TYPO3\CMS\Core\Resource\StorageRepository $storageRepository */
                $storageRepository = $this->objectManager->get('TYPO3\CMS\Core\Resource\StorageRepository');
                /** @var \TYPO3\CMS\Core\Resource\ResourceStorage $storage */
                $storage = $storageRepository->findByUid('1');

                $fileData = array();
                $fileData['name'] = $_FILES['tx_multiblog_blogedit']['name']['image'][$contentcounter];
                $fileData['type'] = $_FILES['tx_multiblog_blogedit']['type']['image'][$contentcounter];
                $fileData['tmp_name'] = $_FILES['tx_multiblog_blogedit']['tmp_name']['image'][$contentcounter];
                $fileData['size'] = $_FILES['tx_multiblog_blogedit']['size']['image'][$contentcounter];


                // this will already handle the moving of the file to the storage:
                $newFileObject = $storage->addFile(
                        $fileData['tmp_name'], $storage->getRootLevelFolder(), $fileData['name']
                );
                $newFileObject = $storage->getFile($newFileObject->getIdentifier());
                $newFile = $this->fileRepository->findByUid($newFileObject->getProperty('uid'));

                /** @var \T3developer\Multiblog\Domain\Model\FileReference $newFileReference */
                $newFileReference = $this->objectManager->get('T3developer\Multiblog\Domain\Model\FileReference');
                $newFileReference->setFile($newFile);

                $DBcontent->addPostpicture($newFileReference);
               
            }//end image handling

           
            if ($postcontent['imagedelete'] == 1) {
                $images = $DBcontent->getPostpicture();
                foreach ($images as $img) {
                    $reference = $this->fileReferenceRepository->findByUid($img->getUid());
                    $this->fileReferenceRepository->remove($reference);
                    $DBcontent->setPostpicture(null);
                }
            }
            
             $DBcontent->setPostcontent($postcontent['postcontent']);
             $DBcontent->setImageposition($postcontent['imageposition']);
            
             if ($postcontent['contentUid'] > 0) {
                 $this->contentRepository->update($DBcontent);
             } else {
                 $this->contentRepository->add($DBcontent);
             }
            
            $persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
            $persistenceManager->persistAll();
            
            $contentcounter++;
        }
        
        //add ContentPart
         if ($this->request->hasArgument('addContent')) {
            
            $newContent = new \T3developer\Multiblog\Domain\Model\Content;
            $newContent->setPostid($DBPost->getUid());
            $this->contentRepository->add($newContent);
        }

        $this->redirect('postEdit', 'Blogedit', NULL, array('postUid' => $DBPost->getUid()));
        
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
     * Build the category Tree for a blog
     */
    public function findCategoryTree($blogId) {
        $maiCats = $this->categoryRepository->findMainCatByBlog($blogId);

        foreach ($maiCats as $cat) {
            $catTree[$cat->getUid()]['maincat'] = $cat;
            $catTree[$cat->getUid()]['subcats'] = $this->categoryRepository->findByTopkategory($cat->getUid());
        }
        return $catTree;
    }

    /**
     * Finds the BlogUid by Logged In FE User
     * 
     */
    public function findsBlogByLoggedInUser() {

        $blogOwner = $GLOBALS['TSFE']->fe_user->user[uid];
        $blog = $this->blogRepository->findByBlogowner($blogOwner);

        if ($blog[0] != NULL) {
            return $blog[0];
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